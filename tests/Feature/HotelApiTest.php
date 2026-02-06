<?php

namespace Tests\Feature;

use Tests\TestCase;

class HotelApiTest extends TestCase
{
    /** @test */
    public function test_hotel_api_returns_success_and_correct_structure()
    {
        $response = $this->getJson('/api/hotels');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'name',
                    'room_code',
                    'total_price',
                    'source'
                ]
            ]
        ]);
    }

    /** @test */
    public function test_data_is_sorted_by_price_ascending()
    {
        $response = $this->getJson('/api/hotels');
        $data = $response->json('data');

        if (count($data) > 1) {
            $firstPrice = $data[0]['total_price'];
            $secondPrice = $data[1]['total_price'];
            
            // نتأكد إن أول سعر أصغر من أو يساوي تاني سعر (الترتيب)
            $this->assertTrue($firstPrice <= $secondPrice);
        }
    }
}