<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

</head>
<body>
    <div class="" style="height: 100vh;">
      <div class="text-center flex justify-center items-center flex-col"style="height: 100%;">
        <h1 class="mb-4 text-6xl font-semibold text-red-500">404</h1>
        <p class="mb-4 text-lg text-gray-600">Oops! Looks like you're lost.</p>
        <div class="animate-bounce">
          <svg class="mx-auto h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
          </svg>
        </div>
        <p class="mt-4 text-gray-600">Let's get you back <a href="{{Route('home')}}" class="text-blue-500">home</a>.</p>
      </div>
    </div>
    </div>

    @livewireScripts
</body>
</html>