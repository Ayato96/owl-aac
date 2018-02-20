<?php

namespace App\Http\Controllers;

use App\Http\Traits\SetEnvTrait;
use App\Http\Requests\Install;
use App\Account;
use XmlParser;
use Setting;
use Artisan;
use Lua;
use Auth;

/**
 * Class InstallerController
 * @package App\Http\Controllers
 */
class InstallerController extends Controller
{
    use SetEnvTrait;

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

        Setting::set('server.path', $request->path);

        $lua = new Lua(Setting::get('server.path') . 'config.lua');

        Setting::set('server.name', $lua->serverName);

        $this->setEnvironmentValue('DB_DATABASE', $lua->mysqlDatabase);
        $this->setEnvironmentValue('DB_USERNAME', $lua->mysqlUser);
        $this->setEnvironmentValue('DB_PASSWORD', $lua->mysqlPass);

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

        $xml = XmlParser::load(Setting::get('server.path') . 'data/monster/monsters.xml');
        $monstersXML = $xml->parse([
            'monsters' => ['uses' => 'monster[::name]'],
        ]);

        foreach (call_user_func_array('array_merge', $monstersXML) as $monster) {
            $monsters[] = $monster['::name'];
        }
        Setting::set('server.monsters', $monsters);

        session(['accountName' => $request->name]);;
        session(['accountPass' => $request->password]);

        return redirect()->route('install.finish');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finish()
    {

        Artisan::call('migrate', array('--force' => true));

        $account = Account::updateOrCreate(
            ['name' => session('accountName')],
            ['password' => session('accountPass')]
        );
        $account->is_admin = true;
        $account->save();

        Auth::login($account);

        session()->forget('accountName');
        session()->forget('accountPass');

        Setting::set('server.installed', true);

        return redirect()->route('home');
    }

}
