<?php

namespace App\Providers; 

use Illuminate\Support\ServiceProvider;   
use App\Repositories\Interfaces\District\DistrictRepositoryInterface;
use App\Repositories\Implementation\District\DistrictRepository;
use App\Repositories\Interfaces\City\CityRepositoryInterface;
use App\Repositories\Implementation\City\CityRepository;


class RepositoryServiceProvider extends ServiceProvider 
{
    /**
     * Register services.
     *
     * @return void
     */ 
    public function register()   
    {  
        
        $this->app->bind(DistrictRepositoryInterface::class, DistrictRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
    } 

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() 
    {
        //
    }
}
