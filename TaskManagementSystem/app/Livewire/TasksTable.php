<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Validator;

class TasksTable extends Component
{
    use WithPagination;

    public $task_name;
    public $task_priority;
    public $task_status;
    public $edtiableFieldIndex = null;

    #[Url]
    public $search_query ='';
    public function rules()
    {
        // test
        return [
            'task_name' =>['required' ,
            function($attribute , $value , $fail) {
                if(Auth::user()->IsManeger() || Auth::user()->IsOwner()){
                    // ...
                }else{
                    $fail('Unauthorized Change');
                }
            }
        ],
            'task_priority' =>['required' ,
            function($attribute , $value , $fail) {
                if(Auth::user()->IsManeger() || Auth::user()->IsOwner()){
                    // ...
                }else{
                    $fail('Unauthorized Change');
                }
            }
        ],
            'task_status' => ['required' , 'in:not_completed,completed,cancled'],
        ];
    }

    #[Computed]
    public function Tasks()
    {
            $tasks = Task::with('user' , 'assigneduser')
            ->when(Auth::user()->IsManeger() , function($query){
                $query->ManegerTasks();
            })

             ->when(Auth::user()->IsDefault() , function($query){
                $query->MemberTasks();
            })
            ->Search($this->search_query)  
            ->orderBy('created_at' , 'DESC') 
            ->paginate(5);
            // dd($tasks->toArray());
            return $tasks;
    }

    #[Computed]
    public function Users()
    {
        $users = User::isMember()->get();
        return $users;
    }

    public function IsEditable($field_index)
    {   
        $this->edtiableFieldIndex = $field_index;
       if (!is_null($this->edtiableFieldIndex)) {
            $tasks_array = Task::with('assigneduser')
            ->find($this->edtiableFieldIndex)->toArray();

            if ($tasks_array) {
                $this->task_name = $tasks_array['name'];
                $this->task_priority = $tasks_array['priority'];
                $this->task_status = $tasks_array['status'];
            }

       }
        
    }
    public function NotEditable()
    {
        $this->edtiableFieldIndex = null;
        
    }

    public function SaveEditedTask()
    {
       if (Auth::user()->IsManeger() || Auth::user()->IsOwner()) {
            $this->validate();  
            $tasks =  Task::with('assigneduser')
            ->find($this->edtiableFieldIndex);
            if ($tasks) {
                $tasks->update([
                    'name' => $this->task_name,
                    'slug' => $this->task_name,
                    'priority' => $this->task_priority,
                    'status' => $this->task_status,
                ]);

                notify()->success('Task has been edited');
            }
                $this->edtiableFieldIndex = null;
        }else{
            $this->validateOnly('task_status');  
            $tasks =  Task::with('assigneduser')
            ->find($this->edtiableFieldIndex);
            if ($tasks) {
                $tasks->update([
                    'status' => $this->task_status,
                ]);
                notify()->success('Task has been edited');
            }
                $this->edtiableFieldIndex = null;
        }
    }



    public function render()
    {
        return view('livewire.tasks-table');
    }
}
