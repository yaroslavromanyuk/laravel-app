<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user) {
            if ($user->role === 'Superadmin') {
                return true;
            }

            return null;
        });

        Gate::define('view_user', function (User $user) {
            return (bool)$user->id;
        });

        Gate::define('create_user', function (User $user) {
            return (bool)$user->id;
        });

        Gate::define('edit_user', function (User $user, User $editedUser) {
            return $user->role === 'Editor' || (int)$user->id === (int)$editedUser->creator_user_id;
        });

        Gate::define('delete_user', function (User $user, User $editedUser) {
            return (int)$editedUser->creator_user_id === (int)$user->id;
        });
    }
}
