@extends('dashboard.master')

@section('body')
    <style type="text/css">
        .ck-editor__editable_inline {


            height: 300px;

        }
    </style>

    <div class="col-lg-12">


        


        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Add New Blog</h4>

                <form class="form-horizontal p-t-20" action="{{ route('blog.store') }}" method="POST"
                    enctype="multipart/form-data">
                    <h2 class="text-center text-success fw-bold">{{ session('message') }}</h2>
                    <h2 class="text-center text-error fw-bold">{{ session('errror') }}</h2>

                    @csrf

                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Blog Title*</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="title" id="exampleInputuname3"
                                    placeholder="Blog Title">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Feature Image*</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="file" class="form-control" name="feature_image" id="featured_image"
                                    placeholder="Product Name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputEmail3" class="col-sm-3 control-label">Content</label>
                        <div class="col-sm-9">
                            <textarea id="editor" name="content"></textarea>

                        </div>
                    </div>

                    <div class="form-group row m-b-0">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="mt-4 text-white btn btn-success waves-effect waves-light">Create
                                New Blog</button>
                        </div>
                    </div>
                </form>





            </div>
        </div>
    </div>
   

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('blog.uploadImages', ['_token' => csrf_token()]) }}"
                }
            })
            .then(editor => {
                console.log('CKEditor initialized successfully');


            })
            .catch(error => {
                console.error('Error initializing CKEditor:', error);
            });



        

        $(document).ready(function() {
            
            function playAudio() {
                var audio = document.getElementById("errorAudio");
                audio.play().catch(function(error) {
                    console.error('Error playing audio:', error);
                });
            }

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    console.log("Error message: {{ $error }}"); 
                    toastr.error("{{ $error }}");
                @endforeach
                playAudio();
            @endif
        });
    </script>


    {{-- <script src="{{ asset('js/ckeditor.js') }}"></script> --}}
@endsection
