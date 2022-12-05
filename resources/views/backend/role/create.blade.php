@extends('layouts.backendapp')
@section('title', 'Role Create')
@section('backendContent')




    <div class="card card-form mt-4">
        
         <div class="row">
            <!-- Create Permission -->
            <div class="col-lg-6 card-form__body card-body">
                <form action="{{ route('dashboard.permission.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Permission</label>
                        <input type="text" class="form-control" name="permission" id="exampleInputEmail1"
                            placeholder="Enter  permission">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

             <!--  Set Permission of Roll -->
            <div class="col-lg-6 card-form__body card-body">
                <form action="{{ route('dashboard.role.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Role</label>
                        <input type="text" class="form-control" name="role" id="exampleInputEmail1"
                            placeholder="Enter  role">
                    </div>

                    <div class="">
                        <label for="exampleInputEmail1">Give the permission</label>
                        <br>
                        @foreach ($permissions as $permission)
                         <div class="checkbox_design my-2">
                            <input type="checkbox" value="{{ $permission->id }}" name="permissions[]" > <span>{{ $permission->name }} </span>
                         </div>
                        @endforeach
                         
                    </div>
 
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
         </div>
             
 
    </div>
@endsection