@extends('dashboard.master')

@section('body')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Blog</h4>
                        <h6 class="card-subtitle">Showing Blog</h6>
                        <h2 class="text-center text-success fw-bold">{{ session('message') }}</h2>

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
@endsection