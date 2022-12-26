{{-- {{ $all_color }} --}}
@extends('layouts.backendapp')
@section('title','Color Edit')
@section('backendContent')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_card_links d-flex align-items-center">
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.color.index') }}" class="btn btn-primary">Go Back</a>
                                </div>
        
                                <div class="links_item pr-5 ">
                                    <a href="{{ route('dashboard.color.archieve') }}" class="btn btn-primary">Archieve</a>
                                </div>
                                @foreach ($colors as $color)
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.color.edit',$color->id) }}" class="btn btn-primary">Refresh</a>
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

                    @foreach ($colors as $color)
                    <form action="{{ route('dashboard.color.update', $color->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                         <div class="form-group">
                            <label for="name">Color Name</label>
                            @error('name')
                                {{ $message }}
                            @enderror
                            
                            <input type="text" name="name" value="{{ $color->name }}" class="form-control" placeholder="Enter Color name">
                            
                            
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