@extends('dashboard.master')

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">All Blog</h4>
                            <h6 class="card-subtitle">Showing Blog</h6>
                        </div>
                        <div>
                            <a href="{{ route('blog.create') }}" class="btn btn-md btn-primary">ADD NEW BLOG</a>
                        </div>
                    </div>

                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table border table-striped">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Blog Title</th>    
                                    <th>Feature Image</th>                                                                                               
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                
                                @foreach ($allBlog as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>
                                    <img src="{{ $blog->featured_image}}" alt="img" width="50px" height="50px">
                                </td>                                <td>
                                    <a href="{{ route('blog.edit', ['blog' => $blog]) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-pencil-alt"></i> 
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteBlog({{ $blog->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    
                                    <a href="{{ route('blog.details',['id'=>$blog->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-circle-info"></i>                                               </a>

                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $allBlog->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function playAudio() {
                var audio = document.getElementById("successAudio");
                audio.play().catch(function(error) {
                    console.error('Error playing audio:', error);
                });
            }

            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
                playAudio()
            @endif


            
        });

    </script>
   

<script>
    function deleteBlog(blogId) {
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this blog post!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('/blog/delete/') }}/" + blogId;
            }
        });
    }
</script>

@endsection
