<?php

namespace Joy2362\CrudSkeleton;

use Illuminate\Support\ServiceProvider;
use Joy2362\CrudSkeleton\Console\CreateCrudOperation;
use Joy2362\CrudSkeleton\Interface\CrudOperation;

class CrudSkeletonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
     
         $this->app->singleton(CrudOperation::class,
         CrudOperation::class);
        $this->commands([
            CreateCrudOperation::class
        ]);
        
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