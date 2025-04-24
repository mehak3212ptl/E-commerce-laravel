<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @include('role-permission.nav-links')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <div class="card">
                    <div class="class-header">
                        <h4>
                           Roles
                            <a href="{{ url('roles/create')}}" class="btn btn-primary float-end ">Add Role </a>
                        </h4>
                    </div>

                    <div class="card-body">
                    <table class="table table-hover align-middle mb-0 table-striped display nowrap" >
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody  class="bg-white">
            @foreach($roles as $role)       
            <tr>
               <td>{{$role->id}}</td> 
               <td>{{$role->name}}</td>
               <td>
               <a href="{{url ('roles/'.$role->id.'/give-permissions') }}" class="btn btn-success">Add /Edit Roles permission</a>
                <a href="{{url ('roles/'.$role->id.'/edit') }}" class="btn btn-success">Edit</a>
                <a class="btn btn-danger" href="{{url ('roles/'.$role->id.'/delete') }}">Delete</a>
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>