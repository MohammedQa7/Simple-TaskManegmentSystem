<?php

namespace App\Observers;

use App\Models\Task;
use App\Notifications\EmailNotification;
use App\Notifications\WebsiteNotification;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        if ($task) {
            $assigned_user_notify = $task->assigneduser;
            $maneger = $task->user;
            $assigned_user_notify->notify(new EmailNotification($assigned_user_notify , $maneger));
            $assigned_user_notify->notify(new WebsiteNotification($task));
        }
        
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
