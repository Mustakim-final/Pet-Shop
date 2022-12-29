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

                                <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Sub Title</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($service as $key=>$row)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td><img src="{{ URL::to($row->service_image) }}" alt="" style="height: 80px"></td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ $row->subtitle }}</td>
                                            <td style="width: 400px">{{ $row->details }}</td>
                                            <td>
                                                @if ($row->status==1)

                                                <a href="{{ route('adminservice.active',$row->id) }}">
                                                    <i class="fa fa-thumbs-up" style="font-size:30px;color:rgb(161, 215, 33)"></i>
                                                </a>

                                                @else

                                                <a href="{{ route('adminservice.unactive',$row->id) }}">
                                                    <i class="fa fa-thumbs-down" style="font-size:30px;color:rgb(44, 54, 20)"></i>
                                                </a>

                                                @endif


                                                <a href="{{ route('adminservice.updatepage',$row->id) }}" class="btn btn-info"><i class='fas fa-edit'></i></a>

                                                <a href="{{ route('adminservice.delete',$row->id) }}" class="btn btn-danger"><i class='far fa-trash-alt'></i></a>
                                            </td>
                                          </tr>

                                        @endforeach


                                    </tbody>
                                  </table>

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
