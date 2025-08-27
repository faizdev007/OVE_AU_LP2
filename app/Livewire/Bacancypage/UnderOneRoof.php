<?php

namespace App\Livewire\Bacancypage;

use App\Facades\HelperFacade;
use App\Facades\LandingPagePatch;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UnderOneRoof extends Component
{
    use WithFileUploads;

    public $successMessage,$errorMessage,$lp_data,$title,$subtitle,$btnText,$removeIcons=[],$underOneRoofSections = [
        ['icon' => null, 'title' => '','description'=>'']
    ];

    public $block=false;

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $UOR = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
        $this->title = $UOR['UOR']['title'] ?? 'The Tech Behind the Brilliance';
        $this->subtitle = $UOR['UOR']['subtitle'] ?? 'Explore the core technologies we use to build scalable, high-performance solutions';
        $this->btnText = $UOR['UOR']['btnText'] ?? 'SCHEDULE A CALL';
        $this->underOneRoofSections = $UOR['UOR']['technologies'] ?? 
        [
            ['icon' => '/assets/underOnRoof/devops-1.svg', 'title' => 'Front-end','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['icon' => '/assets/underOnRoof/devops-2.svg', 'title' => 'Back-end','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['icon' => '/assets/underOnRoof/full-stack.svg', 'title' => 'Full-stack','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['icon' => '/assets/underOnRoof/web.svg', 'title' => 'Web','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['icon' => '/assets/underOnRoof/cloud.svg', 'title' => 'Cloud','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['icon' => '/assets/underOnRoof/mobile2.svg', 'title' => 'Mobile','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['icon' => '/assets/underOnRoof/devops-3.svg', 'title' => 'UI/UX','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['icon' => '/assets/underOnRoof/aiml.svg', 'title' => 'AI/ML','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ['icon' => '/assets/underOnRoof/data-science.svg', 'title' => 'Data Science','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
        ];
        $this->block = $UOR['UOR']['block'] ?? false;
    }


    public function addElement()
    {
        $this->underOneRoofSections[] = ['icon' => null, 'title' => '','description'=>''];
    }

    public function removeElement($elementIndex)
    {
        if(isset($this->underOneRoofSections[$elementIndex]['icon']) && is_string($this->underOneRoofSections[$elementIndex]['icon'])){
            $this->removeIcons[] = $this->underOneRoofSections[$elementIndex]['icon'];
        }
        unset($this->underOneRoofSections[$elementIndex]);
        $this->underOneRoofSections = array_values($this->underOneRoofSections);
    }

    public function removeIcon($elementIndex)
    {
        if(isset($this->underOneRoofSections[$elementIndex]['icon']) && is_string($this->underOneRoofSections[$elementIndex]['icon'])){
            $this->removeIcons[] = $this->underOneRoofSections[$elementIndex]['icon'];
        }
    }

    public function save()
    {
        try {
            //code...
            $this->validate([
                'title'=>'required',
                'subtitle'=>'required',
                // 'elements.*.icon'=>'required',
            ]);

            if(isset($this->removeIcons)){
                foreach($this->removeIcons as $single){
                    HelperFacade::removeFile($single);
                }
            }

            $technologies = [];

            foreach($this->underOneRoofSections as $key=>$single)
            {
                $technologies[$key]['icon'] = HelperFacade::uploadFile($single['icon'],'bacancy/underOneRoof');
                $technologies[$key]['title'] = $single['title'];
                $technologies[$key]['description'] = $single['description'];
            }
            
            $content = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $content['UOR'] = [
                'title'=> $this->title,
                'subtitle'=> $this->subtitle,
                'btnText' => $this->btnText,
                'techIconSections'=>$technologies,
                'block'=>$this->block,
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
        return view('livewire.bacancypage.under-one-roof');
    }
}
