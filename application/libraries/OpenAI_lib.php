<?php
use OpenAI\Api\Client;
class OpenAI_lib
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['api_key' => config_item('openai_api_key')]);
    }

    public function call_api($model, $data)
    {
        return $this->client->call_api($model, $data);
    }
}
