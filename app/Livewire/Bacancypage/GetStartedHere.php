<?php

namespace App\Livewire\Bacancypage;

use App\Facades\LandingPagePatch;
use App\Jobs\SendQueryEmailJob;
use App\Mail\SendQueryMail;
use App\Models\RequestQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class GetStartedHere extends Component
{
    public $successMessage,$errorMessage,$lp_data=null,$pageContent=null,$data_gsh=[],$btntext,$gsh_title,$gsh_subtitle,$gsh_email,$gsh_watchword,$gsh_short_note;

    public $name,$email,$phone,$project_brief;

    protected $rules = [
        'gsh_title' => ['required','max:200'],
        'gsh_subtitle' => ['required','max:500'],
        'gsh_email' => ['required','max:100'],
        'gsh_watchword' => ['required','max:200'],
        'gsh_short_note' => ['required'],
    ];

    public function save()
    {
        try {
            $this->validate();
            
            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $contentdata['GSH'] = [
                'gsh_title' => $this->gsh_title,
                'gsh_subtitle' => $this->gsh_subtitle,
                'gsh_email' => $this->gsh_email,
                'gsh_watchword' => $this->gsh_watchword,
                'gsh_short_note' => $this->gsh_short_note,
                'btntext'=>$this->btntext
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
        $this->pageContent = isset($lp_data->page_contect) ? json_decode($lp_data->page_contect,true) : [];
        $this->gsh_title = isset($this->pageContent['GSH']) ? $this->pageContent['GSH']['gsh_title'] : 'Start a Conversation';
        $this->gsh_subtitle = isset($this->pageContent['GSH']) ? $this->pageContent['GSH']['gsh_subtitle'] : 'We’re excited to work with you. Take the first step toward your next big project.';
        $this->gsh_email = isset($this->pageContent['GSH']) ? $this->pageContent['GSH']['gsh_email'] : 'Enquiry@optimalvirtualemployee.com';
        $this->gsh_watchword = isset($this->pageContent['GSH']) ? $this->pageContent['GSH']['gsh_watchword'] : 'Not Just Developers—Your Tech Partners.';
        $this->gsh_short_note = isset($this->pageContent['GSH']) ? $this->pageContent['GSH']['gsh_short_note'] : 'Our remote teams plug in instantly and perform like your in-house engineers. Let’s discuss how we can extend your team—contact us today.';
        $this->btntext = $this->pageContent['GSH']['btntext'] ?? 'Get Started';
    }

    public function querysubmit(Request $request)
    {
        try {
            //code...
            $this->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'regex:/^\+?[0-9\s\-()]{7,20}$/'],
                'project_brief' => ['required'],
            ],[
                'name.required' => 'Please enter your name.',
                
                'email.required' => 'Email is required.',
                'email.email' => 'Enter a valid email address.',
                
                'phone.required' => 'Phone number is required.',
                'phone.regex' => 'Enter a valid 10-digit phone number.',

                'project_brief.required' => 'Please describe your project.'
            ]);

            $query = RequestQuery::create([
                'name'=>$this->name,
                'email'=>$this->email,
                'phone'=>$this->phone,
                'project_brief'=>$this->project_brief,
                'lp_url'=>$request->headers->get('referer'),
                'ip_address'=>$request->ip(),
            ]);

            // Dispatch email job
            SendQueryEmailJob::dispatch($query);

            $this->reset(['name', 'email', 'phone', 'project_brief']);

            session()->flash('allow_success', true);
            
            $this->successMessage = 'Thank You!';
            return redirect()->route('thankyou');
        } catch (\Throwable $th) {
            Log::error('Form submission failed', ['error' => $th->getMessage()]);
            $this->errorMessage = $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.bacancypage.get-started-here');
    }
}
