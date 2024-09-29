<?php

// app/Http/Controllers/HotelController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HotelController extends Controller
{
    public function search(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $checkinDate = $request->input('checkin_date');
        $checkoutDate = $request->input('checkout_date');
        $adultsNumber = $request->input('adults_number', 2); // default to 2
        $childrenNumber = $request->input('children_number', 0); // default to 0
        $roomNumber = $request->input('room_number', 1); // default to 1

        $client = new Client();

        $response = $client->request('GET', 'https://booking-com.p.rapidapi.com/v1/hotels/search-by-coordinates', [
            'headers' => [
                'x-rapidapi-host' => 'booking-com.p.rapidapi.com',
                'x-rapidapi-key' => 'YOUR_RAPIDAPI_KEY', // Replace with your RapidAPI key
            ],
            'query' => [
                'adults_number' => $adultsNumber,
                'checkin_date' => $checkinDate,
                'checkout_date' => $checkoutDate,
                'children_number' => $childrenNumber,
                'room_number' => $roomNumber,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'locale' => 'en-gb',
                'units' => 'metric',
                'order_by' => 'popularity',
                'include_adjacency' => true,
                'page_number' => 0,
                'categories_filter_ids' => 'class::2,class::4,free_cancellation::1',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
    public function show($id)
    {
        // Fetch the hotel details from the database using the ID
        $hotel = Hotel::find($id); // Adjust according to your model
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }
        return response()->json($hotel);
    }

    public function getDetails($id, Request $request)
    {
        $client = new Client();
        
        try {
            $response = $client->request('GET', "https://booking-com15.p.rapidapi.com/api/v1/hotels/getHotelDetails", [
                'query' => [
                    'hotel_id' => $id,
                    'arrival_date' => $request->input('arrival_date', '2024-10-01'), // You can adjust default values
                    'departure_date' => $request->input('departure_date', '2024-10-09'),
                    'adults' => $request->input('adults', 1),
                    'children_age' => $request->input('children_age', '1,17'),
                    'room_qty' => $request->input('room_qty', 1),
                    'units' => 'metric',
                    'temperature_unit' => 'c',
                    'languagecode' => 'en-us',
                    'currency_code' => 'EUR',
                ],
                'headers' => [
                    'x-rapidapi-host' => 'booking-com15.p.rapidapi.com',
                    'x-rapidapi-key' => '9d1b5dd2c7mshe5be64a37890943p1344e3jsn4103bbc7ac5c', // Replace with your actual API key
                ],
            ]);

            return response()->json(json_decode($response->getBody()), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch hotel details'], 500);
        }
    }

}

