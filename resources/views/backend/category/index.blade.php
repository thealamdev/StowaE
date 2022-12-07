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
                    <th>Image</th>
                    <th>Slug</th>
                    <th>Action</th>
                </thead>

                <tr>
                    <td>01</td>
                    <td>Shah alam</td>
                    <td>img</td>
                    <td>Shah-alam</td>
                    <td>
                        <a href="#" class="badge bg-success">Edit</a>
                        <a href="#" class="badge bg-danger">Delete</a>
                    </td>
                    
                </tr>
                
            </table>
        </div>
    </div>
@endsection