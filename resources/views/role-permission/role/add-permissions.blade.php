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
            @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <div class="card">
                    <div class="class-header">
                        <h4>
                              Role : {{$role->name}}
                            <a href="{{ url('roles')}}" class="btn btn-primary float-end ">back </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <form action="{{url('roles/'.$role->id.'/give-permissions')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">

                            @error('permission')
                                 <span class="text-danger">{{$message}}</span>
                            @enderror
                                <label for="">Permissions</label>
                                <div class="row">
                                    @foreach($permissions as $permission )
                                    <div class="col-md-3">
                                    <label>
                                            <input 
                                                type="checkbox" 
                                                name="permission[]" 
                                                value="{{$permission->name}}"
                                                {{ in_array($permission->id,$rolePermissions) ? 'checked':'' }}
                                                />
                                                {{$permission->name}}
                                    </label>
                                    </div>
                                    @endforeach
                                </div>
                                
                            </div>
                            <div class="mb-3">
                                <button type="submit">update </button>
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