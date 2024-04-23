<div>
    <nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
        id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <div class="navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    @guest
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ Route('login') }}" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign In</span>
                            </a>
                        </li>
                    @endguest


                    @auth
                        {{-- Notification Section --}}
                        <div class="relative inline-flex">
                            {{-- red notification icon --}}
                            @livewire('notification-bill')
                        </div>
                    </ul>
                </div>
                {{-- User dropdown menu --}}
                <x-user.drop_downmenu>
                </x-user.drop_downmenu>
            @endauth
        </div>
    </nav>

</div>
