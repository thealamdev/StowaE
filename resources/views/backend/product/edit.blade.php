{{-- {{ $categories }} --}}
@extends('layouts.backendapp')
@section('title','Product Edit')
@section('backendContent')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_card_links d-flex align-items-center">
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.product.index') }}" class="btn btn-primary">Go Back</a>
                                </div>
        
                                <div class="links_item pr-5 ">
                                    <a href="{{ route('dashboard.product.archieve') }}" class="btn btn-primary">Archieve</a>
                                </div>
        
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.product.create') }}" class="btn btn-primary">Refresh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('dashboard.product.store') }}" method="POST" enctype="multipart/form-data">
     @csrf
     <div class="row mt-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Product Edit</h3>
                </div>
                <div class="card-body">

                         <div class="form-group">
                           <label for="title">Title*</label>
                           <input type="text" name="title" value="{{ $product->title }}" class="form-control @error('title')
                               is-invalid
                           @enderror" placeholder="Enter Product name">
                           @error('title')
                           <div class="text-danger pt-1">
                               <p>{{$message}}</p>
                           </div>
                           @enderror
                         </div>

                         <div class="form-group">
                            <label for="image">Image*</label>
                           <input type="file" name="image" class="form-control @error('image')
                               is-invalid
                           @enderror">
                           @error('image')
                            <div class="text-danger p-1">
                                <p>{{ $message }}</p>
                        
                             </div>
                            @enderror

                            <img src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->title }}" width="100">
                         </div>
                         <div class="form-group">
                            <label for="price">Price*</label>
                            <input type="number" name="price" value="{{ $product->price }}" class="form-control @error('price')
                                is-invalid
                            @enderror" placeholder="Enter Product Price">
                            @error('price')
                            <div class="text-danger pt-1">
                                <p>{{$message}}</p>
                            </div>
                            @enderror
                          </div>
 
                          <div class="form-group">
                             <label for="sale_price">Sale Price</label>
                            <input type="number" placeholder="Enter product sale price" name="sale_price" value="{{ $product->sale_price }}" class="form-control @error('sale_price')
                                is-invalid
                            @enderror">
                            @error('sale_price')
                             <div class="text-danger p-1">
                                 <p>{{ $message }}</p>
                         
                              </div>
                             @enderror
                          </div>

                          <div class="form-group">
                            <label for="discount">Discount</label></label>
                           <input type="number" placeholder="Enter product discount" name="discount" value="{{ $product->discount }}" class="form-control @error('discount')
                               is-invalid
                           @enderror">
                           @error('discount')
                            <div class="text-danger p-1">
                                <p>{{ $message }}</p>
                        
                             </div>
                            @enderror
                         </div>

                           
                        <div class="form-group">
                            <label for="category">Products Category*</label>
                            <br>
                            @foreach ($categories as $category)
                            <input type="checkbox" name="category[]" value="{{ $category->id }}" @foreach ($product->categories as $cat)
                            @if ($category->id == $cat->id)
                            {{ "checked" }}
                            @endif
                            @endforeach
                             > 
                            {{ $category->name }}
                            @endforeach
                            @error('category')
                            <div class="text-danger pt-1">
                                <p>{{$message}}</p>
                            </div>
                            @enderror
                             
                             
                        </div>

                        <div class="form-group">
                            <label for="category">Products Gallary</label>
                            <br>
                             <input type="file" name="gallary[]" multiple>
                            @error('gallary')
                            <div class="text-danger pt-1">
                                <p>{{$message}}</p>
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
                <div class="card-header">
                    <h3>Descriptions</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="description">Description</label>
                       <textarea name="description" class="summernote form-control @error('description')
                           is-invalid
                        @enderror" cols="30" rows="6" placeholder="Enter product description">{{ $product->description }}</textarea>
                        @error('description')
                            <div class="text-danger pt-1">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    
                     </div>

                     <div class="form-group">
                        <label for="short_description">Short Description</label>
                       <textarea name="short_description" class="summernote form-control @error('short_description')
                           is-invalid
                        @enderror" cols="30" rows="6" placeholder="Enter product short description">{{ $product->short_description }}</textarea>
                        @error('short_description')
                            <div class="text-danger pt-1">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    
                     </div>

                     <div class="form-group">
                        <label for="additional_info">Additional Information</label>
                       <textarea name="additional_info" class="summernote form-control @error('additional_info')
                           is-invalid
                        @enderror" cols="30" rows="6" placeholder="Enter Additional Information">{[{{ $product->additional_info }}]}</textarea>
                        @error('additional_info')
                            <div class="text-danger pt-1">
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