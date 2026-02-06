<?php

namespace App\DTOs;

class HotelRoomDTO
{
    public string $name;
    public string $room_code;
    public float $total_price;
    public string $source;

    public function __construct(string $name, string $room_code, float $total_price, string $source)
    {
        $this->name = $name;
        $this->room_code = $room_code;
        $this->total_price = $total_price;
        $this->source = $source;
    }
}