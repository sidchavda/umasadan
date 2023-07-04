<?php

namespace App\Providers; 

use Illuminate\Support\ServiceProvider;   
use App\Repositories\Interfaces\District\DistrictRepositoryInterface;
use App\Repositories\Implementation\District\DistrictRepository;
use App\Repositories\Interfaces\City\CityRepositoryInterface;
use App\Repositories\Implementation\City\CityRepository;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Implementation\User\UserRepository;
use App\Repositories\Interfaces\User\UserAddressRepositoryInterface;
use App\Repositories\Implementation\User\UserAddressRepository;

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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class); 
        $this->app->bind(UserAddressRepositoryInterface::class, UserAddressRepository::class);
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
