{{-- {{ $colors }} --}}
@extends('layouts.backendapp')
@section('title','Color')
@section('backendContent')

    <div class="page_header mt-3">
        <div class="card_body">
            <h3>Color</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header_card_links d-flex align-items-center">
                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.color.create') }}" class="btn btn-primary">Create</a>
                        </div>

                        <div class="links_item pr-5 ">
                            <a href="{{ route('dashboard.color.archieve') }}" class="btn btn-primary">Refresh</a>
                        </div>

                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.color.index') }}" class="btn btn-primary">View</a>
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

                @forelse ($colors as $color)
                <tr>
                    <td>{{ $color->id }}</td>
                    <td>{{ $color->name }}</td>
                    <td>{{ $color->slug }}</td>
                     
                    <td>
                        @can('edit')
                        <a href="{{ route('dashboard.color.restore', $color->id) }}" class="badge bg-success">Restore</a>
                        @endcan
                       
                        <form action="{{ route('dashboard.color.trash',$color->id) }}" method="POST" style="display:inline-block">
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