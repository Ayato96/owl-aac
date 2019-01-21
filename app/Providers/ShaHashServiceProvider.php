<?php
namespace App\Providers;

use App\Libraries\ShaHasher;
use Illuminate\Hashing\HashServiceProvider;

class ShaHashServiceProvider extends HashServiceProvider {

	public function register()
	{
		$this->app->singleton('hash', function() { return new ShaHasher; });
	}

}