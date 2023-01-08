@extends('layouts.backendapp')
@section('title','Inventory')
@section('backendContent')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                         <table class="table table-striped mb-0 thead-border-top-0">
                            <thead>
                                <th>Product id</th>
                                <th>Color id</th>
                                <th>Size id</th>

                            </thead>
                            @foreach ($inventory as $each)
                            <tr>
                                <td>{{ $each->id }}</td>
                                <td>02</td>
                                <td>03</td>
                            </tr>
                            @endforeach
                         </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection