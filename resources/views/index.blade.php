<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .err {
            color: red;
            margin-top: 5px;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (session('success'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                        <div class="alert alert-success my-2 p-2">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if (session('delete'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                        <div class="alert alert-danger my-2 p-2">
                            {{ session('delete') }}
                        </div>
                    </div>
                @endif

                @if (!isset($update_admin))
                    <form action="{{ url('form') }}" method="post">
                    @else
                        <form action="{{ url('update_form') }}" method="post">
                @endif

                @csrf
                <h1 class="my-3">Admin Data</h1>
                <div class="form-group mt-3">
                    <label for="name">Name: </label>
                    <input type="hidden" name="id" class="form-control"
                        value="@if (isset($update_admin)) {{ $update_admin->id }} @endif">
                    <input type="text" name="name" class="form-control" placeholder="Enter Name"
                        value="@if (isset($update_admin)) {{ $update_admin->name }} @endif">
                </div>
                @if (!isset($update_admin))
                    @error('name')
                        <div class="err"> {{ $message }}</div>
                    @enderror
                    <div class="form-group mt-3">
                        <label for="email">Email: </label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    @error('email')
                        <div class="err"> {{ $message }}</div>
                    @enderror
                    <div class="form-group mt-3">
                        <label for="password">Password: </label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                    @error('password')
                        <div class="err"> {{ $message }}</div>
                    @enderror
                    <div class="form-group mt-3">
                        <label for="confirm_password">Confirm password: </label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Enter Confirm-Password">
                    </div>
                @endif
                @if (!isset($update_admin))
                    <button class="btn btn-primary mt-2" type="submit" name="submit">
                        Submit
                    </button>
                @else
                    <button class="btn btn-primary mt-2" type="submit" name="submit">
                        Update
                    </button>
                @endif
                </form>
                <br>
                @if (isset($admins))
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->password }}</td>
                                    <td><a href="{{ url('update_admin') }}/{{ $admin->id }}"><i
                                                class="fa fa-edit text-primary"></i></a></td>
                                    <td><a href="{{ url('delete_admin') }}/{{ $admin->id }}"><i
                                                class="fa fa-trash text-danger"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
</body>

</html>
