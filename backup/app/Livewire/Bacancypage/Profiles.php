<?php

namespace App\Livewire\Bacancypage;

use App\Facades\HelperFacade;
use App\Facades\LandingPagePatch;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Profiles extends Component
{
    use WithFileUploads;

    public $successMessage,$errorMessage,$lp_data=null,$developers=null,$developer_title=null,$developer_subtitle=null,$developer_list=[],$removedAvatars = [],$removedCompanyLogos = [];

    public $isLoading = false;

    protected $rules = [
        'developer_title'=>['max:100'],
        'developer_subtitle'=>['max:500'],
        'developer_list.*.avtar'=>['required'],
        'developer_list.*.name'=>['required'],
        'developer_list.*.profile'=>['required'],
        'developer_list.*.company_logo'=>['required'],
        'developer_list.*.tools'=>['required'],
        'developer_list.*.info'=>['required'],
    ];

    public function addDeveloper()
    {
        $this->developer_list[] = [
            'name' => '',
            'profile' => '',
            'tools' => '',
            'info' => '',
            'avtar' => null,
            'company_logo' => null,
        ];
    }

    public function removeDeveloper($index)
    {
        if (isset($this->developer_list[$index]['avtar']) && is_string($this->developer_list[$index]['avtar'])) {
            $this->removedAvatars[] = $this->developer_list[$index]['avtar'];
        }

        if (isset($this->developer_list[$index]['company_logo']) && is_string($this->developer_list[$index]['company_logo'])) {
            $this->removedCompanyLogos[] = $this->developer_list[$index]['company_logo'];
        }

        unset($this->developer_list[$index]);
        $this->developer_list = array_values($this->developer_list); // Re-index array
    }

    public function removeAvtar($index)
    {
        if (isset($this->developer_list[$index]['avtar']) && is_string($this->developer_list[$index]['avtar'])) {
            $this->removedAvatars[] = $this->developer_list[$index]['avtar'];
        }
    }

    public function removeLogo($index)
    {
        if (isset($this->developer_list[$index]['company_logo']) && is_string($this->developer_list[$index]['company_logo'])) {
            $this->removedCompanyLogos[] = $this->developer_list[$index]['company_logo'];
        }
    }

    public function save()
    {
        try {
            $this->validate();
            
            // Your save logic...
            if(!empty($this->removedAvatars)){
                foreach ($this->removedAvatars as $avatar) {
                    HelperFacade::removeFile($avatar);
                }
            }

            if(!empty($this->removedCompanyLogos)){
                foreach ($this->removedCompanyLogos as $logo) {
                    HelperFacade::removeFile($logo);
                }
            }

            $profiles = [];

            foreach ($this->developer_list as $single) {
                // Handle Avatar Upload
                $single['avtar'] = HelperFacade::uploadFile($single['avtar'],'bacancy/developerProfiles/photos');
                
                $single['company_logo'] = HelperFacade::uploadFile($single['company_logo'],'bacancy/developerProfiles/company_logo');
                
                $profiles[] = $single;
            }
            
            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $contentdata['developers'] = [
                'developer_title' => $this->developer_title,
                'developer_subtitle' => $this->developer_subtitle,
                'developer_list' => $profiles,
            ];

            LandingPagePatch::update($this->lp_data,$contentdata);
            
            $this->successMessage = 'Developer Profile updated successfully!';

            $this->successMessage = 'Section updated Successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorMessage = $th->getMessage();
        }
    }

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $data = isset($lp_data->page_contect) ? json_decode($lp_data->page_contect) : [];
        $this->developers = isset($data->developers) ? $data->developers : [];
        $this->developer_title = $this->developers->developer_title ?? 'We’ve Done the Screening for You';
        $this->developer_subtitle = $this->developers->developer_subtitle ?? 'Dive into our elite pool of developers, just a click away.';
        $this->developer_list = $this->developers->developer_list ?? 
        [
            ["name"=>"Aisha","profile"=>"Full-Stack Developer","tools"=>"MongoDB, Express, React","info"=>"Expert in serverless full-stack application development, focusing on real-time interactive apps.","avtar"=>"/assets/developers/Aisha.webp","company_logo"=>"/assets/previous/Nokia.webp","company"=>"Nokia"],
            ["name"=>"Rohan","profile"=>"Full-Stack Developer","tools"=>"Django, React, AWS","info"=>"Develops cloud-native web applications combining Django backend with React frontend, leveraging AWS services.","avtar"=>"/assets/developers/Rohan.webp","company_logo"=>"/assets/previous/Meta.webp","company"=>"Meta"],
            ["name"=>"Mira","profile"=>"FRONT-END DEVELOPER","tools"=>"React, Vue.js, TypeScript","info"=>"Specializes in responsive UI and dynamic front-end experiences.","avtar"=>"/assets/developers/Mira.webp","company_logo"=>"/assets/previous/Hp.webp","company"=>"Hp"],
            ["name"=>"Isabella","profile"=>"BACK-END DEVELOPER","tools"=>"Python, Django, PostgreSQL","info"=>"Designs and optimizes robust and secure backend systems.","avtar"=>"/assets/developers/Isabella.webp","company_logo"=>"/assets/previous/Tinder.webp","company"=>"Tinder"],
            ["name"=>"Arjun","profile"=>"Full-Stack Developer","tools"=>"MongoDB, Express, React","info"=>"Builds scalable full-stack web applications using the MERN stack, focusing on performant and maintainable code.","avtar"=>"/assets/developers/Arjun.webp","company_logo"=>"/assets/previous/Payoneer.webp","company"=>"Payoneer"],
            ["name"=>"Sofia","profile"=>"BACK-END DEVELOPER","tools"=>"Python, FastAPI, PostgreSQL","info"=>"Focuses on high-performance data-driven backends.","avtar"=>"/assets/developers/Sofia.webp","company_logo"=>"/assets/previous/Volvo.webp","company"=>"Volvo"],
            ["name"=>"Tanvi","profile"=>"BACK-END DEVELOPER","tools"=>"Go, Kubernetes, PostgreSQL","info"=>"Develops cloud-native, containerized backend services.","avtar"=>"/assets/developers/Tanvi.webp","company_logo"=>"/assets/previous/Walmart.webp","company"=>"Walmart"],
            ["name"=>"Raj","profile"=>"Back-End Developer","tools"=>"Spring Boot, MySQL, Java","info"=>"Builds scalable enterprise-grade backend services and microservices using Java Spring Boot.","avtar"=>"/assets/developers/Raj.webp","company_logo"=>"/assets/previous/Boeing.webp","company"=>"Boeing"],
            ["name"=>"Miguel","profile"=>"FULL-STACK DEVELOPER","tools"=>"Ruby on Rails, React, PostgreSQL","info"=>"Full-stack engineer with deep Ruby on Rails expertise.","avtar"=>"/assets/developers/Miguel.webp","company_logo"=>"/assets/previous/Neogames.webp","company"=>"Neogames"],
            ["name"=>"Ella","profile"=>"FRONT-END DEVELOPER","tools"=>"React, Vue.js, SASS","info"=>"Creates pixel-perfect UI with seamless user experience.","avtar"=>"/assets/developers/Ella 🇵🇭.webp","company_logo"=>"/assets/previous/WarnerBros.webp","company"=>"WarnerBros"],
            ["name"=>"Dev","profile"=>"FULL-STACK DEVELOPER","tools"=>"React, Node.js, AWS Lambda","info"=>"Specializes in serverless architecture & microservices.","avtar"=>"/assets/developers/Dev.webp","company_logo"=>"/assets/previous/Payoneer.webp","company"=>"Payoneer"],
        ];
        $this->developer_list = collect($this->developer_list)->map(function ($dev) {
            return (array) $dev;
        })->toArray();
    }

    public function render()
    {
        return view('livewire.bacancypage.profiles');
    }
}
