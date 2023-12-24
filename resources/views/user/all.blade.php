<html lang="en">
    <head>
        <title>All users</title>
        @vite('dist/output.css')
    </head>
    <body class="p-2">
    <script>
        function removeUser(id) {
            if (window.confirm('Do you really want to delete this user?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
    <h1 class="font-bold">Users:</h1>
       <table class="border-separate border border-slate-400">
           <thead>
           <tr>
               <th class="border border-slate-300 font-bold">Id</th>
               <th class="border border-slate-300 font-bold">Name</th>
               <th class="border border-slate-300 font-bold">Email</th>
               <th class="border border-slate-300 font-bold">Email Verified At</th>
               <th class="border border-slate-300 font-bold">Created At</th>
               <th class="border border-slate-300 font-bold">Updated At</th>
           </tr>
           </thead>
           <tbody>
               @foreach ($users as $user)
                   <tr class="odd:bg-slate-100 even:bg-white">
                       <td class="border border-slate-300">{{ $user->id }}</td>
                       <td class="border border-slate-300">{{ $user->name }}</td>
                       <td class="border border-slate-300">{{ $user->email }}</td>
                       <td class="border border-slate-300">{{ $user->email_verified_at }}</td>
                       <td class="border border-slate-300">{{ $user->created_at }}</td>
                       <td class="border border-slate-300">{{ $user->updated_at }}</td>
                       <td class="border border-slate-300">
                           <button class="bg-cyan-700 hover:bg-cyan-500 p-1 border-r rounded-md w-14">
                                <a href="{{ route('users.show', ['user' => $user->id]) }}">Show</a>
                           </button>
                       </td>
                       <td class="border border-slate-300">
                           <button class="bg-red-600 hover:bg-red-500 p-1 border-r rounded-md w-14">
                                <a href="" onClick="event.preventDefault(); removeUser({{ $user->id }});">Delete</a>
                           </button>
                           <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                 method="POST" style="display: none;">
                               @csrf
                           </form>
                       </td>
                   </tr>
               @endforeach
           </tbody>
       </table>
       {{ $users->onEachSide(3)->links() }}
        <br/>
        <button class="bg-cyan-700 hover:bg-cyan-500 p-2 border-r rounded-lg">
            <a href="{{ route('users.create') }}">Create new User</a>
        </button>
        @if ($errors->any())
            <div class="alert-errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </body>
</html>
