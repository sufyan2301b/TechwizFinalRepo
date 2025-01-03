<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <div class="container px-4">



            <script>
                var alertList = document.querySelectorAll(".alert");
                alertList.forEach(function (alert) {
                    new bootstrap.Alert(alert);
                });
            </script>

            <h1 class="mt-4">View Products</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    <a href="/checkout">Checkout Page</a>
                </li>
            </ol>
         <div class="row">
            @foreach($records as $rec)
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="{{asset('Images/'.$rec->image)}}" alt="" height="250px">
                <div class="card-body">
                    <h4 class="card-title">{{$rec->name}}</h4>
                    <p class="card-text">{{$rec->price}}</p>
                    <p class="card-text">{{$rec->category}}</p>
                    <br>
                    <input type="number" class="quantity">
                    <br>
                    <br>
                    <button class="btn btn-primary mybtn"
                    data-name="{{$rec->name}}"
                    data-price ="{{$rec->price}}"
                    data-userid={{Auth::User()->id}}>Add to Cart</button>
                </div>
            </div>
            @endforeach
         </div>

        </div>

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $('.mybtn').click(function (){
               var pname = $(this).attr('data-name');
               var pprice = $(this).attr('data-price');
               var uid = $(this).attr('data-userid');
               var quantity = $('.quantity').val();
               var total = pprice*quantity

               $.ajax({
                url:"/insprod",
                type:"POST",
                data:{
                    pname:pname,
                    pprice:pprice,
                    quantity:quantity,
                    total:total,
                    uid:uid,
                    " _token":"{{ csrf_token() }}"

                },
                success:function()
                {
                  alert("Success");
                }
               })

            })

        </script>
    </body>
</html>
