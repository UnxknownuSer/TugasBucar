<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Journal;
use App\Policies\JournalPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * 
     *
     * @var array
     */
    protected $policies = [
        Journal::class => JournalPolicy::class,
    ];


    public function boot(): void
    {
        $this->registerPolicies();
    }
}
