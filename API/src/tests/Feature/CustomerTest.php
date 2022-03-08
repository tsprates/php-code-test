<?php

namespace Tests\Feature;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    private static $faker;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        static::$faker = Faker::create();
    }

    /**
     * Helper function for mocking customers.
     *
     * @return array Customer array
     */
    private function mockCustomer()
    {
        $faker = static::$faker;

        return [
            'name' =>  $faker->name(),
            'email' => $faker->safeEmail(),
            'phone' => $faker->phoneNumber(),
            'address' => [
                'number' => $faker->buildingNumber(),
                'street' => $faker->streetName(),
                'city' => $faker->city(),
                'state' => $faker->state(),
                'country' => $faker->country(),
            ]
        ];
    }

    public function test_create_new_customer()
    {
        Storage::fake('public');

        $response = $this->post('/api/customers', $this->mockCustomer());
        $response->assertStatus(201);
        $response->assertJsonFragment(['success' => true]);

        Storage::disk('public')->assertExists('customers.txt');
    }

    public function test_tries_to_create_a_customer_without_name()
    {
        $customer =  $this->mockCustomer();
        unset($customer['name']);

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'name' => [
                'The name field is required.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_with_name_length_less_than_five_letters()
    {
        $customer = $this->mockCustomer();
        $customer['name'] = 'test'; // length < 5

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'name' => [
                'The name must be at least 5 characters.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_with_invalid_email()
    {
        $customer = $this->mockCustomer();
        $customer['email'] = 'invalid';

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'email' => [
                'The email must be a valid email address.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_without_email()
    {
        $customer = $this->mockCustomer();
        unset($customer['email']);

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'email' => [
                'The email field is required.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_without_phone_number()
    {
        $customer = $this->mockCustomer();
        unset($customer['phone']);

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'phone' => [
                'The phone field is required.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_with_invalid_house_number()
    {
        $customer = $this->mockCustomer();
        $customer['address']['number'] = 'invalid';

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'address.number' => [
                'The address.number must be an integer.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_with_wrong_house_number()
    {
        $customer = $this->mockCustomer();
        $customer['address']['number'] = '0'; // invalid zero number

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'address.number' => [
                'The address.number must be at least 1.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_without_house_number()
    {
        $customer = $this->mockCustomer();
        unset($customer['address']['number']);

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'address.number' => [
                'The address.number field is required.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_without_street()
    {
        $customer = $this->mockCustomer();
        unset($customer['address']['street']);

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'address.street' => [
                'The address.street field is required.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_without_city()
    {
        $customer = $this->mockCustomer();
        unset($customer['address']['city']);

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'address.city' => [
                'The address.city field is required.'
            ]
        ]);
    }

    public function test_tries_to_create_a_customer_without_country()
    {
        $customer = $this->mockCustomer();
        unset($customer['address']['country']);

        $response = $this->post('/api/customers', $customer);
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'success' => false,
            'address.country' => [
                'The address.country field is required.'
            ]
        ]);
    }
}
