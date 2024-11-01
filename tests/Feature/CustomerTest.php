<?php

namespace Tests\Feature;

use Faker\Factory as Faker;
use App\Models\Customer;
use App\Models\Product;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as Guzzle;

class CustomerTest extends TestCase
{
    private $http;

    public function setUp(): void
    {
        $this->http = new Guzzle(['http_errors' => false]);
    }

    public function tearDown(): void
    {
        $this->http = null;
    }

    public  function testGetCustomers()
    {
        // $customer = $this->createStub(Customer::class);
        $response = $this->http->request('GET', 'http://localhost:8000/customers');

        $this->assertEquals(200, $response->getStatusCode());

        // $body = json_decode($response->getBody()->getContents());
    }
}
