{{-- {{ $all_size }} --}}
@extends('layouts.backendapp')
@section('title','Size Edit')
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
                                @foreach ($sizes as $size)
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.size.edit',$size->id) }}" class="btn btn-primary">Refresh</a>
                                </div>
                                @endforeach
                                 
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

                    @foreach ($sizes as $size)
                    <form action="{{ route('dashboard.size.update', $size->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                         <div class="form-group">
                            <label for="name">Size Name</label>
                            <input type="text" name="name" value="{{ $size->name }}" class="form-control" placeholder="Enter Size name">
                            @error('name')
                            <div class="text-danger pt-1">
                                <p>{{ $message }}</p>
                            </div>
                            @enderror
                            
                         </div>

                         <div class="form-group">
                             <button type="submit" class="btn btn-primary">Submit</button>
                         </div>


                    </form>
                    @endforeach
                </div>
             </div>
        </div>
     </div>
@endsection