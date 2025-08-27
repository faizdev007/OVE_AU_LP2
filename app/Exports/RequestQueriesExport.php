<?php
namespace App\Exports;

use App\Models\RequestQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequestQueriesExport implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return RequestQuery::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get([
                'name', 'email', 'phone', 'project_brief', 'lp_url', 'ip_address', 'created_at'
            ]);
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Phone', 'Requirement', 'LP URL', 'IP Address', 'Qeuery Date'];
    }
}
