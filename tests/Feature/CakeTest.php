<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CakeTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function test_create_cake()
    {
        $data = [
            "name" => "Bolo de chocolate ao leite",
            "weight" => "3.150",
            "price" => "150.00",
            "quantity" => "10",
        ];

        $response = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->post('/api/cakes', $data);

        $cake = $response->json();
        $data['id'] = $cake['data']['id'];
        $response->assertStatus(201);
        $response->assertJson(["data" => $data]);
    }

    /**
     *
     * @return void
     */
    public function test_get_cake()
    {
        $data = [
            "name" => "Bolo de chocolate ao leite",
            "weight" => "3.150",
            "price" => "150.00",
            "quantity" => "10",
        ];

        $responseAux = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->post('/api/cakes', $data);

        $cake = $responseAux->json();
        $cakeId = $cake['data']['id'];
        $response = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->get("/api/cakes/${cakeId}");

        $data['id'] = $cakeId;
        $response->assertStatus(200);
        $response->assertJson(["data" => $data]);
    }

    /**
     *
     * @return void
     */
    public function test_create_interest_email()
    {
        $responseAux = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->post('/api/cakes', [
            'name' => 'Bolo de chocolate ao leite',
            'weight' => '3.150',
            'price' => '150.00',
            'quantity' => '10',
        ]);

        $cake = $responseAux->json();
        $cakeId = $cake['data']['id'];
        $responseInterest = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->post("/api/cakes/${cakeId}/interest-list", [
            'email' => 'email@email.com',
        ]);

        $responseInterest->assertStatus(201);
    }


    /**
     *
     * @return void
     */
    public function test_create_cake_with_validate_error()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->post('/api/cakes', [
            'name' => 'Bolo de chocolate ao leite',
            'weight' => '3.150',
        ]);

        $response->assertStatus(422);
    }

    /**
     *
     * @return void
     */
    public function test_update_cake()
    {
        $data = [
            "name" => "Bolo de chocolate ao leite",
            "weight" => "3.150",
            "price" => "150.00",
            "quantity" => "10",
        ];
        $responseAux = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->post('/api/cakes', $data);

        $cake = $responseAux->json();
        $cakeId = $cake['data']['id'];
        $response = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->put("/api/cakes/${cakeId}", [
            'name' => 'Bolo de manga',
            'weight' => '5.150',
        ]);

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_delete_cake()
    {
        $responseAux = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->post('/api/cakes', [
            'name' => 'Bolo de chocolate ao leite',
            'weight' => '3.150',
            'price' => '150.00',
            'quantity' => '10',
        ]);

        $cake = $responseAux->json();
        $cakeId = $cake['data']['id'];
        $response = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->delete("/api/cakes/${cakeId}");

        $response->assertStatus(200);
    }
}
