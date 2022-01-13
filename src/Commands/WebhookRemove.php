<?php
namespace Boyo\Viberbot\Commands;

use Illuminate\Console\Command;

use Boyo\Viberbot\Http\ApiClient;
use Boyo\Viberbot\Exceptions\ViberBotException;

class WebhookRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'viberbot:disable';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove your webhook url from Viber';
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
		    	        
	        $response = ApiClient::call('POST', 'set_webhook', [
	            'url' => '',
	        ]);
	        	        
	        $this->info('Webhook removed!');
			
		} catch(\Exception $e) {
			
            if (!$e instanceof ViberBotException) {
                Log::debug($e);
            }
            
			$this->error($e->getMessage());
			
		}
    }
}