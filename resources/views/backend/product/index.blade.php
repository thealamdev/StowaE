{{-- {{ $product->categories->name }} --}}
@extends('layouts.backendapp')
@section('title','Product')
@section('backendContent')

    <div class="page_header mt-3">
        <div class="card_body">
            <h3>Product</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header_card_links d-flex align-items-center">
                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.product.create') }}" class="btn btn-primary">Create</a>
                        </div>

                        <div class="links_item pr-5 ">
                            <a href="{{ route('dashboard.product.archieve') }}" class="btn btn-primary">Archieve</a>
                        </div>

                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.product.index') }}" class="btn btn-primary">Refresh</a>
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
                    <th>Image</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Categories</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Discount</th>
                    <th>Action</th>
                </thead>

                @forelse ($products as $product)
                <tr>
                    <td>
                        <img src="{{ asset('storage/products/'.$product->image) }}" alt="" width="60" style="border-radius: 10px">
                    </td>
                    <td>{{ $product->user->name }}</td>
                    <td>{{ Str::limit($product->title, 15, '...') }}</td>
                    <td>
                    @foreach ($product->categories as $category)
                    <a class="badge badge-info">
                        {{ $category->name ?? "" }}
                    </a>
                       
                    @endforeach
                    </td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->sale_price }}</td>
                    <td>{{ $product->discount }}</td>
                     
                    {{-- <td>
                        <img src="{{ asset('storage/product/'.$product->image) }}" alt="" width="60"> 
                    </td> --}}
                    {{-- <td>{{  $product->created_at->format('d-M-y') }}</td> --}}
                    {{-- <td>{{ $product->created_at->diffForHumans() }}</td> --}}
                    {{-- <td>{{ $product->parent_id }}</td> --}}
                    <td>
                        <a href="#" class="badge bg-warning">Inventory</a>
                        @can('edit')
                        <a href="{{ route('dashboard.product.edit', $product->id) }}" class="badge bg-success">Edit</a>
                        @endcan

                        @can('edit')
                        <form action="{{ route('dashboard.product.delete', $product->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('delete')
                             <button class="badge bg-danger border-0 delete_btn" type="button">Delete</button>
                        </form>
                        @endcan
                        
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
            {{-- {{ $products->links() }} --}}
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


 