<?php

namespace App\Http\Controllers;

use App\Services\HotelService;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    protected HotelService $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index(): JsonResponse
    {
        try {
            $rooms = $this->hotelService->getCheapestRooms();
            
            return response()->json([
                'status' => 'success',
                'data' => $rooms
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!'
            ], 500);
        }
    }
}