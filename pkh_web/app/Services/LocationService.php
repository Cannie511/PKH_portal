<?php

namespace App\Services;

use Log;

/**
 * LocationService class
 */
class LocationService extends BaseService
{
    /**
     * @param $address
     * @return mixed
     */
    public function addressToLocation($address)
    {

        $result = null;
        $url    = "https://maps.googleapis.com/maps/api/geocode/json?key=" . env("GOOGLE_MAP_KEY_CONSOLE") . "&address=";

        try {
            $url .= urlencode($address);
            $response = file_get_contents($url);
            $response = json_decode($response);

            if (count($response->results) > 0) {
                Log::info(print_r($result, true));

                $result = [
                    "lat" => $response->results[0]->geometry->location->lat,
                    "lng" => $response->results[0]->geometry->location->lng,
                ];
            }

            return $result;
        } catch (\Exception $e) {
            Log::error($e);

            return $result;
        }

    }

}
