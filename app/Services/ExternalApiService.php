<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExternalApiService
{
    public function __construct()
    {

    }

    public function fetchData($url)
    {
        $response = Http::withoutVerifying()->get($url);
        return $response->json();
    }
}