@extends ('admin.products.layout')
@section('content')
    <div class="container mt-2"> 
        <div class="row"> 
            <div class="col-lg-12 margin-tb"> 
                <div class="pull-left mb-2"> 
                    <h2>Add Category</h2> 
                </div> 
                <div class="pull-right"> 
                    <a class="btn btn-primary" href="{{ route('products_admin.index') }}"> Back</a> 
                </div> 
            </div> 
        </div> 
        @if(session('status')) 
        <div class="alert alert-success mb-1 mt-1"> 
            {{ session('status') }} 
        </div> 
        @endif 
        <form action="{{ route('products_admin.store') }}" method="POST" enctype="multipart/form-data"> 
            @csrf 
            <div class="row"> 

                <div class="col-xs-12 col-sm-12 col-md-12"> 
                    <div class="form-group"> 
                        <strong>Product Name:</strong> 
                        <input type="text" name="product_name" class="form-control" placeholder="Product Name"> 
                        @error('product_name') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> 
                        @enderror 
                    </div> 
                </div> 


                <div class="col-xs-12 col-sm-12 col-md-12"> 
                    <div class="form-group"> 
                        <strong>Category Name:</strong> 
                        <select name="category_id" class="form-control">
                            <option value="">Choose a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_name') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> 
                        @enderror 
                    </div> 
                </div> 

                <div class="col-xs-12 col-sm-12 col-md-12"> 
                    <div class="form-group"> 
                        <strong>Description:</strong> 
                        <input type="text" name="description" class="form-control" placeholder="Description"> 
                        @error('description') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> 
                        @enderror 
                    </div> 
                </div> 

                <div class="col-xs-12 col-sm-12 col-md-12"> 
                    <div class="form-group"> 
                        <strong>Price:</strong> 
                        <input type="number" name="price" class="form-control" placeholder="Price"> 
                        @error('price') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> 
                        @enderror 
                    </div> 
                </div> 

                <div class="col-xs-12 col-sm-12 col-md-12"> 
                    <div class="form-group"> 
                        <strong>Photo:</strong> 
                        <input type="file" name="photo" class="form-control" placeholder="Photo"> 
                        @error('photo') 
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> 
                        @enderror 
                    </div> 
                </div> 
                <button type="submit" class="btn btn-primary ml-3">Submit</button> 
            </div> 
        </form> 
    </div> 

@endsection