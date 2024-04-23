@props(['name'])
<div 
x-data="{ visable: false  , name: '{{$name}}'}"     
x-show="visable" 
x-on:open-modal.window = "visable = ($event.detail.name === name)"
x-on:close-modal.window = "visable = false" 
x-on:keydown.escape.window = "visable = false" 
style="display: none">
<ul wire:loading.remove class="notificaiton-dropdown dropdown-menu-end  px-3 py-3 me-sm-n4"  style="{{sizeof(Auth::user()->notifications) <= 0 ? 'width:220px;' : ' '}}">
        @if(sizeof(Auth::user()->notifications) > 0)
            @foreach (Auth::user()->notifications->take(5) as $notify)
            <li class="notification-holder px-2">
            <a class="dropdown-item border-radius-md" href="javascript:;">
                <div class="d-flex py-2">
                    <div class="avatar avatar-sm bg-gradient-light  me-3  my-auto">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM12 17.75C12.4142 17.75 12.75 17.4142 12.75 17V11C12.75 10.5858 12.4142 10.25 12 10.25C11.5858 10.25 11.25 10.5858 11.25 11V17C11.25 17.4142 11.5858 17.75 12 17.75ZM12 7C12.5523 7 13 7.44772 13 8C13 8.55228 12.5523 9 12 9C11.4477 9 11 8.55228 11 8C11 7.44772 11.4477 7 12 7Z"
                                    fill="#2766c2"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                            {{$notify->data['note']}}
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                            <i class="fa fa-clock me-1"></i>
                            {{$notify->created_at->diffForHumans()}}
                        </p>
                    </div>
                </div>
            </a>
            </li>
            @endforeach
            @else
           <ul>
            <li class="notification-holder px-2" >
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                        <h6>No Notifications</h6>
                    </h6>
                </div>
                </li>
           </ul>
           
        @endif
           
      
        <div x-on:click="visable = false" class="bottom-tap w-100 text-center">
            <span class="tap-to-close text-center"></span>
        </div>
</ul>
 
    
</div>
