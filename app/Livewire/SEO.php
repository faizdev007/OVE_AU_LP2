<?php

namespace App\Livewire;

use App\Facades\LandingPagePatch;
use Livewire\Component;

class SEO extends Component
{
    public $lp_data,$metaTitle,$metaDescription;
    
    public $successMessage = '';
    
    public $errorMessage = '';
    
    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $seo = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
        $this->metaTitle = $seo['seo']['metaTitle'] ?? 'SaaS, Web & Mobile Development | eCommerce, UI/UX, API Integration Services - OVE';
        $this->metaDescription = $seo['seo']['metaDescription'] ?? 'Partner with OVE for scalable SaaS solutions, custom web apps, mobile development, UI/UX design, and API integration. Book a free consultation today.';
    }

    public function save()
    {
        try {
            //code...
            $this->validate([
                'metaTitle'=>'required',
                'metaDescription'=>'required'
            ]);

            $content = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $content['seo'] = [
                'metaTitle'=>$this->metaTitle,
                'metaDescription'=>$this->metaDescription
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
        return view('livewire.s-e-o');
    }
}
