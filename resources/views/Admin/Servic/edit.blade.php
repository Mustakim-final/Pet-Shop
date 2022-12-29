@extends('Admin.home')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with minimal features & hover style</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <form action="{{ route('adminservice.update',$service->id) }}" method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputText">Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ $service->title }}" id="exampleInputText" placeholder="Enter title">

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputText">Sub Title</label>
                                        <input type="text" class="form-control" name="sub_title" value="{{ $service->subtitle }}" id="exampleInputText" placeholder="Enter sub title">

                                    </div>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Description</span>
                                        </div>
                                        <textarea class="form-control" name="description"  aria-label="With textarea">{{ $service->details }}</textarea>
                                      </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="custom-file">
                                            <input type="file" class="input-file uniform_on" id="exampleInputFile"
                                                name="slider_image">

                                        </div>
                                    </div>



                                    <div class="form-check">
                                        <input type="checkbox" name="check" value="1" class="form-check-input" id="exampleCheck1"
                                        @if ($service->status==1)
                                        checked
                                        @endif
                                        >
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->



                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
