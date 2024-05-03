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
                    @csrf


                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Blog Title*</label>
                        <div class="col-sm-9">
                            <div class="input-group">

                                <input type="text" class="form-control" name="blog_title" id="exampleInputuname3"
                                    placeholder="Product Name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Feature Image*</label>
                        <div class="col-sm-9">
                            <div class="input-group">

                                <input type="file" class="form-control" name="feature_image" id="featureImage"
                                    placeholder="Product Name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputEmail3" class="col-sm-3 control-label">Content</label>
                        <div class="col-sm-9">
                            <div id="editor"></div>
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
                    uploadUrl: "{{ route('blog.uploadImages',['_token'=>csrf_token()]) }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    {{-- <script src="{{ asset('js/ckeditor.js') }}"></script> --}}
@endsection
