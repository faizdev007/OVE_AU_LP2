<?php

namespace App\Livewire\Bacancypage;

use App\Facades\HelperFacade;
use App\Facades\LandingPagePatch;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ClientsProfile extends Component
{
    use WithFileUploads;
    
    public $successMessage,$errorMessage,$lp_data=[],$pageContent,$title,$subtitle,$clients=[],$removedata=[];

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $this->pageContent = isset($lp_data->page_contect) ? json_decode($lp_data->page_contect,true) : [];
        $this->title = $this->pageContent['clientInfo']['title'] ?? 'Client Success Stories That Go Beyond Testimonials';
        $this->subtitle = $this->pageContent['clientInfo']['subtitle'] ?? 'Explore how we helped businesses scale, pivot, and win in competitive markets.';
        $this->clients = $this->pageContent['clientInfo']['clients'] ?? 
        [
            [
                'name' => 'Jenny Junkeer',
                'title' => 'CEO, Intent',
                'video' => 'https://hire-ove.s3.ap-south-1.amazonaws.com/Jenny+Junkeer.mp4',
                'poster' => 'assets/clients/jenny.webp',
            ],
            [
                'name' => 'Mark Reisinger',
                'title' => 'MD, Web Zulu',
                'video' => 'https://hire-ove.s3.ap-south-1.amazonaws.com/Mark+Reisinger.mp4',
                'poster' => 'assets/clients/mark.webp',
            ],
            [
                'name' => 'Matt Lonergan',
                'title' => 'CEO, PMO PRO',
                'video' => 'https://hire-ove.s3.ap-south-1.amazonaws.com/Matt+Lonergan.mp4',
                'poster' => 'assets/clients/matt.webp',
            ],
            [
                'name' => 'Matthew Clews',
                'title' => 'MD, Sea Side Media',
                'video' => 'https://hire-ove.s3.ap-south-1.amazonaws.com/Matthew+Clews.mp4',
                'poster' => 'assets/clients/matthew.webp',
            ],
        ];

    }

    public function addClient()
    {
        $this->clients[] = ['name' => '', 'title' => '', 'video' => '', 'poster' => null];
    }

    public function removeClient($index)
    {
        if(isset($this->clients[$index]['poster']) && is_string($this->clients[$index]['poster'])){
            $this->removedata[] = $this->clients[$index]['poster'];
        }
        unset($this->clients[$index]);
        $this->clients = array_values($this->clients); // reindex
    }

    public function changeClient($index)
    {
        if(isset($this->clients[$index]['poster']) && is_string($this->clients[$index]['poster'])){
            $this->removedata[] = $this->clients[$index]['poster'];
        }
    }

    public function save()
    {
        $this->validate([
            "clients.*.name" => 'required|string|max:255',
            "clients.*.title" => 'required|string|max:255',
            "clients.*.video" => 'required|url',
            "clients.*.poster" => 'required',
        ]);

        try {
            //code...
            foreach ($this->removedata as $data)
            {
                HelperFacade::removeFile($data);
            }
    
            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            
            $clientsInfo = [];
            $clientsInfo['title'] = $this->title;
            $clientsInfo['subtitle'] = $this->subtitle;
    
            foreach ($this->clients as $client) {
                if(isset($client['video'])){
                    $posterPath = HelperFacade::uploadFile($client['poster'],'bacancy/testimonials/posters');
        
                    $clientsInfo['clients'][] = [
                        'name' => $client['name'],
                        'title' => $client['title'],
                        'video' => $client['video'],
                        'poster' => $posterPath,
                    ];
                }
            }
    
            $contentdata['clientInfo'] = $clientsInfo;
    
            LandingPagePatch::update($this->lp_data,$contentdata);
    
            // $this->mount($this->lp_data); // Reset the form
            $this->successMessage = 'Section updated Successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorMessage = $th->getMessage();
        }
        
    }

    public function render()
    {
        return view('livewire.bacancypage.clients-profile');
    }

}