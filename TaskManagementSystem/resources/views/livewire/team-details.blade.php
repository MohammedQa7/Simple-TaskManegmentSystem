<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('{{ asset('assets/img/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body  shadow-blur mx-4 mt-n6 mt-5">
            <div class="row flex items-cetner justify-between">
                <div class="col-lg-6 col-5 my-auto">
                    <div class="h-100">
                        <h5 class="m-0">{{ $this->team_detials->name }}</h5>
                    </div>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                    <div class="dropdown float-end ps-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 me-n4" aria-labelledby="dropdownTable">
                            <li>
                                <a class="dropdown-item border-radius-md btn btn-link text-danger px-3 mb-0"
                                    wire:click="DeleteModal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <x-alert-modals.delete_modal name="delete">
        </x-alert-modals.delete_modal>

        <div class="row ">
            <div class="col-12 col-xl-6">
                @if (session()->has('error'))
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Hold on!</span> {{ session()->get('error') }}
                        </div>
                    </div>
                @endif
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Team Members</h6>
                            </div>
                            @can('canInvite', $this->team_detials)
                                <div class="col-md-4 d-flex align-items-center justify-content-end">
                                    <a wire:click="GenerateInvite" class="cursor-pointer ">
                                        <p class="text-uppercase  text-xs font-weight-bolder text-purple-500 m-0">invite
                                            member</p>
                                    </a>
                                </div>
                            @endcan
                        </div>

                        <x-invited_modal name="invite">
                        </x-invited_modal>
                    </div>
                    <div class="card-body p-3">
                        <x-teams.team_members_info>
                        </x-teams.team_members_info>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Team Tasks</h6>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="{{ Route('create_task', [$this->team_detials->slug]) }}">
                                    <p class="text-uppercase  text-xs font-weight-bolder text-purple-500 m-0">create new
                                        task</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <x-teams.team_task_info>
                        </x-teams.team_task_info>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
