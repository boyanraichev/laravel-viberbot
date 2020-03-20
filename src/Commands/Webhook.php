<?php
namespace Boyo\Viberbot\Commands;

use Illuminate\Console\Command;
use Boyo\Viberbot\Http\ApiClient;

class Webhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'viberbot:webhook {route : Webhook route name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register your webhook url with Viber';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    
	    try {
		    
	        $route = $this->argument('route');
	        
	        $this->info('Route: '.route($route));
	        
	        if (empty($route) OR empty(route($route))) {
		        
		        throw new \Exception('Route does not exist!');
		        
	        }
	        
	        $response = ApiClient::call('POST', 'set_webhook', [
	            'url' => route($route),
	            'event_types' => config('viberbot.event_types'),
/*
	            'send_name'=> true,
	            'send_photo'=> true,
*/
	        ]);
	        
	        if($response->status !== 0) {
	            throw new \Exception('Could not register webhook!',[
	            	'Error code' => $response->status,
	            	'Error message' => $response->status_message,
	            ]);
	        }
	        
	        $this->info('Webhook registered for events: '.implode(', ',$response->event_types));
			
		} catch(\Exception $e) {
			
			$this->error($e->getMessage());
			
		}
    }
}