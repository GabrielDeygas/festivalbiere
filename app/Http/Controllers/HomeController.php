<?php

namespace App\Http\Controllers;

use App\Repositories\BeerRepository;
use App\Models\Country;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $beerRepository;
    protected $countryRepository;

    public function __construct(BeerRepository $beerRepository, CountryRepository $countryRepository)
    {
        $this->beerRepository = $beerRepository;
        $this->countryRepository = $countryRepository;
    }

    public function index(Request $request)
    {
        $countries = Country::all();

        $filters = $request->only(['name', 'origin', 'type', 'category']);

        $beers = $this->beerRepository->getBeers($filters);

        return view('home', compact('beers', 'countries'));
    }
}
