{{-- {{ $all_category }} --}}
@extends('layouts.backendapp')
@section('title','Category Edit')
@section('backendContent')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_card_links d-flex align-items-center">
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.category.index') }}" class="btn btn-primary">Go Back</a>
                                </div>
        
                                <div class="links_item pr-5 ">
                                    <a href="{{ route('dashboard.category.archieve') }}" class="btn btn-primary">Archieve</a>
                                </div>
                                @foreach ($categories as $category)
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.category.edit',$category->id) }}" class="btn btn-primary">Refresh</a>
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

                    @foreach ($categories as $category)
                    <form action="{{ route('dashboard.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group">
                            <label for="name">Category Name</label>
                            @error('name')
                                {{ $message }}
                            @enderror
                            
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Enter Category name">
                            
                            
                         </div>

                         <div class="form-group">
                            <label for="parent_id">Category Parent</label>
                           <select name="parent_id" class="form-control">
                            @error('name')
                            {{ $message }}
                            @enderror
                            <option selected disabled>select parent category</option>
                            @foreach ($all_category as $single_cat)
                            <option value="{{ $single_cat->id }}" {{ $single_cat->id==$category->parent_id ? 'selected':'' }}>{{ $single_cat->name }}</option>
                            @endforeach
                            
                             
                           </select>
                         </div>

                         <div class="form-group">
                            <label for="name">Category Description</label>
                           <textarea name="description" class="form-control" cols="30" rows="6" placeholder="Enter category description">{{ $category->description }}</textarea>

                           @error('description')
                               {{ $message }}
                           @enderror
                         </div>

                         <div class="form-group">
                            <label for="name">Create Category</label>
                           <input type="file" name="image" class="form-control">
                           <img src="{{ asset('storage/category/'.$category->image) }}" alt="" width="50" class="pt-3">
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