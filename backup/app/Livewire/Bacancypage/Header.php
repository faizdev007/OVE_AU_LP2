<?php

namespace App\Livewire\Bacancypage;

use App\Facades\LandingPagePatch;
use Livewire\Component;

class Header extends Component
{
    public $lp_data,$menu=[],$btntext;
    
    public $successMessage = '';
    
    public $errorMessage = '';
    
    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $header = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
        $this->btntext = $header['header']['btntext'] ?? 'Book a 30 mins strategy call';
        $this->menu = $header['header']['menu'] ?? [
                                'Our Talent',
                                'Technical Stack',
                                'Success Stories',
                                'FAQs'
                            ];
    }

    public function save()
    {
        try {
            //code...
            $this->validate([
                'btntext'=>'required',
                'menu.*'=>'required'
            ]);

            $content = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $content['header'] = [
                'btntext'=>$this->btntext,
                'menu'=>$this->menu
            ];

            LandingPagePatch::update($this->lp_data,$content);

            $this->successMessage = 'Section updated Successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorMessage = $th->getMessage();
        }
        
    }

    public function render()
    {
        return view('livewire.bacancypage.header');
    }
}
