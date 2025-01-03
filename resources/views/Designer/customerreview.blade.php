@extends ('Designer.index')
@section('content')


    <div id="layoutSidenav_content">
        <main>
            @foreach ($review as $r)
            <div class="container mt-2">

                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5>{{$r->name}}</h5>
                        <h6>{{$r->email}}</h6>
                        <p>{{$r->review}}</p>
                    </div>
                  </div>
        </div>
            @endforeach
        </main>
    </div>


@endsection
