# Hotel Aggregator Challenge

A robust PHP/Laravel solution that fetches hotel room data from multiple third-party APIs, normalizes the data, filters duplicates by keeping the lowest price, and sorts the results.

## 🚀 Features
- **Data Aggregation:** Consolidates data from 3 different API providers.
- **Smart Filtering:** Automatically removes duplicate rooms for the same hotel, showing only the best price.
- **Sorting:** Results are sorted from cheapest to most expensive.
- **Reliability:** Built-in error handling (Log & Fallback) in case any provider API is down.
- **Design Patterns:** Implemented using the **Strategy Pattern** for providers and a **Service Layer** for business logic.

## 🛠️ Tech Stack
- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** HTML5, Bootstrap 5, jQuery (AJAX)
- **Tools:** Guzzle/Http Client, Postman for testing.

## ⚙️ Installation & Setup

1. **Clone the repository:**
   git clone [https://github.com/SHeno-hub/hotel-aggregator-challenge.git](https://github.com/SHeno-hub/hotel-aggregator-challenge.git)

2.Install dependencies:
    composer install

3.Environment Setup:
    Copy .env.example to .env.
    Update ADVERTISER_X_URL with the actual API links provided in the task.

4.Run the application:
    php artisan serve
    Access the UI at http://127.0.0.1:8000 or the API at /api/hotels.

Testing:
You can test the endpoint using Postman:
    Method: GET
    URL: http://127.0.0.1:8000/api/hotels
