<?php

namespace App\Services;

use App\Models\LandingPage;

class LandingPagePatch
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function update($lp_data,$contentdata)
    {
        $convert_data = json_encode($contentdata);   
        $lp_data->update(
            [
                'page_contect' => $convert_data,
                'ip_address' => request()->ip(),
            ]
        );

    }
}
