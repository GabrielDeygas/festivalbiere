<?php 

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    public function getCountries() 
    {
        return Country::all();
    }

}
