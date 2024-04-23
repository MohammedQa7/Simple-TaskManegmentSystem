<?php

namespace App\Livewire;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TeamDetails extends Component
{
    public $team_detials;
    private $invite_url;
    private $user;
    public function mount($team_details)
    {
        $this->team_detials = $team_details;
    }

    #[Computed]
    public function TeamMembers()
    {
        $team_members = $this->team_detials->load('members');
        if (!is_null($team_members->members)) {
            return $team_members;
        }
    }

    #[Computed]
    public function TeamTasks()
    {
        $team_tasks = $this->team_detials->load('teamManeger');
        if (!is_null($team_tasks->tasks)) {
            return $team_tasks;
        }
    }

    public function GenerateInvite(Request $request)
    {
        $this->authorize('canInvite', $this->team_detials);
        $this->invite_url = URL::temporarySignedRoute('invite_link', now()->addMinutes(5), [
            'slug' => $this->team_detials->slug
        ]);
        $this->dispatch('open-modal', name: 'invite');
        // dd($this->invite_url);
    }

    public function DeleteModal($user = null)
    {
        $this->user = $user;
        $this->dispatch('open-modal', name: 'delete');
    }

    public function deleteMember($id = null)
    {
        if (empty($id)) {
            abort(404);
        } else {
            $this->authorize('removeMember', $this->team_detials);
            $user = User::findOrFail($id);
            if (Auth::user()->IsManeger() || Auth::user()->IsOwner()) {
                if ($this->team_detials->CheckForTeamMemeber($user->id)) {
                    $user->members()->detach($this->team_detials->id);
                    session()->flash('success_delete', 'Memeber Deleted Successfully :)');
                } else {
                    session()->flash('error', 'Something went wrong. Try Again Later');
                }
            } else {
                abort(403);
            }
        }
    }

    public function deleteTeam($id = null)
    {
        if (empty($id)) {
            abort(404);
        } else {
            $this->authorize('removeMember', $this->team_detials);
            $team = Team::findOrFail($id);
            if (Auth::user()->IsManeger() || Auth::user()->IsOwner()) {
                if ($this->team_detials->CheckForTeamManeger(Auth::user()->id)) {
                    $team->members()->detach();
                    $team->delete();
                    session()->flash('success_delete', 'Team Deleted Successfully :)');
                    return redirect()->to('/teams');
                } else {
                    session()->flash('error', 'Something went wrong. Try Again Later');
                }
            } else {
                abort(403);
            }
        }
    }


    public function render()
    {
        return view('livewire.team-details');
    }
}