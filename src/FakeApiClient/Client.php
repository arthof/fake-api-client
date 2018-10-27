<?php

namespace FakeApiClient;

class Client
{
    
    public $Posts;

    public function __construct(string $baseUrl=null, IHttpMethods $httpClient=null)
    {
        $this->Posts = new Posts($baseUrl, $httpClient);
    }

}
