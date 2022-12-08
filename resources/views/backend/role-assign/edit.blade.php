{{-- @foreach ($user_roles as $user_role)
     @foreach ($user_role->roles as $role)
         {{ $role->name }}
     @endforeach
@endforeach --}}
@extends('layouts.backendapp')
@section('title','role-assign edit')
@section('backendContent')
<div class="row mt-4">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-body">
                @foreach ($user_roles as $user_role)
                <form action="{{ route('dashboard.roleAssign.update',$user_role->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <div class="form-group">
                        <label for="name">User Name</label>
                        @error('name')
                            {{ $message }}
                        @enderror
                        
                        <input type="text" name="name" value="{{ $user_role->name }}" class="form-control" placeholder="Enter Category name">
                        
                        
                     </div>
                
                     <div class="form-group">
                        <label for="role">User Role</label>
                        <select name="role" class="form-control">
                        @error('role')
                        {{ $message }}
                        @enderror
                        <option disabled>Select</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @foreach ($user_roles as $user_role)
                            @foreach ($user_role->roles as $r)
                                {{ $r->id == $role->id ? 'selected' : '' }}
                            @endforeach
                        @endforeach>{{ $role->name }}</option>
                       

                        @endforeach
                        
                         
                        </select>
                     </div>
                 
                     <div class="form-group">
                         <button type="submit" class="btn btn-primary">Update</button>
                     </div>
                
                
                </form>
                @endforeach
            </div>
        </div>
         
    </div>
</div>

 
@endsection