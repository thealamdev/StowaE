
{{-- {{ $roles }} --}}
@extends('layouts.backendapp')
@section('title', 'Role')
@section('backendContent')

<div class="col-lg-12 card-body">
    <div class="card card-form">
        <div class="row no-gutters">

            <div class="col-lg-12 px-4 card-form__body">

                <div class="table-responsive border-bottom" data-toggle="lists"
                    data-lists-values="['js-lists-values-employee-name']">

                    <table class="table mb-0 thead-border-top-0">
                        <thead>
                            <tr>


                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                @can('edit')
                                <th>Action</th>
                                @endcan
                                

                            </tr>
                        </thead>
                        <tbody class="list" id="staff">
                            @foreach ($roles as $role)
                                
                            
                            <tr class="selected">

                                <td>
                                    <p class="badge bg-success">{{ $role->id }}</p>
                                </td>

                                <td>

                                    <p class="badge bg-info">{{ $role->name }}</p>

                                </td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                    <p class="badge bg-primary">
                                        {{ $permission->name}}
                                    </p>
                                    @endforeach
                                </td>

                                @can('edit')
                                <td class="d-flex justify-content-center align-item-center">
                                    @can('edit')
                                    <a href="{{ route('dashboard.role.edit', $role->id) }}">
                                        <p class="badge bg-primary mr-3" style="color:#222">Edit</p>
                                        </a> 
                                    @endcan
                                    
                                    @can('delete')
                                    <form action="{{ route('dashboard.role.delete',$role->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                          <button type="button" style="border:none!important;" class="badge bg-danger delete_btn">Delete</button>
                                    </form>
                                    @endcan
                                   
                                   
                                     
                                </td>
                                @endcan
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('sweet-js')
    <script>
        $('.delete_btn').on('click',function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                     $(this).parent('form').submit();
                }
                })
        })
    </script>
@endsection