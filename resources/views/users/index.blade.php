<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" > 
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->category_name }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                        <a href="{{ route('users.products') }}" class="btn btn-primary">More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>