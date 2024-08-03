<x-app-layout>
</x-app-layout>
@extends ('admin.products.layout')
@section('content')
    <div class="container mt-2"> 
        <div class="row"> 
            <div class="col-lg-12 margin-tb"> 
                <div class="pull-left"> 
                    <h2> CRUD </h2> 
                </div> 
                <div class="pull-right mb-2"> 
                    <a class="btn btn-success" href="{{ route('products_admin.create') }}"> Create Product</a> 
                </div> 
            </div> 
        </div> 
        @if ($message = Session::get('success')) 
            <div class="alert alert-success"> 
                <p>{{ $message }}</p> 
            </div> 
        @endif 
        <table class="table table-bordered"> 
            <thead> 
                <tr> 
                    <th>S.No</th> 
                    <th>Product Name</th> 
                    <th>Category Name</th>
                    <th>Description</th>  
                    <th>Price</th> 
                    <th>Photo</th> 
                    <th width="280px">Action</th> 
                </tr> 
            </thead> 
            <tbody> 
                @foreach ($products as $product) 
                    <tr> 
                        <td>{{ $product->id }}</td> 
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->description }}</td> 
                        <td>{{ $product->price }}</td>
                        <td> <img src="{{ asset($product->photo) }}" alt="" width="50" hight="50" class="img img-responsive"></td>

                        <td> 
                            <form action="{{ route('products_admin.destroy',$product->id) }}" method="Post"> 
                                <a class="btn btn-primary" href="{{ route('products_admin.edit',$product->id) }}">Edit</a> 
                                @csrf 
                                @method('DELETE') 
                                <button type="submit" class="btn btn-danger">Delete</button> 
                            </form> 
                        </td> 
                    </tr> 
                @endforeach 
            </tbody> 
        </table> 
    </div> 

@endsection