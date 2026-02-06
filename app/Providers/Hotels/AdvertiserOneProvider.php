<?php

namespace App\Providers\Hotels;

use App\Contracts\HotelProviderInterface;
use App\DTOs\HotelRoomDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdvertiserOneProvider implements HotelProviderInterface
{
    private string $url;

    public function __construct()
    {
        $this->url = config('hotels.providers.advertiser_1');
    }

    public function fetchRawData(): array
    {
        try {
            // تنفيذ طلب حقيقي للـ API مع وقت انتظار 5 ثواني عشان السيستم ميعلقش
            $response = Http::timeout(5)->get($this->url);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            return [];
        } catch (\Exception $e) {
            // تسجيل الخطأ لو الـ API وقع (Reliability)
            Log::error("Advertiser 1 API Error: " . $e->getMessage());
            return [];
        }
    }

    public function formatData(array $rawData): array
    {
        $formatted = [];
        foreach ($rawData as $hotel) {
            $hotelName = $hotel['name'] ?? 'Unknown Hotel';
            $rooms = $hotel['rooms'] ?? [];
            
            foreach ($rooms as $room) {
                $formatted[] = new HotelRoomDTO(
                    $hotelName,
                    $room['code'] ?? 'N/A',
                    // بنحاول ناخد السعر من totalPrice أو total
                    (float) ($room['totalPrice'] ?? ($room['total'] ?? 0)),
                    "Advertiser 1"
                );
            }
        }
        return $formatted; 
    }
}