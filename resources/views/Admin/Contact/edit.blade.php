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

                                <form action="{{ route('admincontact.update',$contact->id) }}" method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputText">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ $contact->address }}" id="exampleInputText" placeholder="Enter address">

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputText">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $contact->email }}" id="exampleInputText" placeholder="Enter email">

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputText">Number</label>
                                        <input type="number" class="form-control" name="number" value="{{ $contact->number }}" id="exampleInputText" placeholder="Enter Phone">

                                    </div>





                                    <div class="form-check">
                                        <input type="checkbox" name="status" value="1" class="form-check-input" id="exampleCheck1"
                                        @if ($contact->status==1)
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
