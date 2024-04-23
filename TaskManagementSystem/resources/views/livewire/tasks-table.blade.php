<div>
  <style>
    .select2-container--open .select2-dropdown--below{
      width: 320px !important;
    }
  </style>
  @can('create',App\Models\Task::class)
  <div class="task-btn d-flex flex-row-reverse">
    <form action="{{Route('create_task')}}" method="get">
      <button type="submit" class="btn btn-outline-primary  ">
        Add Task
        <i class="fa fa-plus text-primary ms-2"></i>
      </button>
    </form>
  </div>
  @endcan


    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="md-auto pe-md-3 d-flex justify-content-between align-items-center">
            <div class="card-header pb-0">
              <h6>Tasks table</h6>
            </div>
                <div class="card-header pb-1 input-group w-20">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input wire:model.live.debounce.500ms="search_query" type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
             
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Task name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">assigned user</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">task priority</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">created by</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">first created</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <x-tasks.taskData>
                    </x-tasks.taskData>
                  </tbody>
                  
                </table>
                {{$this->Tasks->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
