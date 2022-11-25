@extends('layouts.backendapp')
@section('title', 'Role')
@section('backendContent')

<div class="col-lg-12 card-body">
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
                                <th>Permissions</th>
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
                                <td>Writter</td>
                                <td>
                                    
                                    <a href="{{ route('dashboard.role.edit', $role->id) }}">Edit</a>
                                    <form action="{{ route('dashboard.role.delete',$role->id) }}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                          <button type="submit">Delete</button>
                                    </form>
                                   
                                     
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
@endsection