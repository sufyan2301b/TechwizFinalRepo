<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .gallery-title {
            margin-bottom: 30px;
            text-align: center;
            color: #343a40;
        }
        .card {
            margin: 15px;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>


<div class="container">
    <h1 class="gallery-title mt-4">My Gallery</h1>
    <div class="row">
        @foreach ($favourite as $f)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('Images/' . $f->image) }}" class="card-img-top" alt="Gallery Image" style="height: 250px; object-fit: cover;">
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
