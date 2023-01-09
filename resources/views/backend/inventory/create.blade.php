{{-- {{ $categories }} --}}
@extends('layouts.backendapp')
@section('title','Inventory Create')
@section('backendContent')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_card_links d-flex align-items-center">
                                <div class="links_item pr-5  ">
                                    <a href="{{ route('dashboard.inventory.index') }}" class="btn btn-primary">Go Back</a>
                                </div>
        
                                <div class="links_item pr-5 ">
                                    <a href="{{ route('dashboard.inventory.archieve') }}" class="btn btn-primary">Archieve</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

     <div class="row mt-4">

        <div class="col-lg-8">
 
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <table class="table table-striped mb-0 thead-border-top-0">
                                        <thead>
                                            <th>Product id</th>
                                            <th>Color id</th>
                                            <th>Size id</th>
                                            <th>Quantity</th>
                                            <th>Additional Price</th>
                                            <th>Action</th>
            
                                        </thead>
                                        @forelse ($products->inventories as $each)
                                        <tr>
                                            <td>{{ $each->id }}</td>
                                            <td>{{ $each->color->name }}</td>
                                            <td>{{ $each->size->name }}</td>
                                            <td>{{ $each->quantity }}</td>
                                            <td>{{ $each->additional_price }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary">Edit</a>
                                                <a href="#" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                            {{ "Data not found" }}
                                        @endforelse
                                      
                                     
                                        
                                     </table>
                                </div>
                            </div>
                        </div>
                    </div>
          
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @foreach ($product as $each)
                         
                    
                    <form action="{{ route('dashboard.inventory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="form-group">
                         <label for="title">Product Title</label>
                           <input type="text" name="title" value="{{ $each->title }}" class="form-control @error('title')
                               is-invalid
                           @enderror" placeholder="Enter Product Title">
                           @error('title')
                           <div class="text-danger pt-1">
                               <p>{{$message}}</p>
                           </div>
                           @enderror
                         </div>

                         <input type="hidden" name="product_id" value="{{ $each->id }}">

                         <div class="form-group">
                            <label for="color_id">Product Color</label>
                           <select name="color_id" class="form-control" id="selectColor">
                            <option selected disabled>Select a product color</option>
                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}"> {{ $color->name }}</option>
                            @endforeach
                           </select>
                         </div>

                         <div class="form-group">
                            <label for="size_id">Product size</label>
                           <select name="size_id" class="form-control">
                            <option selected disabled>Select a product size</option>
                            @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                           </select>
                         </div>

                         <div class="form-group">
                            <label for="quantity">Product Quantity</label>
                              <input type="number" name="quantity" class="form-control @error('quantity')
                                  is-invalid
                              @enderror" placeholder="Enter Product Title">
                              @error('quantity')
                              <div class="text-danger pt-1">
                                  <p>{{$message}}</p>
                              </div>
                              @enderror
                        </div>

                        <div class="form-group">
                            <label for="additional_price">Product's Additional Price</label>
                              <input type="number" name="additional_price" class="form-control @error('additional_price')
                                  is-invalid
                              @enderror" placeholder="Enter Product Title">
                              @error('additional_price')
                              <div class="text-danger pt-1">
                                  <p>{{$message}}</p>
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

@section('footer-js')
<script>
    $(document).ready(function(){
        $('#selectColor').on('change',function(){
            $.ajax({
                type:'POST',
                url:"{{ route('dashboard.inventory.colorSelect') }}",
                dataType:'json',
                data:{
                    _token:'{{ csrf_token() }}'
                },
                success:function(data){
                    console.log(data);
                }
                
            })  
        })
    })
</script>
  
@endsection