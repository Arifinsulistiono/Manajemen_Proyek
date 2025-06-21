<?php

namespace App\Livewire;

use Livewire\Component;

class ShowKlinik extends Component
{
    public function render()
    {
        return view('livewire.show-klinik')
            ->layout('components.layouts.app', [
                'title' => 'Dashboard Klinik'
            ]);
    }
}
