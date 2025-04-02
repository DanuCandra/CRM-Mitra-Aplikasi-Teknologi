@extends('layouts.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Activities for {{ $prospect->first_name }} {{ $prospect->last_name }}</h1>

        <div class="mb-3">
            <a href="{{ url('reports/details-activities/'. $prospect->user_id) }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Prospects
            </a>
        </div>


        <!-- Data Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Activity List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td>{{ $activity->title }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>{{ $activity->date_time }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
