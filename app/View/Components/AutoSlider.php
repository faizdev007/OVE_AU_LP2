<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AutoSlider extends Component
{
    public $autoSlide;
    public $interval;
    public $showNav;
    public $perPage = 4;
    public $card2xl = 5;
    public $cardxl = 4;
    public $cardlg = 3;
    public $cardmd = 2;
    

    public function __construct($autoSlide = true, $interval = 3000, $showNav = true , $perPage = 4, $card2xl = 5, $cardxl = 4, $cardlg = 3, $cardmd = 2)
    {
        $this->card2xl = (int) $card2xl;
        $this->cardxl = (int) $cardxl;
        $this->cardlg = (int) $cardlg;
        $this->cardmd = (int) $cardmd;
        $this->autoSlide = filter_var($autoSlide, FILTER_VALIDATE_BOOLEAN);
        $this->interval = (int) $interval;
        $this->showNav = filter_var($showNav, FILTER_VALIDATE_BOOLEAN);
        $this->perPage = (int) $perPage;
    }   


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auto-slider');
    }
}
