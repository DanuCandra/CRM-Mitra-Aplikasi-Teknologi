@extends('layouts.main')

@section('content')
    <div class="container-fluid">

       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">All Activities Prspects <span
        class="font-weight-bold text-primary">{{ $sales->name }}</span></h1>

<a href="{{ url('/reports/view-report/' . $sales->id) }}" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left"></i> Back
</a>

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
                            @foreach ($activities as $activitie)
                                <tr>
                                    <td>{{ $activitie->first_name }} {{ $activitie->last_name }}</td>
                                    <td>{{ $activitie->company }}</td>
                                    <td>{{ $activitie->email }}</td>
                                    <td>{{ $activitie->phone }}</td>
                                    <td>{{ $activitie->activities->count() }}</td>
                                    <td>
                                        <a href="{{ url('/reports/view-report-activities/' .$activitie->id) }}"
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
