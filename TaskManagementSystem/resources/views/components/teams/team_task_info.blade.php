<div>
    <ul class="list-group">
        @if (sizeof($this->teamTasks->tasks) > 0)
        @foreach ($this->teamTasks->tasks as $single_task)
        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
          <div class="avatar me-3 bg-{{$single_task->priority =='urgent' ? 'red-500' : ($single_task->priority == 'not_urgent' ? 'yellow-400' : ($single_task->priority == 'normal' ? 'info' :''))}}" style="width:32px; height:32px;">
            @if ($single_task->priority == 'urgent')
            <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19.5099 5.85L13.5699 2.42C12.5999 1.86 11.3999 1.86 10.4199 2.42L4.48992 5.85C3.51992 6.41 2.91992 7.45 2.91992 8.58V15.42C2.91992 16.54 3.51992 17.58 4.48992 18.15L10.4299 21.58C11.3999 22.14 12.5999 22.14 13.5799 21.58L19.5199 18.15C20.4899 17.59 21.0899 16.55 21.0899 15.42V8.58C21.0799 7.45 20.4799 6.42 19.5099 5.85ZM11.2499 7.75C11.2499 7.34 11.5899 7 11.9999 7C12.4099 7 12.7499 7.34 12.7499 7.75V13C12.7499 13.41 12.4099 13.75 11.9999 13.75C11.5899 13.75 11.2499 13.41 11.2499 13V7.75ZM12.9199 16.63C12.8699 16.75 12.7999 16.86 12.7099 16.96C12.5199 17.15 12.2699 17.25 11.9999 17.25C11.8699 17.25 11.7399 17.22 11.6199 17.17C11.4899 17.12 11.3899 17.05 11.2899 16.96C11.1999 16.86 11.1299 16.75 11.0699 16.63C11.0199 16.51 10.9999 16.38 10.9999 16.25C10.9999 15.99 11.0999 15.73 11.2899 15.54C11.3899 15.45 11.4899 15.38 11.6199 15.33C11.9899 15.17 12.4299 15.26 12.7099 15.54C12.7999 15.64 12.8699 15.74 12.9199 15.87C12.9699 15.99 12.9999 16.12 12.9999 16.25C12.9999 16.38 12.9699 16.51 12.9199 16.63Z" fill="#ffffff"></path> </g></svg>
            @elseif ($single_task->priority == 'not_urgent')
            <svg width="22px" height="22px" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" fill="#000000" transform="rotate(180)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#ffffff" d="M17.707 5.707l-8 8a1 1 0 0 1-1.414 0l-8-8A1 1 0 0 1 1 4h16a1 1 0 0 1 .924.617A.97.97 0 0 1 18 5a1 1 0 0 1-.293.707z"></path> </g></svg>
            @elseif ($single_task->priority == 'normal')
            <svg width="22px" height="22px" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#ffffff" d="M17.707 5.707l-8 8a1 1 0 0 1-1.414 0l-8-8A1 1 0 0 1 1 4h16a1 1 0 0 1 .924.617A.97.97 0 0 1 18 5a1 1 0 0 1-.293.707z"></path> </g></svg>
            @endif
          </div>
          <div class="d-flex align-items-start flex-column justify-content-center">
            <a href="{{Route('task_details' , ['taskSlug' => $single_task->slug])}}">
              <h6 class="mb-0 text-sm">{{$single_task->name}}</h6>
            </a>
            <p class="mb-0 text-xs">{!!Str::limit(strip_tags($single_task->description), 15)!!}</p>
          </div>
          <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="">Remove</a>
        </li>
        @endforeach
        @else
        <div class="rounded flex items-center justify-center h-px-100 bg-light">
          <div class=""">
              <p class="m-0">0 Tasks</p>
          </div>
        </div>
        @endif
    </ul>
</div>