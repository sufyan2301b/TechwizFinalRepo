@extends ('Designer.index')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            @foreach ($portfolio as $p)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('Images/' . $p->image) }}" class="card-img-top" alt="...">
                </div>
            @endforeach
        </main>
    </div>
@endsection
