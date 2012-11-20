<?php

require_once './init.php';

class ServiceTest extends PHPUnit_Framework_TestCase
{
    private $key;
    private $secret;

    public function setUp()
    {
        $this->key = getenv('GENGO_PUBKEY');
        $this->secret = getenv('GENGO_PRIVKEY');
    }

    public function test_get_language_pairs()
    {
        $service = Gengo_Api::factory('service', $this->key, $this->secret);
        $service->setBaseUrl('http://sandbox.gengo.com/v2/');

        $service->getLanguagePairs();
        $body = $service->getResponseBody();
        $response = json_decode($body, true);
        $this->assertEquals($response['opstat'], 'ok');
        $this->assertTrue(isset($response['response']));

    }

    public function test_get_languages()
    {
        $service = Gengo_Api::factory('service', $this->key, $this->secret);
        $service->setBaseUrl('http://sandbox.gengo.com/v2/');

        $service->getLanguages();
        $body = $service->getResponseBody();
        $response = json_decode($body, true);
        $this->assertEquals($response['opstat'], 'ok');
        $this->assertTrue(isset($response['response']));
        $this->assertTrue(isset($response['response']['credits_spent']));
        $this->assertTrue(isset($response['response']['user_since']));

    }
}
