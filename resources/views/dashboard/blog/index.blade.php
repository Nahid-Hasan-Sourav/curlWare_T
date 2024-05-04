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
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Image</th>
                                    <th>Publication Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
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
@endsection
