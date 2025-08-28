<?php

namespace App\Livewire\Modal;

use App\Jobs\SendQueryEmailJob;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\ModalData;
use App\Models\RequestQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class HireDeveloper extends Component
{
    public function resetResendCooldown()
    {
        $this->resendCooldown = false;
    }

    public $step = 1;
    public $full_name, $company_email, $phone, $otp, $generated_otp;
    public $modalData=null,$lp_name,$title,$lists=[],$stacktitle,$formtitle,$formsubtitle;
    public $image,$old_path;
    public $otpSent = false; // Flag to track OTP sent status
    public $resendCooldown = false; // Flag to track resend cooldown
    public $stack = [
        ['title' => '', 'description' => '']
    ];

    // OTP verification rules
    protected $otpRules = [
        'otp' => 'required|numeric|digits:6',
    ];

    public function render()
    {
        return view('livewire.modal.hire-developer');
    }

    // Method to move to next step
    public function nextStep(Request $request)
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'company_email' => ['required','email', function ($attribute, $value, $fail) {
                // Disallow Gmail, Yahoo, Hotmail, etc.
                $forbiddenDomains = ['gmail.com','yahoo.com','hotmail.com','outlook.com','live.com'];
                $domain = substr(strrchr($value, "@"), 1); // Get domain after @
                if (in_array(strtolower($domain), $forbiddenDomains)) {
                    $fail('Please enter a company email address (no Gmail/Yahoo/Hotmail).');
                }
            }],
            'phone' => 'required|string|min:7|max:15',
        ]);


        RequestQuery::create([
            'name'=>$this->full_name,
            'email'=>$this->company_email,
            'phone'=>$this->phone,
            'project_brief'=>'N/A',
            'lp_url'=>$request->headers->get('referer'),
            'ip_address'=>$request->ip(),
        ]);

        // Generate OTP and send via email if in the first step
        if ($this->step == 1) {
            $this->generateAndSendOtp();
            $this->step = 2; // Move to next step (OTP verification)
        }
    }

    // Method to generate and send OTP
    private function generateAndSendOtp()
    {
        // Generate a random OTP
        $this->generated_otp = mt_rand(100000, 999999); // Numeric OTP

        // Send OTP via email (you can use a Mailable class here)
        Mail::to($this->company_email)->send(new OtpMail($this->generated_otp,$this->full_name));
        
        // Set OTP sent flag
        $this->otpSent = true;
        $this->resendCooldown = true; // Activate resend cooldown for 60 seconds

        // Reset resend cooldown flag after 60 seconds
        // session('start-resend-cooldown',['time' => 60]);
        // $this->dispatchBrowserEvent('start-resend-cooldown', ['time' => 60]);
    }

    // Method to verify OTP in second step
    public function verifyOtp(Request $request)
    {
        $this->validate($this->otpRules);

        // Verify the OTP entered by the user
        if ($this->otp == $this->generated_otp) {
            session()->flash('message', 'OTP verified successfully!');
            // Proceed to form submission or final step
            $query = RequestQuery::where([
                'email'=>$this->company_email,
                'phone'=>$this->phone,
                'project_brief'=>'N/A',
                'lp_url'=>$request->headers->get('referer'),
                'ip_address'=>$request->ip(),
            ])->first();

            $query->update(['project_brief'=>'verified']);

            $this->submitForm($query);
        } else {
            session()->flash('error', 'Invalid OTP. Please try again.');
        }
    }

    // Method to resend OTP if needed
    public function resendOtp()
    {
        dd($this->resendCooldown);
        if (!$this->resendCooldown) {
            $this->generateAndSendOtp(); // Resend OTP
            session()->flash('message', 'OTP resent successfully!');
        } else {
            session()->flash('error', 'Please wait before resending OTP.');
        }
    }

    // Method to submit the final form
    private function submitForm($query)
    {
        // Dispatch email job
        SendQueryEmailJob::dispatch($query);

        session()->flash('allow_success', true);
        
        return redirect()->route('thankyou');
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

    // protected function dispatchBrowserEvent(string $var, array $timer)
    // {
    //     dd($var,$timer);
    // }
}

