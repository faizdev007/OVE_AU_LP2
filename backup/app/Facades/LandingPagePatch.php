<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class LandingPagePatch extends Facade
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    protected static function getFacadeAccessor()
    {
        return \App\Services\LandingPagePatch::class;
    }
}
