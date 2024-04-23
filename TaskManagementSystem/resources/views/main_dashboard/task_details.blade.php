<x-app-layout>
    <div class="container-fluid">

        <div class="container">
          <!-- Title -->
          <div class="d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> {{$task->name}}</h2>
          </div>
        
          <!-- Main content -->
          <div class="row">
            <div class="col-lg-8">
              <!-- Details -->
              <div class="card mb-4">
                <div class="card-body">
                  <div class="mb-3 d-flex justify-content-between">
                    <div>
                      <span class="badge rounded-pill bg-gradient-{{$task->priority == "normal" ? 'info' :($task->priority=='not_urgent' ? 'warning' : ($task->priority == 'urgent' ? 'danger' : ''))}}">{{$task->priority}}</span>
                    </div>
                  </div>
                  <h3 class="h6">Task Description</h3>
                  @isset($task->description)
                  <p>{!! $task->description!!}</p>
                  @else
                  <div class="rounded flex items-center justify-center h-px-100 bg-light">
                    <div class=""">
                        <p class="m-0">No Description</p>
                    </div>
                  </div>
                  @endisset
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card mb-4">
                <!-- Shipping information -->
                <div class="card-body">
                  <h3 class="h6">Task Status</h3>
                  <span class="badge rounded-pill bg-gradient-{{$task->status == "completed" ? 'success' :($task->status=='not_completed' ? 'secondary' : ($task->status == 'cancle' ? 'danger' : ''))}}">{{$task->status}}</span>
                  <hr>
                  <h3 class="h6">Assigned by</h3>
                  <p>{{$task->user->name}}</p>
                  <hr>
                  <h3 class="h6">To</h3>
                  <p>{{$task->assigneduser->name}} / {{$task->assigneduser->email}}</p>
                  <hr>
                  <h3 class="h6">Assigned in </h3>
                    <p>{{$task->created_at->diffForHumans(['parts' => 2])}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>