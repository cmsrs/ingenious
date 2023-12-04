<?php

declare(strict_types=1);

namespace App\Modules\Approval\Infrastructure\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Modules\Approval\Api\Events\EntityApproved::class => [
            \App\Modules\Approval\Listeners\UpdateInvoiceStatus::class,
        ],
        \App\Modules\Approval\Api\Events\EntityRejected::class => [
            \App\Modules\Approval\Listeners\UpdateInvoiceStatus::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}

