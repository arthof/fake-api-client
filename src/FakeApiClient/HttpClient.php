<?php

namespace FakeApiClient;

Use FakeApiClient\IHttpMethods;

class HttpClient implements IHttpMethods
{
    public $defaultCurlOptions;

    public function __construct()
    {
        $this->defaultCurlOptions = [
            CURLOPT_RETURNTRANSFER => 1,
        ];
    }

    public function ParseOptions(array $options=null)
    {
        $curlOptions=$this->defaultCurlOptions;
        if(is_array($options))
        {
            if(array_key_exists('url', $options))
                $curlOptions[CURLOPT_URL] = $options['url'];
            if(array_key_exists('body', $options))
                $curlOptions[CURLOPT_POSTFIELDS] = $options['body'];
            if(array_key_exists('headers', $options))
                $curlOptions[CURLOPT_HTTPHEADER] =$options['headers'];
        }
        return $curlOptions;
    }

    public function Get(array $options = null)
    {
        $curlOptions = $this->ParseOptions($options);
        return $this->Request($curlOptions);
    }

    public function Post(array $options = null)
    {
        $curlOptions = $this->ParseOptions($options);
        $curlOptions[CURLOPT_POST] = 1;
        return $this->Request($curlOptions);
    }

    public function Put(array $options = null)
    {
        $curlOptions = $this->ParseOptions($options);
        $curlOptions[CURLOPT_CUSTOMREQUEST] = 'PUT';
        return $this->Request($curlOptions);
    }

    public function Delete(array $options = null)
    {
        $curlOptions = $this->ParseOptions($options);
        $curlOptions[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        return $this->Request($curlOptions);    
    }

    public function Patch(array $options = null)
    {
        $curlOptions = $this->ParseOptions($options);
        $curlOptions[CURLOPT_CUSTOMREQUEST] = 'PATCH';
        return $this->Request($curlOptions);
    }

    public function Request(array $curlOptions=null)
    {
        if(!(is_array($curlOptions) && count($curlOptions)))
            return false;

        $ch=curl_init();
        foreach($curlOptions as $curlOption => $value)
            curl_setopt($ch, $curlOption, $value);        
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
