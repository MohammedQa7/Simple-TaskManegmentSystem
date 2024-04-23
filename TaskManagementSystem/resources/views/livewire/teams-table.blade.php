<div>
    @can('create', App\Models\Team::class)
        <div class="task-btn d-flex flex-row-reverse w-100">
            <form class="w-100" action="{{ Route('create_teams') }}" method="get">
                <button type="submit" class="btn btn-outline-primary   w-100">
                    Create new team
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
                        <h6>Teams</h6>
                    </div>
                    <div class="card-header pb-1 input-group w-20">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input wire:model.live.debounce.500ms="search_query" type="text" class="form-control"
                            placeholder="Type here...">
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">team
                                        name</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        total members</th>
                                </tr>
                            </thead>
                            <tbody>
                                <x-teams.teams-data>
                                </x-teams.teams-data>
                            </tbody>

                            {{$this->teams->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
