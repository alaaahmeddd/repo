<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->

       <base href="/product">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Ecommerce Website</title>

      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
   
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
  
      <link href="home/css/style.css" rel="stylesheet" />
 
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <style>
      .card{
         background: rgb(231, 231, 231);
         border-radius: 2%;
      }
      .product-img {
            width: 350px;
            height: 400px;
            margin-left: 60px;
            margin-top: 50px;

        }
        .product-details {
            margin-top: 50px;

        }
        .price {
            font-size: 1.5rem;
            color: #e74c3c;
        }
        .discount {
            font-size: 1.2rem;
            color: #2ecc71;
        }
        .description {
            margin-top: 20px;
        }

   </style>
   <body>
      <!-- <div class="hero_area">
        <div class="container" >
         <div class="row mt-5">
            <div class="col-sm-12">
               <div class="card mb-3 p-2" style="margin: 0px 20%;">
                  <div class="container">
                     <div class="row">
                        <div class="col-8">
                           <div class="card-body">
                              <h5 class="card-title">Product Title : {{$product->product_name}}</h5>
                              <h3 class="card-text mt-2" >Product Category: <span style="color: rgb(0, 0, 0)">{{$product->category->category_name}}</span> </h3>
                              <h3 class="card-text mt-2" >Product Price: <span style="color: rgb(0, 0, 0)">${{$product->price}}</span> </h3>
                              <h3 class="card-text mt-2" >Product Discount: <span style="color: rgb(255, 6, 6)">${{$product->discount}}%</span> </h3>
                              <h3 class="card-text mt-2">Product Description: <span style="color: rgb(0, 0, 0)"> {{$product->description}}</h3>
                           </div>
                        </div>
                        <div class="col-4">
                           <img src="{{ asset($product->photo) }}" alt="" width="150" hight="150" class="img img-responsive">
                        </div>
                     </div>
                  </div>
              </div>
            </div>
         </div>
      </div>
      </div> -->

      <div class="container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="{{ asset($product->photo) }}" alt="Product Image" class="product-img" >
            </div>
            <!-- Product Details -->
            <div class="col-md-6 product-details">
                <h2>{{$product->product_name}}</h2>
                <p>Category: <strong>{{$product->category->category_name}}</strong></p>
                <p class="price">Price: $<strong>{{$product->price}}</strong></p>
                <p class="discount">Discount: $<strong>{{$product->discount}}</strong></p>
                <p class="description">Product Description: <br>{{$product->description}}</p>
                <!-- Add to Cart Button -->
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
    
   </body>
</html>