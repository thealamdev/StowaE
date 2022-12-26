{{-- {{ $sizes }} --}}
@extends('layouts.backendapp')
@section('title','Size Create')
@section('backendContent')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_card_links d-flex align-items-center">
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.size.index') }}" class="btn btn-primary">Go Back</a>
                                </div>
        
                                <div class="links_item pr-5 ">
                                    <a href="{{ route('dashboard.size.archieve') }}" class="btn btn-primary">Archieve</a>
                                </div>
        
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.size.create') }}" class="btn btn-primary">Refresh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="row mt-4">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-body">
                    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
                    
                    <form action="{{ route('dashboard.size.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group">
                            <label for="name">Size Name</label>
                           <input type="text" name="name" class="form-control @error('name')
                               is-invalid
                           @enderror" placeholder="Enter Size name">
                           @error('name')
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