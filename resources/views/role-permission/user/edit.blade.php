@extends('adminlayout.adminmaster')
@section('content')
<div class="main">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="class-header">
                        <h4>
                             Edit  Users 
                            <a href="{{ url('users')}}" class="btn btn-primary float-end ">back </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <form action="{{url('users/'.$user->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="">name </label>
                                <input type="text" name="name"  value="{{$user->name}}" class="form-control">
                                @error ('name')<span class="text-danger"> {{$message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Emaill </label>
                                <input type="text" name="email" readonly value="{{$user->email}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Password </label>
                                <input type="text" name="password" class="form-control">
                                @error ('password')<span class="text-danger"> {{$message}}</span> @enderror
                            </div>
                            <div clasws="mb-3">
                                <label for="">Roles</label>
                                <Select  name="roles[]" class="form-control" multiple >
                                    <option value="">Select role </option>
                                           @foreach ($roles as $role )
                                           <option value="{{$role}}"  {{ in_array($role, $userRoles) ? 'selected': '' }}>{{$role}}</option>    
                                           @endforeach                             
                                  </Select>
                                  @error ('roles')<span class="text-danger"> {{$message}}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit">Update  </button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
</div>
@endsection