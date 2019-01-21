<?php

namespace App\Http\Traits;


/**
 * Trait SetEnvTrait
 * @package App\Http\Traits
 */
trait SetEnvTrait
{
    /**
     * @param $envKey
     * @param $envValue
     */
    public function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = env($envKey);

        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
}