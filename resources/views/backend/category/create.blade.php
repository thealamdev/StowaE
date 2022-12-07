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

     <div class="row mt-4">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-body">
                    
                    <form action="">
                         <div class="form-group">
                            <label for="name">Category Name</label>
                           <input type="text" name="name" class="form-control" placeholder="Enter Category name">
                         </div>

                         <div class="form-group">
                            <label for="name">Category Parent</label>
                           <select name="parent_id" class="form-control">
                            <option selected disabled>select parent category</option>
                           </select>
                         </div>

                         <div class="form-group">
                            <label for="name">Category Description</label>
                           <textarea name="description" class="form-control" cols="30" rows="6" placeholder="Enter category description"></textarea>
                         </div>

                         <div class="form-group">
                            <label for="name">Create Category</label>
                           <input type="file" name="image" class="form-control">
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