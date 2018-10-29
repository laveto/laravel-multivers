<?php

namespace Laveto\LaravelMultivers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class Multivers
{
    protected $accessToken = null;
    protected $connection = 'default';
    protected $database = 'default';
    protected $apiUrl = null;

    public function __construct()
    {
        $this->connection(config('multivers.default'));
    }

    protected function connectionConfig($key)
    {
        return config('multivers.connections.' . $this->connection . '.' . $key);
    }

    public function connection($connection)
    {
        // Check if connection exists in config.
        if(!config('multivers.connections.' . $connection))
            throw new \Exception('Connection "' . $connection . '" does not exists in config file.');

        // Set connection.
        $this->connection = $connection;

        // Check if connection exists in config.
        if(!filter_var($this->connectionConfig('api_url'), FILTER_VALIDATE_URL))
            throw new \Exception('Invalid api_url given in config file.');

        // Set API url.
        $this->apiUrl = $this->connectionConfig('api_url');

        // Check if database exists in config.
        if(!$this->connectionConfig('database'))
            throw new \Exception('Connection "' . $connection . '" does not exists in config file.');

        // Set database.
        $this->database = $this->connectionConfig('database');

        return $this;
    }

    protected function initAccessToken()
    {
        // Return from cache?
        if(Cache::has('LaravelMultivers.accessToken'))
        {
            // Set access token from cache.
            $this->accessToken = Cache::get('LaravelMultivers.accessToken');

            // Return status.
            return true;
        }

        // Request new access token.
        $res = (new Client)->request('POST', $this->connectionConfig('api_url') . '/OAuth/Token', [
            'form_params' => [
                'refresh_token' => $this->connectionConfig('refresh_token'),
                'client_id' => $this->connectionConfig('client_id'),
                'client_secret' => $this->connectionConfig('client_secret'),
                'grant_type' => $this->connectionConfig('grant_type')
            ]
        ]);

        // JSON decode.
        $result = json_decode($res->getBody()->getContents(), true);

        // Error due to no access_token received?
        if(!@$result['access_token'])
            throw new Exception('No access token received!');

        // Save access token to cache.
        Cache::put('LaravelMultivers.accessToken', $result['access_token'], $result['expires_in'] / 60 - 5);

        // Set access token.
        $this->accessToken = $result['access_token'];

        // Return status.
        return true;
    }

    public function get($action, $parameters = [])
    {
        return $this->request('GET', $action, $parameters);
    }

    public function post($action, $parameters)
    {
        return $this->request('POST', $action, $parameters);
    }

    public function put($action, $parameters)
    {
        return $this->request('PUT', $action, $parameters);
    }

    public function delete($action, $parameters)
    {
        return $this->request('DELETE', $action, $parameters);
    }

    protected function request($method, $action, $parameters = [])
    {
        // Get access token.
        if(!$this->accessToken)
            $this->initAccessToken();

        // Make request.
        $res = (new Client)->request($method, $this->apiUrl . '/api/' . $this->database . '/' . $action, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json'
            ],
            ($method == 'GET' ? 'query' : 'form_params') => $parameters,
        ]);

        // JSON decode.
        $result = json_decode($res->getBody()->getContents(), true);

        // Return result.
        return $result;
    }
}
