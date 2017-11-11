<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Services\UserServiceInterface::class, \App\Services\Production\UserService::class);

        $this->app->singleton(\App\Services\FileServiceInterface::class, \App\Services\Production\FileService::class);

        $this->app->singleton(\App\Services\AdminUserServiceInterface::class,
            \App\Services\Production\AdminUserService::class);

        $this->app->singleton(\App\Services\APIUserServiceInterface::class,
            \App\Services\Production\APIUserService::class);

        $this->app->singleton(\App\Services\APIUserServiceInterface::class,
            \App\Services\Production\APIUserService::class);

        $this->app->singleton(\App\Services\ServiceAuthenticationServiceInterface::class,
            \App\Services\Production\ServiceAuthenticationService::class);

        $this->app->singleton(\App\Services\UserServiceAuthenticationServiceInterface::class,
            \App\Services\Production\UserServiceServiceAuthenticationService::class);

        $this->app->singleton(\App\Services\OAuthServiceInterface::class, \App\Services\Production\OAuthService::class);

        $this->app->singleton(
            \App\Services\PushNotificationServiceInterface::class,
            \App\Services\Production\PushNotificationService::class
        );

        $this->app->singleton(
            \App\Services\FcmServiceInterface::class,
            \App\Services\Production\FcmService::class
            );

        $this->app->singleton(
            \App\Services\FirebaseServiceInterface::class,
            \App\Services\Production\FirebaseService::class
        );

        $this->app->singleton(
            \App\Services\MessagingServiceInterface::class,
            \App\Services\Production\MessagingService::class
        );

        $this->app->singleton(
            \App\Services\FaceBookServiceInterface::class,
            \App\Services\Production\FaceBookService::class
        );

        /* NEW BINDING */
    }
}
