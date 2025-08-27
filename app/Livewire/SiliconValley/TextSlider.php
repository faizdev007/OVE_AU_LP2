<?php

namespace App\Livewire\SiliconValley;

use App\Facades\LandingPagePatch;
use Livewire\Component;

class TextSlider extends Component
{
    public $lp_data,$sliding_text,$paragraph;
    public $successMessage = '';
    public $errorMessage = '';

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $jsonData = isset($lp_data['page_contect']) ? json_decode($lp_data['page_contect'],true) : [];
        $textslide = $jsonData['textslide'] ?? [];
        $this->sliding_text = $textslide['sliding_text'] ?? '<Words> Are Easy, <Execution> is What Matters — Meet Our <Experts>';
        $this->paragraph = $textslide['paragraph'] ?? "< Buzzwords are loud. Results speak louder. >";
    }

    public function save()
    {
        try {
            //code...
            $this->validate([
                'sliding_text' => 'required|max:255',
                'paragraph' => 'required',
            ]);

            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];

            $contentdata['textslide'] = [
                'sliding_text' => $this->sliding_text,
                'paragraph' => $this->paragraph,
            ];

            LandingPagePatch::update($this->lp_data,$contentdata);
            
            $this->successMessage = 'Section updated successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorMessage = $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.silicon-valley.text-slider');
    }
}
