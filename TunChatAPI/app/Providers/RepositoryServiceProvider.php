<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->singleton(\App\Repositories\UserRepositoryInterface::class,
            \App\Repositories\Eloquent\UserRepository::class);

        $this->app->singleton(\App\Repositories\UserPasswordResetRepositoryInterface::class,
            \App\Repositories\Eloquent\UserPasswordResetRepository::class);

        $this->app->singleton(\App\Repositories\AdminUserRepositoryInterface::class,
            \App\Repositories\Eloquent\AdminUserRepository::class);

        $this->app->singleton(\App\Repositories\AdminUserRoleRepositoryInterface::class,
            \App\Repositories\Eloquent\AdminUserRoleRepository::class);

        $this->app->singleton(\App\Repositories\AdminPasswordResetRepositoryInterface::class,
            \App\Repositories\Eloquent\AdminPasswordResetRepository::class);

        $this->app->singleton(\App\Repositories\FileRepositoryInterface::class,
            \App\Repositories\Eloquent\FileRepository::class);

        $this->app->singleton(\App\Repositories\PushNotificationDeviceRepositoryInterface::class,
            \App\Repositories\Eloquent\PushNotificationDeviceRepository::class);

        $this->app->singleton(\App\Repositories\ServiceAuthenticationRepositoryInterface::class,
            \App\Repositories\Eloquent\ServiceAuthenticationRepository::class);

        $this->app->singleton(\App\Repositories\UserServiceAuthenticationRepositoryInterface::class,
            \App\Repositories\Eloquent\UserServiceAuthenticationRepository::class);

        $this->app->singleton(\App\Repositories\OauthClientRepositoryInterface::class,
            \App\Repositories\Eloquent\OauthClientRepository::class);

        $this->app->singleton(
            \App\Repositories\AccountRepositoryInterface::class,
            \App\Repositories\Eloquent\AccountRepository::class
        );

        $this->app->singleton(
            \App\Repositories\PageRepositoryInterface::class,
            \App\Repositories\Eloquent\PageRepository::class
        );

        $this->app->singleton(
            \App\Repositories\PageUserRepositoryInterface::class,
            \App\Repositories\Eloquent\PageUserRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CustomerRepositoryInterface::class,
            \App\Repositories\Eloquent\CustomerRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CustomerRepositoryInterface::class,
            \App\Repositories\Eloquent\CustomerRepository::class
        );


        $this->app->singleton(
            \App\Repositories\FeedRepositoryInterface::class,
            \App\Repositories\Eloquent\FeedRepository::class
        );

        $this->app->singleton(
            \App\Repositories\FeedRepositoryInterface::class,
            \App\Repositories\Eloquent\FeedRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CustomerCustomFieldRepositoryInterface::class,
            \App\Repositories\Eloquent\CustomerCustomFieldRepository::class
        );

        $this->app->singleton(
            \App\Repositories\TagRepositoryInterface::class,
            \App\Repositories\Eloquent\TagRepository::class
        );

        $this->app->singleton(
            \App\Repositories\TagCustomerRepositoryInterface::class,
            \App\Repositories\Eloquent\TagCustomerRepository::class
        );

        $this->app->singleton(
            \App\Repositories\SequenceCustomerRepositoryInterface::class,
            \App\Repositories\Eloquent\SequenceCustomerRepository::class
        );

        $this->app->singleton(
            \App\Repositories\SequenceRepositoryInterface::class,
            \App\Repositories\Eloquent\SequenceRepository::class
        );

        $this->app->singleton(
            \App\Repositories\SequenceMessageRepositoryInterface::class,
            \App\Repositories\Eloquent\SequenceMessageRepository::class
        );

        $this->app->singleton(
            \App\Repositories\MessageRepositoryInterface::class,
            \App\Repositories\Eloquent\MessageRepository::class
        );

        $this->app->singleton(
            \App\Repositories\ActionRepositoryInterface::class,
            \App\Repositories\Eloquent\ActionRepository::class
        );

        $this->app->singleton(
            \App\Repositories\KeywordRepositoryInterface::class,
            \App\Repositories\Eloquent\KeywordRepository::class
        );

        $this->app->singleton(
            \App\Repositories\KeywordActionRepositoryInterface::class,
            \App\Repositories\Eloquent\KeywordActionRepository::class
        );

        $this->app->singleton(
            \App\Repositories\MessageItemRepositoryInterface::class,
            \App\Repositories\Eloquent\MessageItemRepository::class
        );

        /* NEW BINDING */
    }
}
