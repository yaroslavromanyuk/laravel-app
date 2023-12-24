<html lang="en">
    <body>
        <style>
            .alert-errors {
                color: red;
            }
        </style>
        <h1>Edit User</h1>
        <a href="{{ route('users.show', ['user' => $user->id]) }}">Back</a>
        <br /><br />
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <strong>Name:</strong>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
            <br />
            <strong>Email:</strong>
            <input type="text" name="email" value="{{ $user->email }}" placeholder="Email" />
            <br /><br />
            <strong>Password:</strong>
            <input type="password" name="password" value="" placeholder="Password" />
            <br /><br />
            <button type="submit">Submit</button>
        </form>
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
