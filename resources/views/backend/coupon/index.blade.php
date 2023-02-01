{{-- {{ $categories }} --}}
@extends('layouts.backendapp')
@section('title','Coupon')
@section('backendContent')

    <div class="page_header mt-3">
        <div class="card_body">
            <h3>Coupon</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header_card_links d-flex align-items-center">
                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.coupon.create') }}" class="btn btn-primary">Create</a>
                        </div>

                        <div class="links_item pr-5 ">
                            <a href="{{ route('dashboard.coupon.archieve') }}" class="btn btn-primary">Archieve</a>
                        </div>

                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.coupon.index') }}" class="btn btn-primary">Refresh</a>
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
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Applicable Amount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </thead>
                        
                        <tbody>
                            @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->id }}</td>
                                <td>{{ $coupon->name }}</td>
                                <td>{{ $coupon->amount }}</td>
                                <td>{{ $coupon->applicable_amount }}</td>
                                <td>{{ $coupon->start_date->format('d M, y') }}</td>
                                <td>{{ $coupon->end_date->format('d M, y') }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary">Edit</a>
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
                    <form action="{{ route('dashboard.coupon.store') }}" method="POST">
                        @csrf
                         <div class="form-group">
                            <label for="name">Coupon Name</label>
                           <input type="text" name="name" class="form-control @error('name')
                               is-invalid
                           @enderror" placeholder="Enter Coupon name">
                           @error('name')
                           <div class="text-danger pt-1">
                               <p>{{$message}}</p>
                           </div>
                           @enderror
                         </div>

                         <div class="form-group">
                            <label for="amount">Coupon Amount</label>
                           <input type="number" name="amount" class="form-control @error('amount')
                               is-invalid
                           @enderror" placeholder="Enter Coupon Amount">
                           @error('amount')
                           <div class="text-danger pt-1">
                               <p>{{$message}}</p>
                           </div>
                           @enderror
                         </div>
                         <div class="form-group">
                            <label for="name">Coupon Applicable Amount</label>
                           <input type="number" name="applicable_amount" class="form-control @error('applicable_amount')
                               is-invalid
                           @enderror" placeholder="Enter Coupon Applicable Amount">
                           @error('applicable_amount')
                           <div class="text-danger pt-1">
                               <p>{{$message}}</p>
                           </div>
                           @enderror
                         </div>
                         <div class="form-group">
                            <label for="start_date">Coupon Start date</label>
                           <input type="date" name="start_date" class="form-control @error('start_date')
                               is-invalid
                           @enderror" placeholder="Enter Coupon start date">
                           @error('start_date')
                           <div class="text-danger pt-1">
                               <p>{{$message}}</p>
                           </div>
                           @enderror
                         </div>
                         <div class="form-group">
                            <label for="end_date">Coupon End Date</label>
                           <input type="date" name="end_date" class="form-control @error('end_date')
                               is-invalid
                           @enderror" placeholder="Enter Coupon End date">
                           @error('end_date')
                           <div class="text-danger pt-1">
                               <p>{{$message}}</p>
                           </div>
                           @enderror
                         </div>
                         
                         <div class="form-group">
                             <button type="submit" class="btn btn-primary">Submit</button>
                         </div>


                    </form>
                </div>
            </div>
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


 