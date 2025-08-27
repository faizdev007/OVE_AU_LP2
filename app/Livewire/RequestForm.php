<?php

namespace App\Livewire;

use App\Jobs\SendQueryEmailJob;
use App\Mail\SendQueryMail;
use App\Models\RequestQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class RequestForm extends Component
{
    public $successMessage,$errorMessage,$name,$email,$phone,$project_brief,$buttonText=null;

    public function mount($buttonText = null)
    {
        $this->buttonText = $buttonText;
    }

    public function submitquery(Request $request)
    {
        try {
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
        return view('livewire.request-form');
    }
}
