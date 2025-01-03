@extends ('Designer.index')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="profile-container" style="padding: 20px">
                <div class="profile-image"></div>
                @foreach ($interiorDesigner as $i)
                    <div class="profile-details">
                        <h2>{{ $i->name }}</h2>
                        <p>Email: {{ $i->email }}</p>
                        <p class="bio">This is a short bio about {{ $i->name }}. It can include information about
                            skills,
                            experiences, and interests.</p>

                        <h3>Portfolio</h3>
                        <div class="portfolio">

                        </div>

                        <a href="#" class="btn btn-secondary" id="update-btn" data-bs-toggle="modal"  data-bs-target="#updateModal" data-id="{{ $i->id }}">Update</a>
                    </div>
                @endforeach

                <!-- Modal Structure -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Update Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="updateForm" enctype="multipart/form-data">
                                    <input type="hidden" name="id" id="designer-id">
                                    <div class="mb-3">
                                        <label for="designer-name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="designer-name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="designer-email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="designer-email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="designer-bio" class="form-label">Bio</label>
                                        <textarea class="form-control" id="designer-bio" name="bio"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
<script>
   $(document).ready(function () {
    // Setup CSRF token for all AJAX requests
    $(document).on("click", "#update-btn", function(){
        var id = $(this).attr("data-id");
        alert(id);
        $.ajax({
            url: "/interior-designers",
            type:"POST",
            data: "uid="+ id+
            '&_token={{csrf_token()}}',
            success: function(data){
                console.log(data);
                // $("#updateModal").show();
                // var result = JSON.parse(data);
                // $('#designer-name').val(result["name"]);
            }

        })
    })


});


</script>
