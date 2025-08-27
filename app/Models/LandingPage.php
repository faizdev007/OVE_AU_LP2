<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandingPage extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'page_name',
        'lp_theme',
        'lp_url',
        'page_contect',
        'ip_address',
    ];

    public function getRouteKeyName()
    {
        return 'lp_url';
    }
}
