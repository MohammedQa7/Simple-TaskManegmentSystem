<x-app-layout>
    
    <div class="create-header">
        <h4 class="ms-4">Create Team</h4>
    </div>

    <div class="task-form w-100">
        <form action="{{ Route('team_store') }}" method="POST" class="w-full p-3 pe-5">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-3">
                <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                    Team name 
                    </label>

                    <input class="form-control block mt-1 w-full" id="grid-first-name" type="text"
                        placeholder="Finishing Figma File" name="name">
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-outline-primary ms-3 ">
                Create team
            </button>
        </form>
    </div>

</x-app-layout>
