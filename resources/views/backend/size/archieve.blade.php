{{-- {{ $sizes }} --}}
@extends('layouts.backendapp')
@section('title','Size')
@section('backendContent')

    <div class="page_header mt-3">
        <div class="card_body">
            <h3>Size</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header_card_links d-flex align-items-center">
                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.size.create') }}" class="btn btn-primary">Create</a>
                        </div>

                        <div class="links_item pr-5 ">
                            <a href="{{ route('dashboard.size.archieve') }}" class="btn btn-primary">Refresh</a>
                        </div>

                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.size.index') }}" class="btn btn-primary">View</a>
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
               
                    <th>Slug</th>
                    
                    <th>Action</th>
                </thead>

                @forelse ($sizes as $size)
                <tr>
                    <td>{{ $size->id }}</td>
                    <td>{{ $size->name }}</td>
                    <td>{{ $size->slug }}</td>
                     
                    <td>
                        @can('edit')
                        <a href="{{ route('dashboard.size.restore', $size->id) }}" class="badge bg-success">Restore</a>
                        @endcan
                       
                        <form action="{{ route('dashboard.size.trash',$size->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="badge bg-danger delete_btn" type="button" style="border:none">Emt byn</button>
                        </form>
                         
                    </td>
                    
                </tr>
                @empty
               
                    <td colspan="8" width="200" style="text-align:center;vertical-align:middle">
                        <div class="empty_img m-auto">
                            <img src="{{ asset('assets/backend/images/logos/empty.png') }}" alt="" class="w-50" >
                        </div>
                    </td>
                    
                @endforelse
                 
                
            </table>
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
                confirmButtonSize: '#3085d6',
                cancelButtonSize: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                     $(this).parent('form').submit();
                }
                })
        })
    </script>
@endsection