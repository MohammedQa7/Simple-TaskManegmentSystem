<x-app-layout>
    <div class="create-header">
        <h4 class="ms-4">Create Task</h4>
    </div>

    <div class="task-form w-100">
        <form action="{{ Route('task_store' , [$team_slug->slug ?? null ]) }}" method="POST" class="w-full p-3 pe-5">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-3">
                <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Task name
                    </label>

                    <input class="form-control block mt-1 w-full" id="grid-first-name" type="text"
                        placeholder="Finishing Figma File" name="taskname">
                    @error('taskname')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-last-name">
                        Priority
                    </label>
                    <select id="priority" class="form-control block mt-1 w-full" id="grid-last-name" type="text"
                        placeholder="Doe" name="priority">
                        <option selected>Choose Status</option>
                        <option value="urgent">Urgent</option>
                        <option value="not_urgent">Not Urgent</option>
                        <option value="normal">Normal</option>
                    </select>

                    @error('priority')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full md:w-2/2 px-3 mb-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Task Description
                    </label>

                    <textarea class="h-50" name="description" id="desc_textarea" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-3">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="kt_docs_select2_users">
                        Assign To User
                    </label>
                    <select class="form-select form-select-transparent assign_user" data-placeholder="..."
                        id="kt_docs_select2_users" name="assignedUser">
                        <option></option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                data-kt-rich-content-icon="{{ $user->profile_photo_url }}"
                                data-kt-rich-content-subcontent="{{ $user->email }}"></option>
                        @endforeach
                    </select>

                    @error('assignedUser')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-outline-primary ms-3 ">
                Create Task
            </button>
        </form>
    </div>
    @section('cdEditor')
        <script>
            ClassicEditor
                .create(document.querySelector('#desc_textarea'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Paragraph',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading1',
                                view: 'h1',
                                title: 'Heading 1',
                                class: 'ck-heading_heading1'
                            },
                            {
                                model: 'heading2',
                                view: 'h2',
                                title: 'Heading 2',
                                class: 'ck-heading_heading2'
                            }
                        ]
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endsection
    @include('includes.user-select-2-script')
</x-app-layout>
