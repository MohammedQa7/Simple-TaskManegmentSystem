<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamValidation;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        return view('main_dashboard.teams');
    }

    public function create()
    {
        return view('main_dashboard.team_creation.create-team');
    }

    public function store(TeamValidation $request)
    {
        $this->authorize('create', Team::class);

        $team = Team::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'maneger_id' => Auth::user()->id
        ]);

        if ($team) {
            notify()->success('Team has been created. Go to the team page to see all the team.');
            return redirect()->back();
        }
    }

    public function show(Team $slug)
    {
        $this->authorize('view' , $slug);
        return view('main_dashboard.team-details')->with('team' , $slug);
    }

    public function createMember(Team $slug)
    {
        $current_user = Auth::user();
        if ($slug) {
            foreach ($slug->members as $single_member) {
                if ($single_member->id == $current_user->id || $current_user->IsManeger() || $current_user->IsOwner()) {
                    return view('main_dashboard.expired');
                }
            }
            $slug->members()->attach($current_user->id);
            return view('main_dashboard.success_joined');
        }
    }
}
