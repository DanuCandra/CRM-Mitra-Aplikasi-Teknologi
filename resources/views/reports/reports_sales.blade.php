@extends('layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-gray-800">All Sales</h1>
            <a href="{{ url('/sales/add-sales') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add Sales</a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reports Sales</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sales Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sales Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($sales as $orang)
                                <tr>
                                    <td>{{ $orang->name }}</td>
                                    <td>{{ $orang->email }}</td>
                                    <td><a href="{{ url('/reports/view-report/' . $orang->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-file-alt"></i> View Report
                                    </a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
