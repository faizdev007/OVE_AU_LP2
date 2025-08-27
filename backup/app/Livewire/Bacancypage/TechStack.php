<?php

namespace App\Livewire\Bacancypage;

use App\Facades\HelperFacade;
use App\Facades\LandingPagePatch;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class TechStack extends Component
{
    use WithFileUploads;

    public $successMessage,$errorMessage,$lp_data,$title,$subtitle,$removesection=[],$removeIcons=[],$techIconSections = [
        ['title' => '', 'elements' => [['icon' => null, 'name' => '']]]
    ];

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $techstack = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
        $this->title = $techstack['techstack']['title'] ?? 'The Tech Behind the Brilliance';
        $this->subtitle = $techstack['techstack']['subtitle'] ?? 'Explore the core technologies we use to build scalable, high-performance solutions';
        $this->techIconSections = $techstack['techstack']['techIconSections'] ?? 
        [
            ['title' => 'Backend', 'elements' => [
                ['icon' => null, 'name' => '.Net'],
                ['icon' => null, 'name' => 'Python'],
                ['icon' => null, 'name' => 'Java'],
                ['icon' => null, 'name' => 'PHP'],
            ]],
            ['title' => 'Frontend', 'elements' => [
                ['icon' => null, 'name' => 'React.js'],
                ['icon' => null, 'name' => 'Angular.js'],
                ['icon' => null, 'name' => 'Next.js'],
                ['icon' => null, 'name' => 'Vue.js'],
            ]],
            ['title' => 'Mobile', 'elements' => [
                ['icon' => null, 'name' => 'Flutter'],
                ['icon' => null, 'name' => 'React Native'],
                ['icon' => null, 'name' => 'Swift'],
                ['icon' => null, 'name' => 'Kotlin'],
            ]]
            ,
            ['title' => 'DevOps', 'elements' => [
                ['icon' => null, 'name' => 'Apacheant'],
                ['icon' => null, 'name' => 'Xcode'],
                ['icon' => null, 'name' => 'Fastlane'],
                ['icon' => null, 'name' => 'Gant'],
                ['icon' => null, 'name' => 'Gradle'],
                ['icon' => null, 'name' => 'Maven'],
                ['icon' => null, 'name' => 'Ansible'],
                ['icon' => null, 'name' => 'TeamCity'],
                ['icon' => null, 'name' => 'Bamboo'],
            ]],
            ['title' => 'Database', 'elements' => [
                ['icon' => null, 'name' => 'MongoDB'],
                ['icon' => null, 'name' => 'PostgreSQL'],
                ['icon' => null, 'name' => 'MySQL'],
                ['icon' => null, 'name' => 'SQLlite'],
            ]],
            ['title' => 'Version Control', 'elements' => [
                ['icon' => null, 'name' => 'GitHub'],
                ['icon' => null, 'name' => 'BitBucket'],
                ['icon' => null, 'name' => 'GitLab'],
            ]],
            ['title' => 'CRM', 'elements' => [
                ['icon' => null, 'name' => 'Salesforce'],
                ['icon' => null, 'name' => 'Microsoft'],
                ['icon' => null, 'name' => 'Dynamics'],
                ['icon' => null, 'name' => '365'],
            ]],
            ['title' => 'AI Tools', 'elements' => [
                ['icon' => null, 'name' => 'Github'],
                ['icon' => null, 'name' => 'Co-Pilot'],
                ['icon' => null, 'name' => 'ChatGPT'],
                ['icon' => null, 'name' => 'Claude'],
            ]]
        ];
    }


    public function addSection()
    {
        $this->techIconSections[] = ['title' => '', 'elements' => [['icon' => null, 'name' => '']]];
    }

    public function removeSection($sectionIndex)
    {
        foreach($this->techIconSections[$sectionIndex]['elements'] as $items)
        {
            if(isset($items['icon'])){
                $this->removesection[] = $items['icon'];
            }
        }
        unset($this->techIconSections[$sectionIndex]);
        $this->techIconSections = array_values($this->techIconSections);
    }

    public function addElement($sectionIndex)
    {
        $this->techIconSections[$sectionIndex]['elements'][] = ['icon' => null, 'name' => ''];
    }

    public function removeElement($sectionIndex, $elementIndex)
    {
        if(isset($this->techIconSections[$sectionIndex]['elements'][$elementIndex]['icon']) && is_string($this->techIconSections[$sectionIndex]['elements'][$elementIndex]['icon'])){
            $this->removeIcons[] = $this->techIconSections[$sectionIndex]['elements'][$elementIndex]['icon'];
        }
        unset($this->techIconSections[$sectionIndex]['elements'][$elementIndex]);
        $this->techIconSections[$sectionIndex]['elements'] = array_values($this->techIconSections[$sectionIndex]['elements']);
    }

    public function removeIcon($sectionIndex, $elementIndex)
    {
        if(isset($this->techIconSections[$sectionIndex]['elements'][$elementIndex]['icon']) && is_string($this->techIconSections[$sectionIndex]['elements'][$elementIndex]['icon'])){
            $this->removeIcons[] = $this->techIconSections[$sectionIndex]['elements'][$elementIndex]['icon'];
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

            if(isset($this->removesection)){
                foreach($this->removesection as $single){
                    HelperFacade::removeFile($single);
                }
            }

            if(isset($this->removeIcons)){
                foreach($this->removeIcons as $single){
                    HelperFacade::removeFile($single);
                }
            }

            $techsets = [];

            foreach($this->techIconSections as $key=>$single)
            {
                $techsets[$key]['title'] = $single['title'];
                foreach($single['elements'] as $key2=>$item)
                {
                    $techsets[$key]['elements'][$key2]['icon'] = HelperFacade::uploadFile($item['icon'],'bacancy/techstack');
                    $techsets[$key]['elements'][$key2]['name'] = $item['name'];
                }
            }
            
            $content = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $content['techstack'] = [
                'title'=>$this->title,
                'subtitle'=>$this->subtitle,
                'techIconSections'=>$techsets,
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
        return view('livewire.bacancypage.tech-stack');
    }
}
