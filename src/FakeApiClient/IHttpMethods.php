<?php

namespace FakeApiClient;

interface IHttpMethods
{
    public function Get(array $options = null);
    public function Post(array $options = null);
    public function Put(array $options = null);
    public function Delete(array $options = null);
    public function Patch(array $options = null);
}
