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
use App\Repositories\Interfaces\Category\CategoryRepositoryInterface;
use App\Repositories\Implementation\Category\CategoryRepository;
use App\Repositories\Interfaces\Category\SubCategoryRepositoryInterface;
use App\Repositories\Implementation\Category\SubCategoryRepository;
use App\Repositories\Interfaces\Degree\DegreeRepositoryInterface;
use App\Repositories\Implementation\Degree\DegreeRepository;
use App\Repositories\Interfaces\Degree\SubDegreeRepositoryInterface;
use App\Repositories\Implementation\Degree\SubDegreeRepository;
use App\Repositories\Interfaces\Business\BusinessRepositoryInterface;
use App\Repositories\Implementation\Business\BusinessRepository;
use App\Repositories\Interfaces\Business\BusinessDetailRepositoryInterface;
use App\Repositories\Implementation\Business\BusinessDetailRepository;
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
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);
        $this->app->bind(DegreeRepositoryInterface::class, DegreeRepository::class);
        $this->app->bind(SubDegreeRepositoryInterface::class, SubDegreeRepository::class);
        $this->app->bind(BusinessRepositoryInterface::class, BusinessRepository::class);  
        $this->app->bind(BusinessDetailRepositoryInterface::class, BusinessDetailRepository::class);  
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
