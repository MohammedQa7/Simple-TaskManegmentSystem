<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $taskCreation_chart_data = $this->getCreatedTasksChart();
        $completd_tasks_chart = $this->getTasksStatusChart('completed');
        $not_completd_tasks_chart = $this->getTasksStatusChart('not_completed');
        $total_users = Cache::remember('total_users' , now()->addWeek(), function(){
            return User::
            where('created_at' , '>=' , Carbon::now()->subWeek()->startOfWeek())
            ->get()
            ->count();
        });
        $total_tasks = Cache::remember('total_tasks' , now()->addWeek(), function(){
            return Task::
            where('created_at', '>='  , Carbon::now()->subWeek()->startOfWeek())
            ->get()
            ->count();
        });

        $user_tasks_status = $this->getUserWithTasks();
        return view('main_dashboard.dashboard')
        ->with([
            'task_creation_chart_data' => $taskCreation_chart_data,
            'completd_tasks_chart' => $completd_tasks_chart,
            'not_completd_tasks_chart' => $not_completd_tasks_chart,
            'total_users' => $total_users,
            'total_tasks' => $total_tasks,
            'user_tasks_status' => $user_tasks_status
        ]);
    }


    public function getCreatedTasksChart()
    {
        $total_tasks_per_month = [];
        $all_months = [];
        $tasks = Task::select('id' , 'created_at')
        ->get()
        ->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('M');
        });
        foreach ($tasks as $key => $task) {
            $total_tasks_per_month []= count($task);
            $all_months [] = $key;
        }

        return $taskCreation_chart_data = [
            'labels' => $all_months,
            'data' => $total_tasks_per_month
        ];
    }

    public function getTasksStatusChart($status)
    {
        $task_status_data = [];
        $task_status = [];
        $tasks = Task::select('id' ,'status' ,'created_at')
        ->whereIn('status' , [$status])
        ->get()
        ->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('M');
        });
        foreach ($tasks as $key => $task) {
            $task_status_data []= count($task);
            $task_status [] = $key;
        }
        return $taskStatus_chart_data = [
            'labels' => $task_status,
            'data' => $task_status_data
        ];
    }

    public function getUserWithTasks()
    {
        $users_info = User::isMember()
        ->with(['assignedtasks' => function($query){
            if (Auth::user()->IsManeger()) {
                $query->where('user_id' , Auth::user()->id);
            }
        }])
        ->get();

        if (!is_null($users_info)) {
            $all_Completed=[];
            foreach ($users_info as $user) {
                if (sizeof($user->assignedtasks) > 0) {
                    foreach ($user->assignedtasks as $single_task) {
                        if ($single_task->status == 'completed') {
                            $all_Completed [] = $single_task->status;
                        } 
                    }
                    // dd(count($all_notCompleted) , $user->assignedtasks);
                    $percentage = (int) round(count($all_Completed) / count($user->assignedtasks) * 100);
                    $user->completion_percentage = $percentage;
                    $all_Completed = [];
                }
            }
        }
        return $users_info;
 
    }
}
