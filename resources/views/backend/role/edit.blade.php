 

@extends('layouts.backendapp')
@section('title','Role Edit')
@section('backendContent')
    <div class="row">
         
            <div class="col-lg-6 m-auto card-form__body card-body">
                @foreach ($roles as $role)
                <form action="{{ route('dashboard.role.update',$role->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                     
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Role</label>
                        <input type="text" class="form-control" name="role" 
                            placeholder="Enter  role" value="{{ $role['name'] }}">
                    </div>
                   
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
                @endforeach
            </div>
  
    </div>
@endsection