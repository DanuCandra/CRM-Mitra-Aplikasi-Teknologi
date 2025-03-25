@extends('layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Acoounts Sales <span
                class="font-weight-bold text-primary">{{ $sales->name }}</span></h1>

        <a href="{{ url('/reports/view-report/' . $sales->id) }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Acoounts</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Phone</th>
                                <th>Website</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Company Name</th>
                                <th>Phone</th>
                                <th>Website</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($accounts as $account)
                                <tr>
                                    <td>{{ $account->account_name }}</a> </td>
                                    <td>{{ $account->phone }}</td>
                                    <td>{{ $account->website }}</td>
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
