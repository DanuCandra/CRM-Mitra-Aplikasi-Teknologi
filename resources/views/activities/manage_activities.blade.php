@extends('layouts.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Prospects with Activities</h1>

        <!-- Data Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of Prospects</h6>
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
                                <th>Number of Activities</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prospects as $prospect)
                                <tr>
                                    <td>{{ $prospect->first_name }} {{ $prospect->last_name }}</td>
                                    <td>{{ $prospect->company }}</td>
                                    <td>{{ $prospect->email }}</td>
                                    <td>{{ $prospect->phone }}</td>
                                    <td>{{ $prospect->activities->count() }}</td>
                                    <td>
                                        <a href="{{ url('activities/view-activities/' . $prospect->id) }}"
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
@endsection
