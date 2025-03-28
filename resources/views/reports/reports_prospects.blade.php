@extends('layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Prospect</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Prospect</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Prospect Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Prospect Source</th>
                                <th>Prospect Status</th>
                                <th>From Sales</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Prospect Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Prospect Source</th>
                                <th>Prospect Status</th>
                                <th>From Sales</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($prospects as $prospect)
                                <tr>
                                    <td> <span class="font-weight-bold text-primary"> <a
                                                href="{{ url('prospects/view-prospect/' . $prospect->id) }}">{{ $prospect->first_name }}
                                                {{ $prospect->last_name }}</a> </td></span>
                                    <td>{{ $prospect->company }}</td>
                                    <td>{{ $prospect->email }}</td>
                                    <td>{{ $prospect->phone }}</td>
                                    <td>{{ $prospect->prospect_source }}</td>
                                    <td>{{ $prospect->prospect_status }}</td>
                                    <td> <a href="{{ url('reports/view-report/' . $prospect->user->id) }}"><span
                                                class="font-weight-bold text-primary">{{ $prospect->user->name }}</span></a>
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
