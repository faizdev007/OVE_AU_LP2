<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ModalSelector extends Component
{
    public $selectedModal = ''; // Holds the current selected modal

    // List your available modal components here
    public $modalOptions = [
        '' => '-- Select a Modal --',
        'modal.bacancy' => 'Bacancy Modal',
        'modal.silicon-valley' => 'Silicon Valley Modal',
    ];

    public function render()
    {
        return view('livewire.admin.modal-selector');
    }
}
