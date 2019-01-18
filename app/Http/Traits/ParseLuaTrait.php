<?php

/**
 * @author Ivens Pontes <ivenscardoso@hotmail.com>
 * 
 * This code is a modified version of the configLua.php from GesiorAAC
 * @see https://github.com/gesior/Gesior2012/blob/master/classes/configlua.php
 */

namespace App\Http\Traits;

use File;

/**
* Trait ParseLuaTrait
* @package App\Http\Traits
*/
trait ParseLuaTrait
{
    private $config;
    
	public function parseLua($path = false)
	{
		if($path) {
			// if file exists
			if (File::isFile($path)) {
				// get file contents 
				$content = File::get($path);
	
				// Parse Lua from string
				$lines = explode("\n", $content);
				if(count($lines) > 0) {
					foreach($lines as $ln => $line) {
						$tmp_exp = explode('=', $line, 2);
						if(count($tmp_exp) >= 2) {
							$key = trim($tmp_exp[0]);
							if(substr($key, 0, 2) != '--') {
								$value = trim($tmp_exp[1]);
								if(is_numeric($value))
								$this->config[ $key ] = (float) $value;
								elseif(in_array(substr($value, 0 , 1), array("'", '"')) && in_array(substr($value, -1 , 1), array("'", '"')))
								$this->config[ $key ] = (string) substr(substr($value, 1), 0, -1);
								elseif(in_array($value, array('true', 'false')))
								$this->config[ $key ] = ($value == 'true') ? true : false;
								else {
									foreach($this->config as $tmp_key => $tmp_value) // load values definied by other keys, like: dailyFragsToBlackSkull = dailyFragsToRedSkull
									$value = str_replace($tmp_key, $tmp_value, $value);
									$ret = @eval("return $value;");
									if((string) $ret == '') { // = parser error
										flash('Line <b>' . ($ln + 1) . '</b> of LUA config file is not valid [key: <b>' . $key . '</b>]')->error()->important();
										return route('install.index');
									}
									$this->config[ $key ] = $ret;
								}
							}
						}
					}
				}
			}
			else {
				flash('LUA config file doesn\'t exist. Path: <b>' . $path . '</b>')->error()->important();
				return route('install.index');
			}	
		}
		
		// verify if have in lua database informations
		if (isset($this->config['mysqlDatabase']) && isset($this->config['mysqlUser']) && isset($this->config['mysqlPass'])) {
			return $this->config;		
		} else {
			flash('LUA config file doesn\'t compatible.')->error()->important();
			return route('install.index');
		}
	}

}