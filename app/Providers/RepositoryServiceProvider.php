<?php

namespace App\Providers;

use App\Repositories\EloquentFlashCardRepository;

use App\Repositories\Interfaces\FlashcardRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(FlashcardRepository::class, EloquentFlashcardRepository::class);
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
