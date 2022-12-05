{{-- {{ $roles }} --}}
{{-- @foreach ($roles as $pp)
    @foreach ($pp->permissions as $xx)
        {{ $xx }}
    @endforeach
@endforeach --}}

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
                        <label for="role">Enter Role</label>
                        <input type="text" class="form-control" name="role" 
                            placeholder="Enter  role" value="{{ $role->name }}">
                    </div>

                    <div class="form-group">
                        <label for="permissions">Give the permission</label>
                        <br>
                       
                        @foreach ($role->permissions as $roleP)
                            
                       
                        @foreach ($permissions as $permission)
                        @if($roleP->id == $permission->id)
                         <div class="checkbox_design my-2">
                            <input type="checkbox" value="{{ $permission->id }}" name="permissions[]" {{ $roleP->id == $permission->id ? 'checked' :'' }} > <span>{{ $permission->name }} </span>
                         </div>
                         @endif
                        @endforeach
                        @endforeach
                         
                    </div>
                   
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
                @endforeach
            </div>

 
  
    </div>
@endsection