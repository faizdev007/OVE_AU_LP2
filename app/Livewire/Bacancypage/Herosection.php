<?php

namespace App\Livewire\Bacancypage;

use App\Facades\LandingPagePatch;
use App\Models\LandingPage;
use Livewire\Component;

class Herosection extends Component
{   
    public $hero=null,$lp_data=null,$btntext,$hero_title_one,$hero_title_two,$hero_title_three,$hero_subtitle,$hero_lists=[],
    $box1,$boxtextone,$box2,$boxtexttwo,$box3,$boxtextthree;

    public $isLoading = false;
    
    public $successMessage = '';
    public $errorMessage = '';

    protected $rules = [
        'hero_title_one'=>['max:50'],
        'hero_title_two'=>['max:50'],
        'hero_title_three'=>['max:50'],
        'hero_subtitle'=>['string','max:500',],
        'box1'=>['string','max:50',],
        'box2'=>['string','max:50',],
        'box3'=>['string','max:50',],
    ];

    public function save(){
        try {
            $this->validate();

            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $contentdata['hero'] = [
                'hero_title_one' => $this->hero_title_one,
                'hero_title_two' => $this->hero_title_two,
                'hero_title_three' => $this->hero_title_three,
                'hero_subtitle' => $this->hero_subtitle,
                'hero_lists' => $this->hero_lists,
                'btntext'=>$this->btntext,
                'box1' => $this->box1,
                'boxtextone' => $this->boxtextone,
                'box2' => $this->box2,
                'boxtexttwo' => $this->boxtexttwo,
                'box3' => $this->box3,
                'boxtextthree' => $this->boxtextthree
            ];

            LandingPagePatch::update($this->lp_data,$contentdata);

            $this->successMessage = 'Section updated Successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorMessage = $th->getMessage();
        }

    }

    public function mount($lp_data)
    {
        $toJson = isset($lp_data->page_contect) ? json_decode($lp_data->page_contect,true) : [];
        $this->hero = isset($toJson['hero']) ? $toJson['hero'] : [];
        $this->hero_title_one = $this->hero['hero_title_one'] ?? 'Hire';
        $this->hero_title_two = $this->hero['hero_title_two'] ?? 'Software Developers';
        $this->hero_title_three = $this->hero['hero_title_three'] ?? '';
        $this->hero_subtitle = $this->hero['hero_subtitle'] ?? 'Save up to 60% on hiring costs while building a high-performance tech team that runs on coffee & clean code';
        $this->hero_lists = $this->hero['hero_lists'] ?? ['3x Faster Hiring – Interview top talent instantly.','Proven Success – 98% client retention','AI-Enabled Developers – Boost productivity with AI tools','100% IP Protection – Secure NDA and infrastructures','15+ Years of Experience – Trusted by Fortune 500'];
        $this->btntext = $this->hero['btntext'] ?? 'Book a 30 mins strategy call';
        $this->box1 = $this->hero['box1'] ?? '15+';
        $this->boxtextone = $this->hero['boxtextone'] ?? 'Years of Industry Exp.';
        $this->box2 = $this->hero['box2'] ?? '400+';
        $this->boxtexttwo = $this->hero['boxtexttwo'] ?? 'Developers';
        $this->box3 = $this->hero['box3'] ?? '120+';
        $this->boxtextthree = $this->hero['boxtextthree'] ?? 'Clients';
        $this->lp_data = isset($lp_data) ? $lp_data : [];
    }

    public function render()
    {

        return view('livewire.bacancypage.herosection');
    }
}
