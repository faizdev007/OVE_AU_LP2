<?php

namespace App\Livewire\Bacancypage;

use App\Facades\LandingPagePatch;
use App\Jobs\SendQueryEmailJob;
use App\Mail\SendQueryMail;
use App\Models\RequestQuery;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class StartScalingYourTeam extends Component
{
    public $name,$email,$phone,$project_brief;

    public $successMessage,$errorMessage,$lp_data=[],$title,$subtitle,$points=[],$formtitle,$formsubtitle,$formbtntext;

    public function submitquery(Request $request)
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

    public function addpoint()
    {
        $this->points[] = [
            'title'=>'',
            'subtitle'=>'',
        ];
    }

    public function removepoint($index)
    {
        unset($this->points[$index]);
        $this->points = array_values($this->points);
    }

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $ssty = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
        $this->title = $ssty['SSYT']['title'] ?? 'Start Scaling Your Team';
        $this->subtitle = $ssty['SSYT']['subtitle'] ?? 'Empower your business with flexible, scalable staffing solutions';
        $this->formtitle = $ssty['SSYT']['formtitle'] ?? 'Talk to Our Experts';
        $this->formsubtitle = $ssty['SSYT']['formsubtitle'] ?? 'Kickstart Your Digital Journey Today';
        $this->formbtntext = $ssty['SSYT']['formbtntext'] ?? 'Book a 30 mins strategy call';
        $this->points = $ssty['SSYT']['points'] ?? [['title'=>'Submit Your Details','subtitle'=>'Your privacy is our priority, and your information is safe with us.'],['title'=>'What Happens Next?','subtitle'=>'A Growth Manager will reach out to you shortly.']];
    }

    public function save()
    {
        try {
            //code...
            $this->validate([
                'title'=> 'required',
                'subtitle'=> 'required',
                'formtitle'=> 'required',
                'formsubtitle'=> 'required',
                'formbtntext'=> 'required',
                'points.*.title'=> 'required',
                'points.*.subtitle'=> 'required',
            ]); 

            $content = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $content['SSYT'] = [
                'title'=> $this->title,
                'subtitle'=> $this->subtitle,
                'points'=> $this->points,
                'formtitle'=> $this->formtitle,
                'formsubtitle'=> $this->formsubtitle,
                'formbtntext'=> $this->formbtntext,
            ];
            
            LandingPagePatch::update($this->lp_data,$content);

         // session()->flash('success','Section updated Successfully!');
            $this->successMessage = 'Section updated Successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            // session()->flash('error',$th->getMessage());
            $this->errorMessage = $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.bacancypage.start-scaling-your-team');
    }
}
