<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<h1>Users</h1>

<form id="createUserForm" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="city" placeholder="City" required>
    <input type="file" name="image" accept="image/jpeg, image/png" required>
    <button type="submit"> Create User </button>
</form>

<table id="usersTable" class="border 1">
    <thead>
    <tr>
        <th>Name</th>
        <th>City</th>
        <th>Images Count</th>
    </tr>
    </thead>
    <tbody>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">City</th>
            <th scope="col">Images_count</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row"> {{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex p-4">
        <nav class="col-md-auto mx-auto">
            {{ $users->withQueryString()->onEachSide(1)->links() }}
        </nav>
    </div>

    </tbody>
</table>

<script>
    $(document).ready(function() {
        loadUsers();

        $('#createUserForm').submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    loadUsers();
                    $('#createUserForm')[0].reset();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

    function loadUsers() {
        $.ajax({
            url: "{{ route('users.index') }}",
            type: "GET",
            dataType: 'json',
            success: function(response) {
                var tableBody = $('#usersTable tbody');
                tableBody.empty();

                response.forEach(function(user) {
                    var row = '<tr>' +
                        '<td>' + user.name + '</td>' +
                        '<td>' + user.city + '</td>' +
                        '<td>' + user.images_count + '</td>' +
                        '</tr>';

                    tableBody.append(row);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
