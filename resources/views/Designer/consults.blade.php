@extends ('Designer.index')
@section('content')
    <div id="layoutSidenav_content">
        <main class="container mt-3">
            <h1 class="text-center text-secondary my-3">Consults</h1>

            @if (session('cancel'))
                <div class="alert alert-danger">
                    {{ session('cancel') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-default">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Booking Date</th>
                            <th scope="col">Booking Time</th>
                            <th scope="col">Brief</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($consults as $c)
                            <tr>
                                <td>{{ $c->customer_name }}</td>
                                <td>{{ $c->customer_email }}</td>
                                <td>{{ $c->booking_date }}</td>
                                <td>{{ $c->booking_time }}</td>
                                <td>{{ $c->brief }}</td>
                                <td>
                                    <a href="{{ url('/updatepending', $c->id) }}" class="btn btn-primary">
                                        {{ $c->status === 'pending' ? 'Pending' : 'Approved' }}
                                    </a>
                                    @if ($c->status == "pending")
                                    <a href="{{ url('/cancel', $c->id) }}" class="btn btn-danger">Cancel</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </main>
    </div>
@endsection
