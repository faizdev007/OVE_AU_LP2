<?php

namespace App\Livewire\Bacancypage;

use App\Facades\LandingPagePatch;
use Livewire\Component;

class Faq extends Component
{
    public $successMessage,$errorMessage,$lp_data=[],$title,$subtitle,$btntitle,$faqs=[];

    public function addfaq()
    {
        $this->faqs[] = [
            'question' => '',
            'answer' => '',
        ];
    }

    public function removefaq($index)
    {
        unset($this->faqs[$index]);
        $this->faqs = array_values($this->faqs); // reindex
    }

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $faq = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
        $this->title = $faq['faq']['title'] ?? 'Frequently Asked Questions';
        $this->subtitle = $faq['faq']['subtitle'] ?? 'Still have question ?';
        $this->btntitle = $faq['faq']['btntitle'] ?? 'Let’s Talk';
        $this->faqs = $faq['faq']['faqs'] ?? [
                        ['question' => 'Do you provide AUD rates due to Currency Fluctuations?', 'answer' => 'Yes, We do provide AUD rates as per your request for a lock-in period of 12 Months.'],
                        ['question' => 'What would be the Working Hours of the Developer?', 'answer' => 'Developers will be working on AEST time with an overlapping availability of 6 to 7 AEST hours, so you will have full time zone coverage.'],
                        ['question' => 'What tools do you use for Project Management and Communication?', 'answer' => 'For managing projects, we utilize tools like JIRA, TRELLO, BASECAMP, etc. To facilitate communication, we rely on platforms such as SLACK and MS TEAMS.'],
                        ['question' => 'Do I work directly with the developer?', 'answer' => 'Yes, You would be working directly with the Developer.'],
                        ['question' => 'Do you ensure the security and confidentiality of our intellectual property?', 'answer' => 'We do sign an NDA to ensure confidentiality and agreement for the IP rights. All IP rights belong to you and we are just the development partner.']
                    ];
    }

    public function save()
    {
        try {
            $this->validate([
                'title'=>'required',
                'subtitle'=>'required',
                'btntitle'=>'required',
                'faqs.*.question'=>'required',
                'faqs.*.answer'=>'required',
            ]);
            
            $content = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            //code...
            $content['faq'] = [
                'title'=>$this->title,
                'subtitle'=>$this->subtitle,
                'btntitle'=>$this->btntitle,
                'faqs'=>$this->faqs,
            ];
            
            LandingPagePatch::update($this->lp_data,$content);
            
            $this->successMessage = 'Section updated Successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorMessage = $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.bacancypage.faq');
    }
}
