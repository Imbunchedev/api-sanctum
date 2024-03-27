<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExternalApiService;

class CountriesController extends Controller
{
    protected $externalApiService;
    protected $api;

    public function __construct(ExternalApiService $externalApiService)
    {
        $this->externalApiService = $externalApiService;
        $this->api = 'https://restcountries.com/v3.1/all';
    }

    public function fetchDataFromApi()
    {
        $data = $this->externalApiService->fetchData($this->api);
        $data = collect($data);
        $data = $data->pluck('translations.spa.common')->toArray();
        sort($data);

        return response()->json($data);
    }
}
