
<div>
    <ul class="list-group">
 
      @if (sizeof($this->TeamMembers->members) > 0 )
      @foreach ($this->TeamMembers->members as $member)
      <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
        <div class="avatar me-3">
          <img src="{{$member->profile_photo_url}}" alt="kal" class="border-radius-lg shadow">
        </div>
        <div class="d-flex align-items-start flex-column justify-content-center">
          <h6 class="mb-0 text-sm">{{$member->name}}</h6>
        </div>
        
        @can('canInvite', $this->team_detials)
        <a wire:click="DeleteModal({{$member->id}})" class="btn btn-link pe-3 ps-0 mb-0 ms-auto">Remove</a>    
        @endcan
        
      </li>
      @endforeach
      @else
      <div class="rounded flex items-center justify-center h-px-100 bg-light">
        <div class=""">
            <p class="m-0">0 Members</p>
        </div>
      </div>
      @endif
    </ul>
</div>