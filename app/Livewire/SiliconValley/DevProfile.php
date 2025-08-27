<?php

namespace App\Livewire\SiliconValley;

use App\Facades\HelperFacade;
use App\Facades\LandingPagePatch;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

use function PHPUnit\Framework\isObject;

class DevProfile extends Component
{
    use WithFileUploads;

    public $lp_data,$devProfile = [], $removeImg = [];
    public $successMessage = '';
    public $errorMessage = '';
    
    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $jsonData = isset($lp_data['page_contect']) ? json_decode($lp_data['page_contect'], true) : [];
        $this->devProfile = $jsonData['devProfile'] ?? [
            [
                'name'=> 'Rohan',
                'starts'=> 4.5,
                'techStack'=> 'React, Next.js, TypeScript, Tailwind CSS',
                'description' => 'Specializes in crafting lightning-fast, SEO-optimized web applications using cutting-edge front-end technologies and modern SSR practices. Delivers clean, maintainable code with strong attention to UI/UX detail.',
                'image' => 'assets/siliconvalley/devprofile/developer2.webp',
                'projects' => [null,null,null,null]
            ],
            [
                'name'=> 'Priyanshi',
                'starts'=> 5,
                'techStack'=> 'React, Node.js, MongoDB',
                'description' => ' Expert in building scalable, secure, and modular full-stack applications with modern JavaScript frameworks. Passionate about clean architecture and continuous delivery.',
                'image' => 'assets/siliconvalley/devprofile/developer3.webp',
                'projects' => [null,null,null,null]
            ],
            [
                'name'=> 'Siddharth',
                'starts'=> 4,
                'techStack'=> 'React, Node.js, PostgreSQL',
                'description' => 'Designs and develops high-performance, enterprise-grade full-stack solutions with a focus on data integrity, performance optimization, and intuitive user experiences.',
                'image' => 'assets/siliconvalley/devprofile/developer4.webp',
                'projects' => [null,null,null,null]
            ],
            [
                'name'=> 'Anjali',
                'starts'=> 4.3,
                'techStack'=> 'Laravel, Vue.js, MySQL',
                'description' => 'Builds modern, interactive web applications with clean backend logic and elegant front-end components. Strong focus on API design, performance, and maintainability.',
                'image' => 'assets/siliconvalley/devprofile/developer5.webp',
                'projects' => [null,null,null,null]
            ]
        ];
    }

    public function defaultProfile()
    {
        return [
            'name' => '',
            'starts'=> 4.5,
            'techStack' => '',
            'description' => '',
            'image' => null,
            'projects' => [null,null,null,null]
        ];
    }

    public function addProfile()
    {
        $this->devProfile[] = $this->defaultProfile();
    }

    public function removeProfile($index)
    {
        $this->removeImg[] = $this->devProfile[$index]['image'];
        foreach($this->devProfile[$index]['projects'] as $single){
            if(isset($single)){
                $this->removeImg[] = $single; 
            }
        }
        unset($this->devProfile[$index]);
        $this->devProfile = array_values($this->devProfile); // Reindex
    }

    public function save()
    {
        try {
            foreach ($this->devProfile as $key => $value) {
                $this->validate([
                    "devProfile.$key.name" => 'required|max:255',
                    "devProfile.$key.description" => 'required',
                    "devProfile.$key.image" => 'nullable|max:200', // Optional image validation
                    "devProfile.$key.projects" => 'required|array',
                ]);

                if(isset($this->removeImg)){
                    foreach($this->removeImg as $single){
                        HelperFacade::removeFile($single);
                    }
                }

                if(isObject($value['image'])){
                    $this->devProfile[$key]['image'] = HelperFacade::uploadFile($value['image'], 'siliconvalley/devprofile/photo');
                }
                
                foreach($value['projects'] as $projectKey => $projectImage) {
                    if (isObject($projectImage)) {
                        $this->devProfile[$key]['projects'][$projectKey] = HelperFacade::uploadFile($projectImage, 'siliconvalley/devprofile/projects');
                    }
                }
            }

            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'], true) : null;

            
            $contentdata['devProfile'] = count($this->devProfile) ? $this->devProfile : null;
            
            // Update the landing page content
            LandingPagePatch::update($this->lp_data, $contentdata);

            $this->successMessage = 'Developer profile updated successfully!';
        } catch (\Throwable $th) {
            $this->errorMessage = $th->getMessage();
        }
    }   

    public function render()
    {
        return view('livewire.silicon-valley.dev-profile');
    }
}
