<?php

namespace App\Http\Controllers;

use App\Http\Requests\Install;
use App\Account;
use XmlParser;
use Setting;
use Artisan;
use Lua;
use Auth;

use App\Http\Traits\SetEnvTrait;
use App\Http\Traits\ParseLuaTrait;

/**
 * Class InstallerController
 * @package App\Http\Controllers
 */
class InstallerController extends Controller
{
    use SetEnvTrait;
    use ParseLuaTrait;

    /**
     * InstallerController constructor.
     */
    public function __construct()
    {
        $this->middleware('notInstalled');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('installer.index');
    }

    /**
     * @param Install $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function install(Install $request)
    {
        // Save path in storage
        Setting::set('server.path', $request->path);

        // Get Config from lua file
        $configLua = $this->parseLua(Setting::get('server.path') . 'config.lua');

        // Save saver name in storage        
        Setting::set('server.name', $configLua['serverName']);

        // Save some informations for use in owlaac login
        Setting::set('server.freePremium', $configLua['freePremium']);
        Setting::set('server.ip', $configLua['ip']);
        Setting::set('server.gameProtocolPort', $configLua['gameProtocolPort']);

        // Set database values in dotenv
        $this->setEnvironmentValue('DB_DATABASE', $configLua['mysqlDatabase']);
        $this->setEnvironmentValue('DB_USERNAME', $configLua['mysqlUser']);
        $this->setEnvironmentValue('DB_PASSWORD', $configLua['mysqlPass']);

        // Vocations in storage  
        $xml = XmlParser::load(Setting::get('server.path') . 'data/XML/vocations.xml');

        $vocationsXML = $xml->parse([
            'vocations' => ['uses' => 'vocation[::id,::name]'],
        ]);

        foreach (call_user_func_array('array_merge', $vocationsXML) as $vocation) {
            $vocations[] = array(
                "id" => $vocation['::id'],
                "name" => $vocation['::name'],
            );
        }
        Setting::set('server.vocations', $vocations);

        // Save monsters in storage
        $xml = XmlParser::load(Setting::get('server.path') . 'data/monster/monsters.xml');
        $monstersXML = $xml->parse([
            'monsters' => ['uses' => 'monster[::name]'],
        ]);

        foreach (call_user_func_array('array_merge', $monstersXML) as $monster) {
            $monsters[] = $monster['::name'];
        }
        Setting::set('server.monsters', $monsters);

        // store accountname and pass in session for create account
        session(['accountName' => $request->name]);;
        session(['accountPass' => $request->password]);

        return redirect()->route('install.finish');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finish()
    {
        // force call migrate for run migrations
        Artisan::call('migrate', array('--force' => true));

        // create admin account
        $account = Account::updateOrCreate(
            ['name' => session('accountName')],
            ['password' => session('accountPass')]
        );
        $account->is_admin = true;
        $account->save();

        // Login with Admin account
        Auth::login($account);

        // forget session variables
        session()->forget('accountName');
        session()->forget('accountPass');

        // Save install status in storare
        Setting::set('server.installed', true);

        // Redirect to home page
        return redirect()->route('home');
    }

}
