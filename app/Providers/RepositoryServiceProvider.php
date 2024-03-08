<?php

namespace App\Providers;

use App\Interfaces\OrdersInterface;
use App\Interfaces\ReferenceInterface;
use App\Interfaces\RolesInterface;
use App\Interfaces\ServiceInfoInterface;
use App\Interfaces\ServicesInterface;
use App\Interfaces\TaskInterface;
use App\Interfaces\TimeInterface;
use App\Services\OrderService;
use App\Services\ReferenceService;
use App\Services\RolesService;
use App\Services\ServiceInfoService;
use App\Services\ServicesService;
use App\Services\TaskService;
use App\Services\TimeService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RolesInterface::class, RolesService::class);
        $this->app->bind(TaskInterface::class, TaskService::class);
        $this->app->bind(ReferenceInterface::class, ReferenceService::class);
        $this->app->bind(TimeInterface::class, TimeService::class);
        $this->app->bind(OrdersInterface::class, OrderService::class);
        $this->app->bind(ServicesInterface::class, ServicesService::class);
        $this->app->bind(ServiceInfoInterface::class, ServiceInfoService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
