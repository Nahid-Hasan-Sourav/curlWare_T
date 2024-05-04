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

                <form class="form-horizontal p-t-20" action="{{ route('blog.update',['id'=>$blog->id]) }}" method="POST"
                    enctype="multipart/form-data">
                 

                    @csrf

                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Blog Title*</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="title" id="exampleInputuname3"
                                    placeholder="Blog Title" value={{ $blog->title }}>

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputuname3" class="col-sm-3 control-label">Feature Image*</label>
                     
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="file" id="input-file-now" name="feature_image" class="dropify"/>
                                <img src="{{$blog->featured_image}}" width="200" height="100"/>                        </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputEmail3" class="col-sm-3 control-label">Content</label>
                        <div class="col-sm-9">
                            <textarea id="editor" name="content">{{ $blog->content }}</textarea>

                        </div>
                    </div>

                    <div class="form-group row m-b-0">
                        <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="mt-4 text-white btn btn-success waves-effect waves-light">Update
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

     
    </script>


@endsection
