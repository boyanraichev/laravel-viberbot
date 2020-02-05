<?php
namespace Boyo\Viberbot\Http;

// use Curl\Curl;
use GuzzleHttp\Client as Guzzle;

class ApiClient
{

    public static $viber_url = 'https://chatapi.viber.com/pa/';

    public static $headers = [
        'X-Viber-Auth-Token' => '',
        'Content-Type' => 'application/json',
    ];

    public static function call(string $method, string $url, array $body = [], bool $baseUrlActive = true)
    {
        
        static::$headers['X-Viber-Auth-Token'] = config('viberbot.api_key');

        $client = new Guzzle();
        
        $response = $client->request($method, static::$viber_url . $url, [
			'headers' => static::$headers,
// 			'auth' => [$this->user,$this->key],
			'json' => $body,
		]);
		
		$status = $response->getStatusCode(); 
		
		if ($status!='200') {
			throw new \Exception('Unsuccessful connection to Viber services.');
		}
		
		$responseBody = json_decode($response->getBody());
		
		return $responseBody;
        
/*
        if ($method === 'POST') {
            $client->post(($baseUrlActive ? static::$BASE_URL : '').$url, json_encode($body));
            if ($client->error) {
                return json_encode('Error: '.$client->errorCode.': '.$client->errorMessage."\n");
            }
            return $client->response;
        }
        
        if ($method === 'GET') {
            $client->get(($baseUrlActive ? static::$BASE_URL : '').$url, $body);
            if ($client->error) {
                return json_encode('Error: '.$client->errorCode.': '.$client->errorMessage."\n");
            }
            return $client->response;
        }
        
        if ($method === 'PUT') {
            $client->put(($baseUrlActive ? static::$BASE_URL : '').$url, json_encode($body));
        }
        
        if ($method === 'PATCH') {
            $client->patch(($baseUrlActive ? static::$BASE_URL : '').$url, json_encode($body));
        }
*/
    
    }
}