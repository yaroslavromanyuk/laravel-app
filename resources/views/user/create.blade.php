<html lang="en">
    <body>
        <style>
            .alert-errors {
                color: red;
            }
        </style>
        <h1>Create New User</h1>
        <a href="{{ route('users.index') }}">Back</a>
        <br /><br />
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @method('POST')
            <strong>Name:</strong>
            <input type="text" name="name" value="" class="form-control" placeholder="Name">
            <br />
            <strong>Email:</strong>
            <input type="text" name="email" value="" placeholder="Email" />
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
