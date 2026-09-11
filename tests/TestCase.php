<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    public function postRequest(array $data, string $field, string $url): TestResponse
    {
        $data[$field] = null;
        return $this->postJson($url, $data);
    }
}
