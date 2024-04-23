<div>
    @if (sizeof($this->tasks) > 0)
        @foreach ($this->tasks as $task)
            <tr wire:key="{{ $task->id }}">
                <td>
                    <div class="d-flex px-3 py-1">
                        @if ($this->edtiableFieldIndex == $task->id && isset($this->edtiableFieldIndex))
                            @if (Auth::user()->IsManeger() || Auth::user()->IsOwner())
                                <div>
                                    <input wire:model.defer="task_name" id="task-name"
                                        class="form-control block mt-1 w-full" type="text" name="taskname"
                                        value="{{ $task->name }}">
                                    @error('task_name')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            @else
                                <h6 class="mb-0 text-sm ">{{ $task->name }}</h6>
                            @endif
                        @else
                            <a href="{{ Route('task_details', ['taskSlug' => "$task->slug"]) }}">
                                <h6 class="mb-0 text-sm ">{{ $task->name }}</h6>
                            </a>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="avatar-group mt-2">
                        <a class="avatar avatar-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="{{ $task->assigneduser->name }}">
                            <img src="{{ $task->assigneduser->profile_photo_url }}" alt="team1">
                        </a>
                    </div>
                </td>
                <td class="align-middle text-center text-sm">
                    @if ($this->edtiableFieldIndex == $task->id && isset($this->edtiableFieldIndex))
                        @if (Auth::user()->IsManeger() || Auth::user()->IsOwner())
                            <div>
                                <select wire:model="task_priority" id="priority" class="form-control block mt-1 w-full"
                                    id="grid-last-name" type="text" placeholder="Doe" name="priority">
                                    <option {{ $task->priority == 'urgent' ? 'selected' : '' }} value="urgent">Urgent
                                    </option>
                                    <option {{ $task->priority == 'not_urgent' ? 'selected' : '' }} value="not_urgent">
                                        Not Urgent</option>
                                    <option {{ $task->priority == 'normal' ? 'selected' : '' }} value="normal">Normal
                                    </option>
                                </select>

                                @error('task_priority')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        @else
                            <span
                                class="badge badge-sm bg-gradient-{{ $task->priority == 'urgent' ? 'danger' : ($task->priority == 'not_urgent' ? 'warning' : 'info') }}">{{ str_replace('_', ' ', $task->priority) }}</span>
                        @endif
                    @else
                        <span
                            class="badge badge-sm bg-gradient-{{ $task->priority == 'urgent' ? 'danger' : ($task->priority == 'not_urgent' ? 'warning' : 'info') }}">{{ str_replace('_', ' ', $task->priority) }}</span>
                    @endif
                </td>

                <td class="align-middle text-center text-sm">
                    @if ($this->edtiableFieldIndex == $task->id && isset($this->edtiableFieldIndex))
                        <select wire:model="task_status" id="status" class="form-control block mt-1 w-full"
                            id="grid-last-name" type="text" placeholder="Doe" name="status">
                            <option {{ $task->status == 'completed' ? 'selected' : '' }} value="completed">Completed
                            </option>
                            <option {{ $task->status == 'not_completed' ? 'selected' : '' }} value="not_completed">Not
                                Completed</option>
                            <option {{ $task->status == 'cancled' ? 'selected' : '' }} value="cancled">Cancled</option>
                        </select>
                    @else
                        <span
                            class="badge badge-sm bg-gradient-{{ $task->status == 'completed' ? 'success' : ($task->status == 'not_completed' ? 'secondary' : ($task->status == 'cancled' ? 'danger' : '')) }}">{{ str_replace('_', ' ', $task->status) }}</span>
                    @endif
                </td>

                <td class="align-middle text-center text-sm">
                    <span
                        class="badge badge-sm bg-gradient-dark">{{ Auth::user()->id == $task->user_id ? ' You' : $task->user->email }}</span>
                </td>

                <td class="align-middle text-center">
                    <span
                        class="text-secondary text-xs font-weight-bold">{{ $task->created_at->diffForHumans() }}</span>
                </td>
                <td class="align-middle">
                    @if ($this->edtiableFieldIndex == $task->id && isset($this->edtiableFieldIndex))
                        <button wire:click="SaveEditedTask" type="submit" class="btn btn-outline-dark m-0 me-3">
                            Save
                        </button>
                        <button wire:click.prevent="NotEditable" class="btn btn-outline-danger m-0">
                            Cancle
                        </button>
                    @else
                        <button wire:click.prevent="IsEditable({{ $task->id }})"
                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                            data-original-title="Edit user">
                            Edit
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    @else
    <td colspan="7">
      <div class="rounded flex items-center justify-center h-px-100 bg-light">
        <div class=""">
            <p class="m-0">No Tasks Yet</p>
          </div>
      </div>
    </td>
    @endif
    @include('includes.user-select-2-script')
</div>
