{{-- {{ $categories }} --}}
@extends('layouts.backendapp')
@section('title','Category Create')
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
        
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary">Refresh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('dashboard.category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row mt-4">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                         <div class="form-group">
                           <label for="name">Product Title</label>
                           <input type="text" name="name" class="form-control @error('name')
                               is-invalid
                           @enderror" placeholder="Enter Category name">
                           @error('name')
                           <div class="text-danger pt-1">
                               <p>{{$message}}</p>
                           </div>
                           @enderror
                         </div>

                         <div class="form-group">
                            <label for="name">Product Image</label>
                           <input type="file" name="image" class="form-control @error('image')
                               is-invalid
                           @enderror">
                           @error('image')
                            <div class="text-danger p-1">
                                <p>{{ $message }}</p>
                        
                             </div>
                            @enderror
                         </div>
                </div>
             </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="parent_id">Post Category</label>
                       <select name="parent_id" class="form-control">
                        <option selected disabled>select category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                       </select>
                     </div>
                </div>
            </div>
        </div>

     </div>
     <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Product Description</label>
                       <textarea name="description" class="summernote form-control @error('description')
                           is-invalid
                        @enderror" cols="30" rows="6" placeholder="Enter category description"></textarea>
                        @error('description')
                            <div class="text-danger pt-1">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    
                     </div>

                     <div class="form-group">
                        <label for="name">Product short Description</label>
                       <textarea name="description" class="summernote form-control @error('description')
                           is-invalid
                        @enderror" cols="30" rows="6" placeholder="Enter category description"></textarea>
                        @error('description')
                            <div class="text-danger pt-1">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    
                     </div>

                     <div class="form-group">
                        <label for="name">Product additional Information</label>
                       <textarea name="description" class="summernote form-control @error('description')
                           is-invalid
                        @enderror" cols="30" rows="6" placeholder="Enter category description"></textarea>
                        @error('description')
                            <div class="text-danger pt-1">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    
                     </div>

                     
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                         <div class="form-group">
                           <label for="name">Product Price</label>
                           <input type="number" name="name" class="form-control @error('name')
                               is-invalid
                           @enderror" placeholder="Enter Product Price">
                           @error('name')
                           <div class="text-danger pt-1">
                               <p>{{$message}}</p>
                           </div>
                           @enderror
                         </div>

                         <div class="form-group">
                            <label for="name">Product Sale Price</label>
                           <input type="number" placeholder="Enter product sale price" name="image" class="form-control @error('image')
                               is-invalid
                           @enderror">
                           @error('image')
                            <div class="text-danger p-1">
                                <p>{{ $message }}</p>
                        
                             </div>
                            @enderror
                         </div>
                </div>
             </div>
        </div>
     </div>
    </form>
@endsection

@section('header-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('footer-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js" integrity="sha512-ZESy0bnJYbtgTNGlAD+C2hIZCt4jKGF41T5jZnIXy4oP8CQqcrBGWyxNP16z70z/5Xy6TS/nUZ026WmvOcjNIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    $('.summernote').summernote({
        placeholder: 'what is on your mind',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
  });
</script>
 
@endsection