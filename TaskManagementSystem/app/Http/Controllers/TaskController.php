<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskValidationRequest;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use League\CommonMark\Parser\Block\BlockContinueParserWithInlinesInterface;
use Mews\Purifier\Purifier;

class TaskController extends Controller
{
    public function index()
    {
        
        return view('main_dashboard.tasks');
    }

    public function create($team_slug = null)
    {
        $team = Team::where('slug' , $team_slug)
        ->with('teamManeger')
        ->first();
        if (!empty($team_slug)) {
                if ($team->teamManeger->id == Auth::user()->id && Auth::user()->IsManeger()) {
                    $users = User::with('members')
                    ->IsMemberOfTeam($team->id)
                    ->get();
                }else{
                    return view('main_dashboard.404page');
                }
        }else{
            $users = User::where('role'  , User::DEFAULT_ROLE)->get();
        }
        return view('main_dashboard.task_creation.createTask')->with([
            'users' => $users,
            'team_slug' => $team,
        ]);
    }

    public function store(TaskValidationRequest $request , $team_slug = null)
    {
        $this->authorize('create' , Task::class);
        \Mews\Purifier\Facades\Purifier::clean($request->description);
        $team = Team::where('slug' , $team_slug)
        ->with('teamManeger')
        ->first();
        $task = Task::create([
            'name' => $request->taskname,
            'slug' => Str::slug($request->taskname),
            'priority' => $request->priority,
            'description' =>$request->description,
            'status' => Task::DEFAULT_STATUS,
            'user_id' => Auth::user()->id,
            'assigned_user_id' => $request->assignedUser,
            'team_id' => ( !empty($team->teamManeger) && $team->teamManeger->id == Auth::user()->id && Auth::user()->IsManeger() && $team->CheckForTeamMemeber($request->assignedUser) ? $team->id : null),
        ]);

        if ($task && !empty($team->teamManeger)) {    
            notify()->success('Task Created To' .' '. "$team->slug");
            return redirect()->back();
        }elseif($task && empty($team->teamManeger)){
            notify()->success('Task Created To An Individual');
            return redirect()->back();
        }else{
            notify()->error('Something went wrong , try creating a new task again');
            return redirect()->back();
        }
    }

    public function show($slug = null)
    {
        if (!empty($slug)) {
            $task = Task::where('slug' , $slug)->with('user' , 'assigneduser')->first();
            if ($task) {
                return view('main_dashboard.task_details')->with('task' , $task);
            }else{
                return view('main_dashboard.404page');    
            }
        }else{
            return view('main_dashboard.404page');
        }
        
    }
}
