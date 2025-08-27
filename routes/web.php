<?php

use App\Http\Controllers\AdminController;
use App\Livewire\Admin\ModalPage;
use App\Livewire\Admin\ModalSelector;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;

Route::get('/run-queue', function () {
    abort_unless(request('key') === env('QUEUE_SECRET_KEY'), 403);

    Artisan::call('queue:work', ['--once' => true]);
    return 'Queue processed.';
});

Route::get('/', function () {
    return view('landing_pages.bacancy',[
        'lp_theme'=>'bacancy',
        'lp_data' =>[],
        'header'=> [
            'btntext'=>'strategy call',
            'menu'=>[
                'Our Talent',
                'Technical Stack',
                'Success Stories',
                'FAQs'
            ]
        ],
        'seo'=>[
            'metaTitle'=>'SaaS, Web & Mobile Development | eCommerce, UI/UX, API Integration Services - OVE',
            'metaDescription'=>'Partner with OVE for scalable SaaS solutions, custom web apps, mobile development, UI/UX design, and API integration. Book a free consultation today.',
        ]
    ]);
})->name('home');

Route::get('/thankyou',function(){
    if (!session('allow_success')) {
        abort(404, 'Not Found');
    }
    return view('thankyou',['seo'=>[
            'metaTitle'=>'SaaS, Web & Mobile Development | eCommerce, UI/UX, API Integration Services - OVE',
            'metaDescription'=>'Partner with OVE for scalable SaaS solutions, custom web apps, mobile development, UI/UX design, and API integration. Book a free consultation today.',
        ]]);
})->name('thankyou');

Route::get('/privacy_policy',function(){
    return view('privacy_policy',['seo'=>[
            'metaTitle'=>'SaaS, Web & Mobile Development | eCommerce, UI/UX, API Integration Services - OVE',
            'metaDescription'=>'Partner with OVE for scalable SaaS solutions, custom web apps, mobile development, UI/UX design, and API integration. Book a free consultation today.',
        ]]);
})->name('privacy_policy');

Route::get('/{lp_data}',function(LandingPage $lp_data){
    $data =  isset($lp_data['page_contect']) ? json_decode($lp_data['page_contect'],true) : [];

    return view('landing_pages.'.$lp_data->lp_theme,[
        'lp_theme'=>$lp_data->lp_theme,
        'lp_data' =>$lp_data,
        'header'=> isset($data['header']) ? $data['header'] :
            ['btntext'=>'Book a 30 mins strategy call',
            'menu'=>[
                'Our Talent',
                'Technical Stack',
                'Success Stories',
                'FAQs'
        ]],
        'seo'=>isset($data['seo']) ? $data['seo'] : [
            'metaTitle'=>'SaaS, Web & Mobile Development | eCommerce, UI/UX, API Integration Services - OVE',
            'metaDescription'=>'Partner with OVE for scalable SaaS solutions, custom web apps, mobile development, UI/UX design, and API integration. Book a free consultation today.',
        ]
    ]);
})->name('showlandingpage');

Route::prefix('ove')->middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('landing_pages',[AdminController::class,'landing_page_list'])->name('landing_pages');
    Route::post('create',[AdminController::class,'select_lp_theme'])->name('create_lp_theme');
    Route::get('/create/{lp_data}',[AdminController::class,'create_lp_contect'])->name('create_lp_content');
    Route::delete('/delete/{lp_data}',[AdminController::class,'delete_lp_contect'])->name('delete_lp_content');

    Route::get('form_querys',[AdminController::class,'form_querys'])->name('form_querys');
    Route::get('/modals', ModalSelector::class)->name('modals');
});

require __DIR__.'/auth.php';

