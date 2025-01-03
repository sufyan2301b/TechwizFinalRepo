<!-- resources/views/profiledata.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer Profile</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-header {
            margin-top: 20px;
        }
        .profile-img {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .gallery-img {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .details {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Designer Profile</h1>
        <div class="row profile-header">
            @if ($designerdata)
                @foreach ($designerdata as $d)
                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                    <img src="../Images/{{ $d->profile }}" class="profile-img" width="100%" height="auto" alt="{{ $d->name }}">
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <div class="details">
                        <h2>{{ $d->name }}</h2>
                        <p><strong>Email:</strong> {{ $d->email }}</p>
                        <p><strong>Bio:</strong> {{ $d->bio }}</p>
                        <p><strong>Portfolio:</strong> {{ $d->portfolio_link }}</p>
                        {{-- <p><strong>Phone:</strong> {{ $d->phone }}</p> --}}
                        {{-- <p><strong>Bio:</strong> {{ $d->bio }}</p> --}}
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p class="alert alert-danger">Designer not found.</p>
                </div>
            @endif
        </div>

        @if (session('consultsend'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alert('{{ session("consultsend") }}');
                });
            </script>
            @endif

        <div class="row mt-4">
            <h2 class="text-center">Consult</h2>
            <div class="row d-flex justify-content-around">

        <form action="{{url('/profile', $d->id)}}" method="post">
            @csrf
            <input type="text" class="form-control" name="customer_name" placeholder="Enter Name">
            <input type="email" class="form-control mt-2" name="customer_email" placeholder="Enter Email">
            <input type="date" name="booking_date" class="form-control mt-2">
            <select name="booking_time" class="form-control mt-2">
                <option selected disabled value="">Select Time</option>
                <option value="09:00">9AM</option>
                <option value="12:00">12PM</option>
                <option value="15:00">3PM</option>
                <option value="17:00">5PM</option>
            </select>
        <textarea name="brief" class="form-control mt-2" placeholder="Project Breif" cols="30" rows="5"></textarea>
        <button type="submit" class="btn btn-primary mt-2">Book Now</button>
        </form>
            </div>


            @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alert('{{ session("success") }}');
                });
            </script>
            @endif

            <div class="row mt-4">
                <h2 class="text-center">Feedback Form</h2>
                <div class="row d-flex justify-content-around">

            <form action="{{url('/feedback', $d->id)}}" method="post">
                @csrf
                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                <input type="email" class="form-control mt-2" name="email" placeholder="Enter Email">

            <textarea name="message" class="form-control mt-2" placeholder="Message" cols="30" rows="5"></textarea>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
                </div>
            </div>
        </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-c9D3f5mGbZQJgFAH38HiZJKqKkeEV3/YuGgbBhXf3n2yXzQY22+H9VIGQi5ET2dC" crossorigin="anonymous"></script>
</body>

</html>
