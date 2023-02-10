{{-- {{ $categories }} --}}
@extends('layouts.backendapp')
@section('title', 'Shipping')
@section('backendContent')

    <div class="page_header mt-3">
        <div class="card_body">
            <h3>Shipping</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header_card_links d-flex align-items-center">
                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.shipping.create') }}" class="btn btn-primary">Create</a>
                        </div>

                        <div class="links_item pr-5 ">
                            <a href="{{ route('dashboard.shipping.archieve') }}" class="btn btn-primary">Archieve</a>
                        </div>

                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.shipping.index') }}" class="btn btn-primary">Refresh</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0 thead-border-top-0">
                        <thead>
                            <th>Id</th>
                            <th>Locatin</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach ($shippings as $shipping)
                                <tr>
                                    <td>{{ $shipping->id }}</td>
                                    <td>{{ $shipping->location }}</td>
                                    <td>{{ $shipping->amount }}</td>
                                     
                                    <td>
                                        <a href="#" class="btn btn-primary">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>




                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.shipping.store') }}" method="POST">
                        @csrf
                        <div class="form-group1">
                            <label for="location">Shipping Location</label>
                            <input type="text" name="location"
                                class="form-control formInput @error('location')
                               is-invalid
                           @enderror"
                                placeholder="Enter Shipping name">
                            @error('location')
                                <div class="text-danger pt-1">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="amount">Shipping Amount</label>
                            <input type="number" name="amount"
                                class="form-control formInput @error('amount')
                               is-invalid
                           @enderror"
                                placeholder="Enter Shipping Amount">
                            @error('amount')
                                <div class="text-danger pt-1">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                         
                        <div class="form-group">
                            <button type="button" class="btn btn-primary formInput submit">Submit</button>
                        </div>


                    </form>
                </div>

                 
            </div>
        </div>
    </div>


@endsection

@section('sweet-js')
    <script>
         
            var inputs = document.querySelectorAll('.formInput')
            var submit  = document.querySelector('.submit')

            inputs.forEach((element,index) => {
                element.addEventListener('keyup',function(){
                    if(event.key === "Enter"){
                        inputs[index + 1].focus();
                    }
                })
            })
            
            submit.addEventListener('focus',function(){
                this.type = "submit"
            })
             

        $('.delete_btn').on('click', function() {
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
