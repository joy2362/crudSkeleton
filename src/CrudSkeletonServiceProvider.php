<?php

namespace Joy2362\CrudSkeleton;

use Illuminate\Support\ServiceProvider;
use Joy2362\CrudSkeleton\Console\CreateCrudOperation;

class CrudSkeletonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->runningInConsole()){
            $this->commands([
                CreateCrudOperation::class
            ]);
        }
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
