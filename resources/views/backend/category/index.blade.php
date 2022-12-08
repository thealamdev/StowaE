{{-- {{ $categories }} --}}
@extends('layouts.backendapp')
@section('title','Category')
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
                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary">Create</a>
                        </div>

                        <div class="links_item pr-5 ">
                            <a href="{{ route('dashboard.category.archieve') }}" class="btn btn-primary">Archieve</a>
                        </div>

                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.category.index') }}" class="btn btn-primary">Refresh</a>
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
                    <th>User</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Slug</th>
                    <th>Parent Category</th>
                    <th>Action</th>
                </thead>

                @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->user->name }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <img src="{{ asset('storage/category/'.$category->image) }}" alt="" width="60">
                    </td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>
                        @can('edit')
                        <a href="{{ route('dashboard.category.edit', $category->id) }}" class="badge bg-success">Edit</a>
                        @endcan
                       
                        <form action="{{ route('dashboard.category.delete', $category->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('delete')
                             <button class="badge bg-danger border-0">Delete</button>
                        </form>
                    </td>
                    
                </tr>
                @empty
                <td>
                    <h3>{{ "No data found" }}</h3>
                </td>
                    
                @endforelse
                 
                
            </table>
        </div>
    </div>
@endsection