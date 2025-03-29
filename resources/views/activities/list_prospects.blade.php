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
                                <th>Action</th>
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
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td> <span class="font-weight-bold text-primary"> <a
                                                href="{{ url('prospects/view-prospect/' . $activity->id) }}">{{ $activity->first_name }}
                                                {{ $activity->last_name }}</a> </span></td>
                                    <td>{{ $activity->company }}</td>
                                    <td>{{ $activity->email }}</td>
                                    <td>{{ $activity->phone }}</td>
                                    <td>{{ $activity->prospect_source }}</td>
                                    <td>{{ $activity->prospect_status }}</td>
                                    <td>
                                        <a href="{{ url('activities/add-activity/' . $activity->id) }}"
                                            class="btn btn-success">Add Activity</a>
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
