<?php

namespace App\Livewire\SiliconValley;

use App\Jobs\SendQueryEmailJob;
use App\Models\RequestQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class QueryBlock extends Component
{
    public $requriedpoeple,$requiredwithin,$name,$email,$phone,$project_brief;
    public $successMessage,$errorMessage;
    public function submitForm(Request $request)
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

        $messageupdate = 'Requirement : '.($this->requriedpoeple ?? '').' / When do you want it : '.($this->requiredwithin ?? '').' '.(' / Requirement : ' .$this->project_brief);
        
        // Create a new RequestQuery instance

            $query = RequestQuery::create([
                'name'=>$this->name,
                'email'=>$this->email,
                'phone'=>$this->phone,
                'project_brief'=>$messageupdate,
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
        return view('livewire.silicon-valley.query-block');
    }
}
