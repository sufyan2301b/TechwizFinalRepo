<!doctype html>
<html lang="en">
<head>
    <title>Checkout</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-responsive {
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-print {
            margin: 20px 0;
        }
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>

<body>
<div class="container">
    <h1 class="text-center my-4">Checkout</h1>
    <button class="btn btn-success btn-print" onclick="printdiv()">Print Bill</button>

    <div class="table-responsive printarea">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (session('cart'))
                @foreach (session('cart') as $id => $details)
                <tr rowId="{{$id}}">
                    <td data-th="Product">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('Images/' . $details['image']) }}" class="product-image me-3" alt="{{ $details['name'] }}">
                            <div>
                                <h5 class="mb-0">{{$details['name']}}</h5>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">PKR {{$details['price']}}</td>
                    <td data-th="Quantity">{{$details['quantity']}}</td>
                    <td data-th="Subtotal" class="text-center">PKR {{$details['price'] * $details['quantity']}}</td>
                    <td class="actions text-center">
                        <a href="#" class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i> Remove</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js" integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function printdiv() {
        $('.printarea').print();
    }

    $('.delete-product').click(function (e) {
        e.preventDefault();

        var ele = $(this);
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: 'deleteproduct',
                method: 'DELETE',
                data: {
                    _token: '{{csrf_token()}}',
                    id: ele.closest('tr').attr("rowId")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
</body>
</html>
