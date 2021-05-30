<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// use Faker\Factory as FakerFactory;
// use Faker\Generator as FakerGenerator;
// use Salopot\ImageGenerator\ImageSources\Local;
// use Salopot\ImageGenerator\ImageSources\Remote;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(FakerGenerator::class, function ($app) {
        //     $generator =  FakerFactory::create($app['config']->get('app.faker_locale', 'en_US'));
            
        //     // Additional faker providers
        //     $imageProvider = new \Salopot\ImageGenerator\ImageProvider($generator);
        //     $imageProvider->addImageSource(new Local\SolidColorSource($imageProvider));
        //     $imageProvider->addImageSource(new Local\GallerySource($imageProvider, '/dir/with/images'));
        //     $imageProvider->addImageSource(new Local\SolidColorSource($imageProvider));
        //     $imageProvider->addImageSource(new Remote\LoremPixelSource($imageProvider));
        //     $imageProvider->addImageSource(new Remote\PicsumPhotosSource($imageProvider));
        //     // $imageProvider->addImageSource(new cRemote\UnsplashSource($imageProvider));
        //     $imageProvider->addImageSource(new Remote\PlaceKittenSource($imageProvider));
        //     $imageProvider->addImageSource(new Remote\PlaceImgSource($imageProvider));
        //     $generator->addProvider($imageProvider);
        
        //    return $generator;
        // });
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
