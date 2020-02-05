<?php
namespace Boyo\Viberbot;

use Illuminate\Support\ServiceProvider;

class ViberbotServiceProvider extends ServiceProvider
{
	
	/**
     * The package's controllers.
     */
	protected $controllers = [
		'Boyo\Viberbot\Http\Controllers\ViberbotController',
    ];
    
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
	    
        $this->publishable();

		$this->registerCommands();
    
    }

	/**
     * Register the application services.
     *
     * @return void
     */
    public function register() {

		$this->mergeConfigFrom(
	        __DIR__.'/../config/viberbot.php', 'viberbot	'
	    );
	    
    }

	public function publishable() {
		
		/*
		* vendor:publish --tag=viberBot - publishes config
		*/
		$this->publishes([
	        __DIR__.'/../config/viberbot.php' => config_path('viberbot.php'),
	    ], 'viberBot');
	    
	}

	public function registerCommands() {
		
		if ($this->app->runningInConsole()) {
	        $this->commands([
	            \Boyo\Viberbot\Commands\Webhook::class,
	            \Boyo\Viberbot\Commands\WebhookRemove::class,
	            \Boyo\Viberbot\Commands\Account::class,
	        ]);
	    }
	    
	}
	
	public function registerControllers() {
		
		foreach ($this->controllers as $key => $controller) {
			App::make($controller);
		}
		
	}

}