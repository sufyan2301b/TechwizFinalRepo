<!doctype html>
<html lang="en">

<head>
    <title>Our Proud Designers</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .card {
            border: none; /* Remove border for a cleaner look */
            transition: transform 0.2s; /* Smooth hover effect */
        }
        .card:hover {
            transform: scale(1.05); /* Slight zoom effect on hover */
        }
        h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: #343a40; /* Darker text color */
        }
        .container {
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Our Proud Designers</h1>
        <div class="row">
            @foreach ($interiorDesigner as $i)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="card shadow-sm"> <!-- Added shadow for depth -->
                        <img src="Images/{{ $i->profile }}" class="card-img-top" alt="{{ $i->name }}" style="height: 300px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h3 class="card-title">{{ $i->name}}</h3>
                            <a href="/profile/{{ $i->id }}" class="btn btn-dark mt-3">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>
