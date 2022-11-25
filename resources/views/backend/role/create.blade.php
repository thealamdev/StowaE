@extends('layouts.backendapp')
@section('title', 'Role Create')
@section('backendContent')




    <div class="card card-form mt-4">
        
         <div class="row">
            <!-- Create Permission -->
            <div class="col-lg-6 card-form__body card-body">
                <form action="{{ route('dashboard.role.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Permission</label>
                        <input type="text" class="form-control" name="permission" id="exampleInputEmail1"
                            placeholder="Enter  permission">
                    </div>
                     
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

             <!-- Set Permission and Create Roll -->
            <div class="col-lg-6 card-form__body card-body">
                <form action="{{ route('dashboard.role.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Role</label>
                        <input type="text" class="form-control" name="role" id="exampleInputEmail1"
                            placeholder="Enter  role">
                    </div>
                     
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
         </div>
             
 
    </div>
@endsection