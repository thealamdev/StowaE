@extends('layouts.backendapp')
@section('title','Category')
@section('backendContent')

    <div class="page_header mt-3">
        <div class="card_body">
            <h3>Category</h3>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <table class="table mb-0 thead-border-top-0">
                <th>
                    Id
                </th>
                <th>Name</th>
                <th>Image</th>
                <th>Slug</th>
                <th>Action</th>
            </table>
        </div>
    </div>
@endsection