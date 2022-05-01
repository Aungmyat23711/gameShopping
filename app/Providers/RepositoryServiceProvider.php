<?php

namespace App\Providers;

use App\interfaces\addToCartInterface;
use App\interfaces\authInterface;
use App\interfaces\categoryInterface;
use App\interfaces\editionInterface;
use App\interfaces\favoriteInterface;
use App\interfaces\gameInterface;
use App\interfaces\orderInterface;
use App\interfaces\photoInterface;
use App\interfaces\platformInterface;
use App\interfaces\voiceInterface;
use App\repositories\addToCartRepository;
use App\repositories\authRepository;
use App\repositories\categoryRepository;
use App\repositories\editionRepository;
use App\repositories\favoriteRepository;
use App\repositories\gameRepository;
use App\repositories\orderRepository;
use App\repositories\photoRepository;
use App\repositories\platformRepository;
use App\repositories\voiceRepository;
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
     
      $this->app->bind(platformInterface::class,platformRepository::class);
      $this->app->bind(voiceInterface::class,voiceRepository::class);
      $this->app->bind(gameInterface::class,gameRepository::class);
      $this->app->bind(authInterface::class,authRepository::class);
      $this->app->bind(photoInterface::class,photoRepository::class);
      $this->app->bind(categoryInterface::class,categoryRepository::class);
      $this->app->bind(favoriteInterface::class,favoriteRepository::class);
      $this->app->bind(editionInterface::class,editionRepository::class);
      $this->app->bind(addToCartInterface::class,addToCartRepository::class);
      $this->app->bind(orderInterface::class,orderRepository::class);
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
