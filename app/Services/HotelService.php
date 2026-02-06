<?php

namespace App\Services;

use App\Providers\Hotels\AdvertiserOneProvider;
use App\Providers\Hotels\AdvertiserTwoProvider;
use App\Providers\Hotels\AdvertiserThreeProvider;

class HotelService
{
    protected array $providers;

    public function __construct(
        AdvertiserOneProvider $p1,
        AdvertiserTwoProvider $p2,
        AdvertiserThreeProvider $p3
    ) {
        // حقن التبعيات (Dependency Injection)
        $this->providers = [$p1, $p2, $p3];
    }

    public function getCheapestRooms(): array
    {
        $allRooms = [];

        // 1. تجميع البيانات من كل المصادر
        foreach ($this->providers as $provider) {
            $rawData = $provider->fetchRawData();
            $formattedData = $provider->formatData($rawData);
            $allRooms = array_merge($allRooms, $formattedData);
        }

        // 2. الفلترة (إزالة التكرار مع الاحتفاظ بالأرخص)
        $uniqueRooms = [];
        foreach ($allRooms as $room) {
            // مفتاح فريد للفندق والغرفة معاً
            $key = $room->name . '-' . $room->room_code;

            if (!isset($uniqueRooms[$key]) || $room->total_price < $uniqueRooms[$key]->total_price) {
                $uniqueRooms[$key] = $room;
            }
        }

        // 3. الترتيب من الأرخص للأغلى
        $result = array_values($uniqueRooms);
        usort($result, function ($a, $b) {
            return $a->total_price <=> $b->total_price;
        });

        return $result;
    }
}