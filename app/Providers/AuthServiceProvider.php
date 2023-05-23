<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Bin;
use App\Models\File;
use App\Models\Group;
use App\Models\GroupUser;
use App\Policies\BinPolicy;
use App\Policies\DirectoryPolicy;
use App\Policies\FilePolicy;
use App\Policies\GroupPolicy;
use App\Policies\GroupUserPolicy;
use Directory;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Bin::class => BinPolicy::class,
        Directory::class => DirectoryPolicy::class,
        Group::class => GroupPolicy::class,
        GroupUser::class => GroupUserPolicy::class,
        File::class => FilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
