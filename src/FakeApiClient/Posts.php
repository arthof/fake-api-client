<?php

namespace FakeApiClient;

use FakeApiClient\Resources;

class Posts extends Resources
{
    const TYPE = 'posts';

    function FetchByUser(int $userId)
    {
        $url = $this->getUrl() . '?userId=' . $userId;
        $options = $this->PrepareOptions($url);
        $result = $this->httpClient->Get($options);
        $result = json_decode($result);
        return $result;
    }

    function FetchComments(int $id)
    {
        $url = $this->getUrl($id) . '/comments';
        $options = $this->PrepareOptions($url);
        $result = $this->httpClient->Get($options);
        $result = json_decode($result);
        return $result;
    }
}
