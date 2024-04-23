<?php

namespace App\Livewire;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TeamsTable extends Component
{

    use WithPagination;

    #[Url]
    public $search_query = '';
    
    #[Computed]
    public function Teams()
    {
        $all_teams = Team::
        Search($this->search_query)
        ->with('members')
        ->when(Auth::user()->IsManeger() , function($query){
            $query->ManegerTeams();
        })
        ->when(Auth::user()->IsDefault() , function($query){
            $query->MembersTeams();
        })
        ->paginate(5);
        if ($all_teams) {
            return $all_teams;
        }
    }

    public function render()
    {
        return view('livewire.teams-table');
    }
}
