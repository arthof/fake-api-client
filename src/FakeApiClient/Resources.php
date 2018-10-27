<?php

namespace FakeApiClient;

use FakeApiClient\HttpClient;

abstract class Resources
{
    const TYPE = '';
    protected $baseUrl;    
    protected $httpClient;
    
    public function __construct(string $baseUrl=null, IHttpMethods $httpClient=null)
    {
        if(!is_null($baseUrl))
            $this->baseUrl = $baseUrl;
        else
            $this->baseUrl = 'https://jsonplaceholder.typicode.com/';
        
        if(!is_null($httpClient))
            $this->httpClient = $httpClient;
        else
            $this->httpClient = new HttpClient();
    }

    public function GetUrl(int $id = null)
    {
        return $this->baseUrl . static::TYPE . '/' . $id;
    }

    public function PrepareOptions(string $url, array $body = null, array $headers = null)
    {
        $options = [];
        $options['url'] = $url;
        if(is_array($body))
            $options['body'] = json_encode($body);
        if(is_array($body))
            $options['headers'] = $headers;
        return $options;
    }

    public function Fetch(int $id)
    {

        $url = $this->GetUrl($id);
        $options = $this->PrepareOptions($url);
        $result = $this->httpClient->Get($options);
        $result = json_decode($result);
        return $result;
    }

    public function FetchAll()
    {
        $url = $this->GetUrl();
        $options = $this->PrepareOptions($url);
        $result = $this->httpClient->Get($options);
        $result = json_decode($result);
        return $result;
    }

    public function Create(array $data)
    {
        $url = $this->GetUrl();
        $headers = ['Content-Type: application/json; charset=UTF-8'];
        $options = $this->PrepareOptions($url, $data, $headers);
        $result = $this->httpClient->Post($options);
        $result = json_decode($result);
        return $result;
    }

    public function Replace(int $id, array $data)
    {
        $url = $this->GetUrl($id);
        $headers = ['Content-Type: application/json; charset=UTF-8'];
        $options = $this->PrepareOptions($url, $data, $headers);
        $result = $this->httpClient->Put($options);
        $result = json_decode($result);
        return $result;
    }

    public function Update(int $id, array $data)
    {
        $url = $this->GetUrl($id);
        $headers = ['Content-Type: application/json; charset=UTF-8'];
        $options = $this->PrepareOptions($url, $data, $headers);
        $result = $this->httpClient->Patch($options);
        $result = json_decode($result);
        return $result;
    }

    public function Delete(int $id)
    {
        $url = $this->GetUrl($id);
        $options = $this->PrepareOptions($url);
        $result = $this->httpClient->Delete($options);
        $result = json_decode($result);
        return $result;
    }

}