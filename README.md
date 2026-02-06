# Hotel Aggregator Service

This project is a technical assessment developed with Laravel to demonstrate best practices in data aggregation, OOP design, and API integration. The service fetches hotel room availability from three different third-party advertisers, normalizes their varied data structures, and presents a consolidated list.

## Core Requirements Met
- Data Aggregation: Consolidates data from 3 different API providers.
- Deduplication: Merges rooms with the same code per hotel, prioritizing the lowest price.
- Data Consistency: Normalizes different JSON structures into a unified DTO format.
- Reliability: Graceful handling of API failures or timeouts via logging and fallbacks.
- Sorting: Results are delivered sorted ascending by total price.

## Architectural Decisions
To ensure the code is easily extensible (as required in the assessment), the following patterns were implemented:
- Strategy Pattern: Each Advertiser has its own Provider class implementing a HotelProviderInterface. This allows adding new advertisers without modifying existing core logic.
- Service Layer: The HotelService handles the business logic (filtering and sorting), keeping the Controller focused only on the request/response flow.
- Data Transfer Objects (DTO): Used to maintain strict data structures between the providers and the final output.

## Tech Stack
- Framework: Laravel 11 (PHP 8.2+)
- HTTP Client: Laravel Http Facade (Guzzle)
- Frontend: Bootstrap 5 and jQuery (AJAX integration)
- API Testing: Postman

## Installation and Setup

1. Clone the repository:
   git clone https://github.com/SHeno-hub/hotel-aggregator-challenge.git

2. Install dependencies:
   composer install

3. Environment Configuration:
   - Copy .env.example to .env
   - Add the Advertiser API endpoints provided in the assessment to your .env file:
     ADVERTISER_1_URL=
     ADVERTISER_2_URL=
     ADVERTISER_3_URL=
     
4. Execution:
   php artisan serve

   - Web UI: http://localhost:8000 (Displays the results in a responsive grid)
   - API Endpoint: GET /api/hotels

## API Response Format
The API returns a JSON response with the following structure:
{
    "status": "success",
    "data": [
        {
            "name": "Hotel Name",
            "room_code": "CODE",
            "total_price": 100.00,
            "source": "Advertiser X"
        }
    ]
}