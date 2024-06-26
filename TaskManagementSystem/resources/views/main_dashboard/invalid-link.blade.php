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
        <div class="min-h-screen flex flex-grow items-center justify-center bg-gray-50">
            <div class="rounded-lg bg-white p-8 text-center shadow-xl">
              <h1 class="mb-4 text-4xl font-bold">404</h1>
              <p class="text-gray-600">Oops! The page you are looking for could not be found.</p>
              <a href="/" class="mt-4 inline-block rounded bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"> Go back to Home </a>
            </div>
        </div>
      </div>
    </div>
    @livewireScripts
</body>
</html>