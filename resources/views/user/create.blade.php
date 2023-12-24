<html lang="en">
    <head>
        <title>Create user</title>
        @vite('dist/output.css')
    </head>
    <body class="p-2">
        <div class="max-w-sm mx-auto m-1">
            <h1 class="font-bold">Create New User</h1>
            <button class="bg-cyan-700 hover:bg-cyan-500 p-2 border-r rounded-lg w-20">
                <a href="{{ route('users.index') }}">Back</a>
            </button>
        </div>
        <form class="max-w-sm mx-auto" action="{{ route('users.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                <input type="text" id="name" name="name" value="" placeholder="Name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white>">Email:</label>
                <input type="email" id="email" name="email" value="" placeholder="Email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password:</label>
                <input type="password" id="password" name="password" value="" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <button type="submit" class="text-white bg-cyan-700 hover:bg-cyan-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
        @if ($errors->any())
            <div class="alert-errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-red-600">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </body>
</html>
