<html lang="en">
    <body>
    <style>
        table, th, td {
            border: 1px solid #000000;
        }
    </style>
    <h1>Users Info:</h1>
    <a href="{{ route('users.index') }}">Back</a>
    <table class="users-table">
       <thead>
       <tr>
           <th>Id</th>
           <th>Name</th>
           <th>Email</th>
           <th>Created At</th>
           <th>Updated At</th>
       </tr>
       </thead>
       <tbody>
           <tr>
               <td>{{ $user->id }}</td>
               <td>{{ $user->name }}</td>
               <td>{{ $user->email }}</td>
               <td>{{ $user->created_at }}</td>
               <td>{{ $user->updated_at }}</td>
           </tr>
       </tbody>
    </table>
    <a href="{{ route('users.edit', ['user' => $user->id]) }}">Edit</a>
    </body>
</html>
