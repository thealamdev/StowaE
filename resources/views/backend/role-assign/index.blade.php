{{-- {{ $role }} --}}
@extends('layouts.backendapp')
@section('title','role-assign')
@section('backendContent')

    <div class="page_header mt-3">
        <div class="card_body">
            <h3>Category</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header_card_links d-flex align-items-center">

                        {{-- <div class="links_item pr-5 ">
                            <a href="{{ route('dashboard.category.archieve') }}" class="btn btn-primary">Archieve</a>
                        </div> --}}

                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.roleAssign.index') }}" class="btn btn-primary">Refresh</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table mb-0 thead-border-top-0">
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Roles</th>
                    <th>Action</th>
                </thead>

               
                    
                @foreach ($user_roles as $key => $user_role)
                    
                 
                @forelse ($user_roles[$key]['roles'] as $role)
                <tr>
                    
                    <td>{{ $user_role->id }}</td>
                    <td>{{ $user_role->name }}</td>
                     
                    <td>{{ $role->name }}</td>
                     
                    <td>
                        @can('edit')
                        <a href="{{ route('dashboard.roleAssign.edit', $user_role->id) }}" class="badge bg-success">Edit</a>
                        @endcan
                       
                        {{-- <form action="{{ route('dashboard.roleAssign.delete',$user_role->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('delete')
                             <button class="badge bg-danger border-0 delete_btn" type="submit">Delete</button>
                        </form> --}}
                        <button class="badge bg-danger border-0 delete_btn" type="submit" value="{{ route('dashboard.roleAssign.delete',$user_role->id) }}">Delete</button>
                    </td>
                    
                </tr>
                @empty
                    <td colspan="8" width="200" style="text-align:center;vertical-align:middle">
                        <div class="empty_img m-auto">
                            <img src="{{ asset('assets/backend/images/logos/empty.png') }}" alt="" class="w-50" >
                        </div>
                    </td>
                @endforelse
                 
                @endforeach
                
                
            </table>
        </div>
    </div>

    @section('sweet-js')
    <script>
        $(function($){
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
             
                window.location.href = $(this).val();
            
        }
        })
            })
        })
         
    </script>
    @endsection

@endsection


 

 
 