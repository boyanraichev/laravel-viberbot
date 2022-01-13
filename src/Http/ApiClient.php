<?php
namespace Boyo\Viberbot\Http;

// use Curl\Curl;
use GuzzleHttp\Client as Guzzle;

use Illuminate\Support\Facades\Log;

class ApiClient
{
	
	private static $log = false;

	private static $send = true;
		
    public static $viber_url = 'https://chatapi.viber.com/pa/';

    public static $headers = [
        'X-Viber-Auth-Token' => '',
        'Content-Type' => 'application/json',
    ];

    public static function call(string $method, string $endpoint, array $body = [])
    {
        
        static::$log = config('viberbot.log');
        
        static::$send = config('viberbot.send');
        
        if (static::$log) {
			Log::channel('viberbot')->info('Viberbot message',[
		        'endpoint' => static::$viber_url . $endpoint,
		        'body' => empty($body) ? '{}' : json_encode($body, JSON_UNESCAPED_UNICODE),
		        'send' => static::$send,
			]);
        }
        
        if (static::$send) {
	        
	        static::$headers['X-Viber-Auth-Token'] = config('viberbot.api_key');
	
	        $client = new Guzzle();
	        
	        $response = $client->request($method, static::$viber_url . $endpoint, [
				'headers' => static::$headers,
	// 			'auth' => [$this->user,$this->key],
				'body' => empty($body) ? '{}' : json_encode($body),
			]);
			
			$status = $response->getStatusCode(); 
			
			if (static::$log) {
				Log::channel('viberbot')->info('Viberbot message response',[
					'status' => $status,
				]);
			}
			
			if ($status!='200') {
				throw new \Exception('Unsuccessful connection to Viber services.');
			}
			
			$responseBody = json_decode($response->getBody());		
			
			return $responseBody;
		
		}	        
		
/*
        if ($method === 'POST') {
            $client->post(($baseUrlActive ? static::$BASE_URL : '').$url, json_encode($body));
            if ($client->error) {
                return json_encode('Error: '.$client->errorCode.': '.$client->errorMessage."\n");
            }
            return $client->response;
        }
        
*/
    
    }
}