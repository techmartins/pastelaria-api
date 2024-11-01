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

    public function testGetCustomers()
    {
        $response = $this->http->request('GET', 'http://localhost:8000/customers');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCreateCustomer()
    {
        $faker = Faker::create();
        $data = [
            'name' => $faker->name,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date,
            'address' => $faker->streetAddress,
            'complement' => $faker->secondaryAddress,
            'neighborhood' => $faker->city,
            'zipcode' => $faker->postcode,
            'register_in' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
        ];

        try {
            $response = $this->http->request('POST', 'http://localhost:8000/customers', [
                'json' => $data
            ]);

            $this->assertEquals(201, $response->getStatusCode());
            $this->assertJson($response->getBody()->getContents());
        } catch (\Exception $e) {
            // Logar a exceção para análise posterior
            $this->fail('Erro ao criar cliente: ' . $e->getMessage());
        }
    }

    public function testUpdateCustomer()
    {
        // Create a customer first
        $faker = Faker::create();
        $data = [
            'name' => $faker->name,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date,
            'address' => $faker->streetAddress,
            'complement' => $faker->secondaryAddress,
            'neighborhood' => $faker->city,
            'zipcode' => $faker->postcode,
            'register_in' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
        ];

        $response = $this->http->request('POST', 'http://localhost:8000/customers', [
            'json' => $data
        ]);

        $customerId = json_decode($response->getBody()->getContents())->id;

        // Update the customer
        $updateData = [
            'name' => 'Updated Name',
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'birthday' => $faker->date,
            'address' => $faker->streetAddress,
            'complement' => $faker->secondaryAddress,
            'neighborhood' => $faker->city,
            'zipcode' => $faker->postcode,
            'register_in' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
        ];

        $response = $this->http->request('PUT', 'http://localhost:8000/customers/' . $customerId, [
            'json' => $updateData
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody()->getContents());
    }

    public function testDeleteCustomer()
    {
        // Create a customer first
        $faker = Faker::create();
        $data = [
            'name' => $faker->name,
            'email' => $faker->email,
            // Add other fields as needed
        ];

        $response = $this->http->request('POST', 'http://localhost:8000/customers', [
            'json' => $data
        ]);

        $customerId = json_decode($response->getBody()->getContents())->id;

        // Delete the customer
        $response = $this->http->request('DELETE', 'http://localhost:8000/customers/' . $customerId);

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEmpty($response->getBody()->getContents());
    }
}
