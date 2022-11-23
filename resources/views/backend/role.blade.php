@extends('layouts.backendapp')
@section('title', 'Role')
@section('backendContent')




    <div class="card card-form mt-4">
        <div class="row no-gutters">
            <div class="col-lg-8 card-body">
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
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody class="list" id="staff">
                                        @foreach ($roles as $role)
                                            
                                        
                                        <tr class="selected">

                                            <td>
                                                <p>{{ $role->id }}</p>
                                            </td>

                                            <td>

                                                <p>{{ $role->name }}</p>

                                            </td>
                                            <td>
                                                <a href="#">Edit</a>
                                                <a href="#">Delete</a>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 card-form__body card-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Role</label>
                        <input type="text" class="form-control" name="role" id="exampleInputEmail1"
                            placeholder="Enter  role">
                    </div>
                     
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
