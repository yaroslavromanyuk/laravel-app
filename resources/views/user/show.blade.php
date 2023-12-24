<html lang="en">
    <head>
        <title>User info</title>
        @vite('dist/output.css')
    </head>
    <body class="p-2">
        <h1 class="font-bold">Users Info:</h1>
        <button class="bg-cyan-700 hover:bg-cyan-500 p-2 border-r rounded-lg w-20 m-1">
            <a href="{{ route('users.index') }}">Back</a>
        </button>
        <table class="border-separate border border-slate-400">
           <thead>
           <tr>
               <th class="border border-slate-300 font-bold">Id</th>
               <th class="border border-slate-300 font-bold">Name</th>
               <th class="border border-slate-300 font-bold">Email</th>
               <th class="border border-slate-300 font-bold">Created At</th>
               <th class="border border-slate-300 font-bold">Updated At</th>
           </tr>
           </thead>
           <tbody>
               <tr>
                   <td class="border border-slate-300">{{ $user->id }}</td>
                   <td class="border border-slate-300">{{ $user->name }}</td>
                   <td class="border border-slate-300">{{ $user->email }}</td>
                   <td class="border border-slate-300">{{ $user->created_at }}</td>
                   <td class="border border-slate-300">{{ $user->updated_at }}</td>
               </tr>
           </tbody>
        </table>
        <button class="bg-cyan-700 hover:bg-cyan-500 p-2 border-r rounded-lg w-20 m-1">
            <a href="{{ route('users.edit', ['user' => $user->id]) }}">Edit</a>
        </button>
    </body>
</html>
