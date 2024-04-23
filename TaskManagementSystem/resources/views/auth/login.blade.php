<x-guest-layout>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif
        <main class="main-content  mt-0">
            
            <section>
              <div class="page-header min-vh-75">
                <div class="container">
                  <div class="row">
                    
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                      <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-left bg-transparent">
                          <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                          <p class="mb-0 text-gray-800">Enter your email and password to sign in</p>
                        </div>
                        <div class="card-body">
                            <x-validation-errors class="mb-4" />
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <x-label for="email" value="{{ __('Email') }}" />
                            <div class="mb-3">
                              <input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email">
                            </div>
                            <x-label for="password" value="{{ __('Password') }}" />
                            <div class="mb-3">
                              <input id="password" class="form-control block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                            </div>

                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                              <lable class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</lable>
                            </div>
                            
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-100 dark:hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            <x-button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                                {{ __('Log in') }}
                            </x-button>
                          </form>
                          
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                          <p class="mb-4 text-sm mx-auto text-gray-500">
                            Don't have an account?
                            <a href="{{Route('register')}}" class="text-info text-gradient font-weight-bold">Sign up</a>
                          </p>
                        </div>
                      </div>
                 
            
                    </div>
                    <div class="col-md-6">
                      <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('{{asset('assets/img/curved-images/curved6.jpg')}}')"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </main>
</x-guest-layout>
