<?php

namespace App\Livewire\SiliconValley;

use App\Facades\HelperFacade;
use App\Facades\LandingPagePatch;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AiBlock extends Component
{
    use WithFileUploads;

    public $successMessage,$errorMessage,$lp_data=null,$pageContent=null,$btntext,$aiblock_title,$aiblock_watchword,$aiblock_subtitle,$logo_webp,$ai_logo_one,$ai_logo_two,$ai_logo_three,$removeLogos=[];

    protected $rules = [
        'aiblock_title' => 'required|max:200',
        'aiblock_watchword' => 'required|max:200',
        'aiblock_subtitle' => 'required|max:500',
        // 'logo_webp' => 'nullable|image|mimes:webp|max:2048',
        // 'ai_logo_one' => 'nullable|image|mimes:webp|max:2048',
        // 'ai_logo_two' => 'nullable|image|mimes:webp|max:2048',
        // 'ai_logo_three' => 'nullable|image|mimes:webp|max:2048',
    ];

    protected function messages()
    {
        return [
            'aiblock_title.required' => 'The title field is required.',
            'aiblock_title.max' => 'The title may not be greater than 200 characters.',
            
            'aiblock_watchword.required' => 'The watchword field is required.',
            'aiblock_watchword.max' => 'The watchword may not be greater than 200 characters.',
            
            'aiblock_subtitle.required' => 'The subtitle field is required.',
            'aiblock_subtitle.max' => 'The subtitle may not be greater than 500 characters.',
        ];
    }

    public function save()
    {
        try {
            $this->validate();

            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $contentdata['aiblock'] = [
                'aiblock_title' => $this->aiblock_title,
                'aiblock_watchword' => $this->aiblock_watchword,
                'aiblock_subtitle' => $this->aiblock_subtitle,
                'btntext'=>$this->btntext
            ];

            if (isset($this->logo_webp) && is_object($this->logo_webp) && isset($this->pageContent['aiblock']['logo_webp'])) {
                HelperFacade::removeFile($this->pageContent['aiblock']['logo_webp']);
            }

            $contentdata['aiblock']['logo_webp'] = HelperFacade::uploadFile($this->logo_webp,'bacancy/AI/logo');

            foreach(['one','two','three'] as $val)
            {   
                $logo = "ai_logo_".$val;
                if (isset($this->$logo) && is_object($this->$logo) && isset($this->pageContent['aiblock'][$logo])) {
                    HelperFacade::removeFile($this->pageContent['aiblock'][$logo]);
                }
                $contentdata['aiblock'][$logo] = HelperFacade::uploadFile($this->$logo,'bacancy/AI/ai_logo');
            }

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
        $this->pageContent = isset($lp_data->page_contect) ? json_decode($lp_data->page_contect,true) : [];
        $aiblock = isset($this->pageContent['aiblock']) ? $this->pageContent['aiblock'] : [];
        $this->aiblock_title = isset($aiblock['aiblock_title']) ? $aiblock['aiblock_title'] : 'Get your work done faster with';
        $this->aiblock_watchword = isset($aiblock['aiblock_watchword']) ? $aiblock['aiblock_watchword'] : 'AI-Enhanced-Talent';
        $this->aiblock_subtitle = isset($aiblock['aiblock_subtitle']) ? $aiblock['aiblock_subtitle'] : 'Our engineers use cutting-edge AI to supercharge coding, reduce bugs, and accelerate delivery.';
        $this->logo_webp = isset($aiblock['logo_webp']) ? $aiblock['logo_webp'] : '/assets/AI/logo.webp';
        $this->ai_logo_one = isset($aiblock['ai_logo_one']) ? $aiblock['ai_logo_one'] : '/assets/AI/cursor.webp';
        $this->ai_logo_two = isset($aiblock['ai_logo_two']) ? $aiblock['ai_logo_two'] : '/assets/AI/githubcop.webp';
        $this->ai_logo_three = isset($aiblock['ai_logo_three']) ? $aiblock['ai_logo_three'] : '/assets/AI/claude.webp';
        $this->btntext = $aiblock['btntext'] ?? 'Hire a Developer';
    }

    public function render()
    {
        return view('livewire.silicon-valley.ai-block');
    }
}
