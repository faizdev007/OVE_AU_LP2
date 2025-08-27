<?php

namespace App\Livewire\SiliconValley;

use App\Facades\HelperFacade;
use App\Facades\LandingPagePatch;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

use function PHPUnit\Framework\isObject;
use function PHPUnit\Framework\isString;

class HeroSection extends Component
{
    use WithFileUploads;

    public $lp_data,$hero_subtitle,$hero_shorttext,$hero_title,$buttonText,$heroPortfolio=[],$floatingIcons = [],$removeImg = [];
    public $successMessage = '';
    public $errorMessage = '';

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $jsonData = isset($lp_data['page_contect']) ? json_decode($lp_data['page_contect'],true) : [];
        $hero = $jsonData['hero'] ?? [];
        $this->hero_subtitle = $hero['hero_subtitle'] ?? 'Access the tech brilliance that powers unicorns and global startups—without paying the premium.';
        $this->hero_title = $hero['hero_title'] ?? 'Powered by';
        $this->hero_shorttext = $hero['hero_shorttext'] ?? '< Top Tech Talent />';
        $this->buttonText = $hero['buttonText'] ?? 'Hire a Software Developer';
        $this->heroPortfolio =$hero['heroPortfolio'] ?? ['image' => 'assets/siliconvalley/herosection/anjali.webp', 'name'=>'Anjali', 'title' => 'Full Stack Developer', 'description' => 'Matilda is a Full Stack Developer with over 5 years of experience in building scalable web applications.'];
        $this->floatingIcons = $hero['floatingIcons'] ?? ['assets/siliconvalley/herosection/nodejs.webp','assets/siliconvalley/herosection/python.webp','assets/siliconvalley/herosection/firebase.webp','assets/siliconvalley/herosection/react.webp'];
    }

    public function chnageportfolio()
    {
        if(isString($this->heroPortfolio['image'])){
            $this->removeImg[] = $this->heroPortfolio['image'];
        }
    }

    public function changefloatingIcon($key)
    {
        if(isString($this->flotifloatingIconsngIcons[$key])){
            $this->removeImg[] = $this->floatingIcons[$key];
        }
    }

    public function save()
    {
        try {
            //code...
            $this->validate([
                'hero_shorttext' => 'required|max:255',
                'hero_title' => 'required',
                'hero_subtitle' => 'nullable|max:255',
                'buttonText' => 'nullable|max:50',
            ]);

            foreach ($this->removeImg as $key => $value) {
                if (is_string($value)) {
                    HelperFacade::removeFile($value);
                }
            }

            if (isObject($this->heroPortfolio['image'])) {
                $this->heroPortfolio['image'] = HelperFacade::uploadFile($this->heroPortfolio['image'], 'siliconvalley/herosection/photo');
            }
            
            foreach ($this->floatingIcons as $key => $single) {
                if (isObject($single)) {
                    $this->floatingIcons[$key] = HelperFacade::uploadFile($single, 'siliconvalley/herosection/floatingIcons');
                }
            }
            
            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];

            $contentdata['hero'] = [
                'hero_shorttext' => $this->hero_shorttext,
                'hero_title' => $this->hero_title,
                'hero_subtitle' => $this->hero_subtitle,
                'buttonText' => $this->buttonText,
                'heroPortfolio' => $this->heroPortfolio,
                'floatingIcons' => $this->floatingIcons,
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
        return view('livewire.silicon-valley.hero-section');
    }
}
