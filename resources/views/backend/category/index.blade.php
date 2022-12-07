
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
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Slug</th>
                    <th>Parent Category</th>
                    <th>Action</th>
                </thead>

                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>
                        <a href="#" class="badge bg-success">Edit</a>
                        <a href="#" class="badge bg-danger">Delete</a>
                    </td>
                    
                </tr>
                @endforeach
                
            </table>
        </div>
    </div>
@endsection