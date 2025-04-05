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
                <h6 class="m-0 font-weight-bold text-primary">Manage Sales</h6>
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
                            @foreach ($activities as $activitie)
                                <tr>
                                    <td>{{ $activitie->name }}</td>
                                    <td>{{ $activitie->email }}</td>
                                    <td>
                                        <a href="{{ url('reports/details-activities/' . $activitie->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View Activities
                                        </a>
                                    </td>
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
