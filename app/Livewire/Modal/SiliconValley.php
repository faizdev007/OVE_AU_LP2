<?php

namespace App\Livewire\Modal;

use App\Facades\HelperFacade;
use App\Models\ModalData;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SiliconValley extends Component
{
    use WithFileUploads;

    public $image,$old_path;
    public $modalData=null,$lp_name,$title,$lists=[],$stacktitle,$formtitle,$formsubtitle;
    
    public $successMessage = '';
    
    public $errorMessage = '';

    public $buttonText = 'Submit';

    public $stack = [
        ['title' => '', 'description' => '']
    ];

    public function addStack()
    {
        $this->stack[] = ['title' => '', 'description' => ''];
    }

    public function removeStack($index)
    {
        unset($this->stack[$index]);
        $this->stack = array_values($this->stack);
    }

    public function addItem()
    {
        $this->lists[] = ''; // Push an empty item
    }

    public function removeItem($index)
    {
        unset($this->lists[$index]);
        $this->lists = array_values($this->lists); // Reindex array
    }

    public function mount()
    {
        $find = ModalData::where('lp_name','bacancy')->first();
        $this->lp_name = $find->lp_name ?? 'bacancy';
        $this->modalData = isset($find) ? json_decode($find->data,true) : [];
        $this->title = $this->modalData['title'] ?? 'Reduce Your hiring cost by upto 60%.';
        $this->lists = $this->modalData['lists'] ?? [
            'Resume within 48 Hours with Quote',
            'AI Powered Recruitment',
            'No Upfront Cost',
            'Trusted by Startups & Fortune 500 Companies',
        ];
        $this->formtitle = $this->modalData['formtitle'] ?? 'Talk to our experts';
        $this->formsubtitle =  $this->modalData['formsubtitle'] ?? 'Kickstart Your Digital Journey Today';
        $this->stacktitle =  $this->modalData['stacktitle'] ?? 'You are in good company -';
        $this->stack =  $this->modalData['stack'] ?? [
            ['title' => 'ESTD', 'description' => '2006'],
            ['title' => 'CMMI', 'description' => 'Level 3'],
            ['title' => 'Offices', 'description' => '4 Location'],
            ['title' => 'Staff', 'description' => '400 +']
        ];
        $this->old_path = $this->modalData['image'] ?? '/assets/ratingimg.webp';
    }

    public function savemodal()
    {
        try {
            //code...
            if(is_object($this->image)){
                HelperFacade::removeFile($this->old_path);
            }
            ModalData::updateOrCreate(
                ['lp_name' => $this->lp_name],
                [
                    'lp_name' => $this->lp_name,
                    'data' => json_encode([
                        'title'       => $this->title,
                        'lists'      => $this->lists,
                        'stacktitle' => $this->stacktitle,
                        'stack'      => $this->stack,
                        'formtitle'  => $this->formtitle,
                        'formsubtitle' => $this->formsubtitle,
                        'image' => HelperFacade::uploadFile($this->image,'bacancy/company_logos'),
                    ]),
                ]
            );
            
            $this->successMessage = 'Section updated Successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorMessage = $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.modal.silicon-valley');
    }
}
