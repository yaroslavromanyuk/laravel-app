<html lang="en">
    <body>
    <style>
        table, th, td {
            border: 1px solid #000000;
        }

        .hidden {
            display: none;
        }
    </style>
    <script>
        function removeUser(id) {
            if (window.confirm('Do you really want to delete this user?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
    <h1>Users:</h1>
       <table class="users-table">
           <thead>
           <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Email</th>
               <th>Email Verified At</th>
               <th>Created At</th>
               <th>Updated At</th>
           </tr>
           </thead>
           <tbody>
               @foreach ($users as $user)
                   <tr>
                       <td>{{ $user->id }}</td>
                       <td>{{ $user->name }}</td>
                       <td>{{ $user->email }}</td>
                       <td>{{ $user->email_verified_at }}</td>
                       <td>{{ $user->created_at }}</td>
                       <td>{{ $user->updated_at }}</td>
                       <td><a href="{{ route('users.show', ['user' => $user->id]) }}">Show</a></td>
                       <td>
                           <a href="" onClick="event.preventDefault(); removeUser({{ $user->id }});">Delete</a>
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
        <a href="{{ route('users.create') }}">Create new User</a>
    </body>
</html>
