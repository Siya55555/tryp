<?php

namespace App\Observers;

use App\Models\Admin\NavigationItem;
use App\Services\NavigationService;

class NavigationItemObserver
{
    /**
     * @var NavigationService
     */
    protected $navigationService;
    
    /**
     * Constructor to inject service
     */
    public function __construct(NavigationService $navigationService)
    {
        $this->navigationService = $navigationService;
    }
    
    /**
     * Handle the NavigationItem "created" event.
     *
     * @param  \App\Models\Admin\NavigationItem  $navigationItem
     * @return void
     */
    public function created(NavigationItem $navigationItem)
    {
        $this->navigationService->clearCache();
    }

    /**
     * Handle the NavigationItem "updated" event.
     *
     * @param  \App\Models\Admin\NavigationItem  $navigationItem
     * @return void
     */
    public function updated(NavigationItem $navigationItem)
    {
        $this->navigationService->clearCache();
    }

    /**
     * Handle the NavigationItem "deleted" event.
     *
     * @param  \App\Models\Admin\NavigationItem  $navigationItem
     * @return void
     */
    public function deleted(NavigationItem $navigationItem)
    {
        $this->navigationService->clearCache();
    }
}