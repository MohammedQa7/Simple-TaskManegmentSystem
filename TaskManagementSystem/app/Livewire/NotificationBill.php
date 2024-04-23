<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class NotificationBill extends Component
{


    public function NotificationsBill()
    {
        $this->dispatch('open-modal' , name:'notify');
    }

    public function getdata()
    {
        dd('test');
    }

    public function render()
    {
        return view('livewire.notification-bill');
    }
}
