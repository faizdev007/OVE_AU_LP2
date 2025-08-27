<?php

namespace App\Livewire\Bacancypage;

use App\Facades\LandingPagePatch;
use Livewire\Component;

class OurOfficeLocation extends Component
{
    public $successMessage,$errorMessage,$lp_data=[],$title,$orders=[];

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $footer = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
        $this->title = $footer['ouroffices']['title'] ?? 'Our Global Presence';
        $this->orders = isset($footer['ouroffices']['orders']) ? collect($footer['ouroffices']['orders'])->toArray() : [1 => 1, 2 => 2, 3 => 3, 4 => 4];
    }

    public function save()
    {
        try {
            $this->validate([
                'title'=>'required',
                'orders.*' => 'nullable|integer|distinct|min:1|max:4',
            ]);

            $content = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];

            $content['ouroffices'] = [
                'title'=>$this->title,
                'orders' => $this->orders,
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
        return view('livewire.bacancypage.our-office-location');
    }
}
