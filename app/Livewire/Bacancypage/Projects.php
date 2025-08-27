<?php

namespace App\Livewire\Bacancypage;

use App\Facades\HelperFacade;
use App\Facades\LandingPagePatch;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Projects extends Component
{
    use WithFileUploads;

    public $successMessage,$errorMessage,$lp_data,$title,$subtitle,$ourProjects=[],$projects=[],$removePimg=[];

    public function addProject()
    {
        $this->projects[] = [
            'project_name' => '',
            'label_tag' => '',
            'brief_detail' => '',
            'highlights' => [''],
            'web_pic' => null,
        ];
    }

    public function removeProject($index)
    {
        if(isset($this->projects[$index]['web_pic']) && !is_object($this->projects[$index]['web_pic'])){
            $this->removePimg[] = $this->projects[$index]['web_pic'];
        }
        unset($this->projects[$index]);
        $this->projects = array_values($this->projects); // reindex
    }

    public function removeChangeImg($index)
    {
        if(isset($this->projects[$index]['web_pic']) && !is_object($this->projects[$index]['web_pic'])){
            $this->removePimg[] = $this->projects[$index]['web_pic'];
        }
    }

    public function addHighlight($projectIndex)
    {
        $this->projects[$projectIndex]['highlights'][] = '';
    }

    public function removeHighlight($projectIndex, $highlightIndex)
    {
        unset($this->projects[$projectIndex]['highlights'][$highlightIndex]);
        $this->projects[$projectIndex]['highlights'] = array_values($this->projects[$projectIndex]['highlights']);
    }

    public function save()
    {
        try {
            $this->validate([
                'projects.*.project_name' => 'required',
                'projects.*.label_tag' => 'required',
                'projects.*.brief_detail' => 'required',
            ]);
            //code...

            $newprojects = [];
            
            foreach($this->projects as $single)
            {
                $single['web_pic'] = HelperFacade::uploadFile($single['web_pic'],'bacancy/projects');
                $newprojects[] = $single;
            }

            foreach($this->removePimg as $imgfile)
            {
                HelperFacade::removeFile($imgfile);
            }

            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $contentdata['ourProjects'] = [
                'title'=>$this->title,
                'subtitle'=>$this->subtitle,
                'projects'=>$newprojects,
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
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $projectdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
        $this->title = $projectdata['ourProjects']['title'] ?? 'Things We’ve Shipped';
        $this->subtitle = $projectdata['ourProjects']['subtitle'] ?? 'From rapid MVPs to enterprise-grade systems—here’s what happens when great teams build right.';
        $this->projects = $projectdata['ourProjects']['projects'] ?? [
            ['project_name' => 'The President’s Club" BI System for Flow', 'label_tag' => 'BUSINESS INTELLIGENCE', 'brief_detail' => 'Flow, a major Caribbean telco operating across 15 markets, lacked visibility into retail performance following its merger. We developed a smart Business Intelligence platform', 'highlights'=>['Unified KPIs across 200+ retail locations','Executive BI dashboard for real-time insights','Store & staff performance tracking','Visual reports for faster decisions','Data-driven coaching & resource allocation'], 'web_pic' => '/assets/project/mapleware.webp'],
            ['project_name' => 'End-to-End Software Delivery Hub for Global Enterprises', 'label_tag' => 'ENTERPRISE DEVOPS', 'brief_detail' => 'We helped Plutora build a robust enterprise DevOps platform to unify release management, deployment planning, and test environment oversight. Designed for large-scale organizations', 'highlights'=>['Centralized release & deployment','Real-time dashboards & insights','Automated testing with Cypress','CI/CD integrated (Git, Jira, Jenkins)','Cloud-native (AWS, Docker, K8s)','2.5× releases, 85% faster coordination'], 'web_pic' => '/assets/project/plutora.webp'],
        ];
    }

    public function render()
    {
        return view('livewire.bacancypage.projects');
    }
}
