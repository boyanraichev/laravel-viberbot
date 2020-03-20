<?php
namespace Boyo\Viberbot\Commands;

use Illuminate\Console\Command;
use Boyo\Viberbot\Http\ApiClient;

class Account extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'viberbot:account';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get your account info';
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
		    	        
	        $response = ApiClient::call('POST', 'get_account_info', []);
	        
	        if($response->status !== 0) {
	            throw new \Exception('Could not get account info! Error code: '. $response->status .' Error message: ' . $response->status_message);
	        }
	        
	        $this->info('Account info:');
	        
	        var_dump($response);
			
		} catch(\Exception $e) {
			
			$this->error($e->getMessage());
			
		}
    }
}