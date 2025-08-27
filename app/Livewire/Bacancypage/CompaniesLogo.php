<?php

namespace App\Livewire\Bacancypage;

use App\Facades\HelperFacade;
use App\Facades\LandingPagePatch;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

use function PHPUnit\Framework\isEmpty;

class CompaniesLogo extends Component
{
    use WithFileUploads;

    public $successMessage,$errorMessage,$lp_data=null,$previews=null;

    public array $company_logos = []; // for uploads
    public $existing_logos = null; // for already uploaded files
    public array $removed_logos = []; // for remove files

    public function mount($lp_data)
    {
        $this->lp_data = isset($lp_data) ? $lp_data : [];
        $data = isset($lp_data->page_contect) ? json_decode($lp_data->page_contect,true) : [];
        $this->existing_logos =  $data['companies_logo'] ?? [
            '/assets/companies/company1.webp', '/assets/companies/company2.webp', '/assets/companies/company3.webp', '/assets/companies/company4.webp',
            '/assets/companies/company5.webp', '/assets/companies/company6.webp', '/assets/companies/company7.webp', '/assets/companies/company8.webp',
            '/assets/companies/company9.webp', '/assets/companies/company10.webp', '/assets/companies/company11.webp', '/assets/companies/company12.webp',
        ];
    }

    public function save()
    {
        try {

            // Remove logos
            foreach ($this->existing_logos as $path) {
                HelperFacade::removeFile($path);
            }


            // Upload new logos
            foreach ($this->company_logos as $logo) {
                $this->existing_logos[] = HelperFacade::uploadFile($logo,'bacancy/company_logos');
            }

            $contentdata = isset($this->lp_data['page_contect']) ? json_decode($this->lp_data['page_contect'],true) : [];
            $contentdata['companies_logo'] = array_values($this->existing_logos);
            
            LandingPagePatch::update($this->lp_data,$contentdata);
            
            $this->successMessage = 'Section updated Successfully!';
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorMessage = $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.bacancypage.companies-logo');
    }
}
