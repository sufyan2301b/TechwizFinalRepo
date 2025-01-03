@extends ('AdminDashboard.adminbasic')
@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
           <div class="table-responsive">
            <table class="table table-default">

                @if (session('delete'))
                <div class="alert alert-danger">{{session('delete')}}</div>
                @endif

                @if (session('updated'))
                <div class="alert alert-primary">{{session('updated')}}</div>
                @endif

                <thead>
                    <tr>
                        <th scope="col">User Name</th>
                        <th scope="col">User Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                    <tr>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>
                            <a href="{{url('/edituser', $u->id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{url('/deleteuser', $u->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           </div>

        </div>
    </main>

@endsection
