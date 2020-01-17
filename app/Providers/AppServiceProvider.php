<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Publisher\IPublisherRepository',
            'App\Publisher\EloquentPublisherRepository'
        );
		$this->app->bind(
			'App\Book\IBookRepository',
            'App\Book\EloquentBookRepository'
		);
		$this->app->bind(
			'App\Author\IAuthorRepository',
            'App\Author\EloquentAuthorRepository'
		);
		$this->app->bind(
			'App\SpecialPrice\ISpecialPriceRepository',
            'App\SpecialPrice\EloquentSpecialPriceRepository'
		);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
