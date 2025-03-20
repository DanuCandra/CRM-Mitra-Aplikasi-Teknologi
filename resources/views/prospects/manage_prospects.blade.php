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
                            @foreach ($prospects as $prospect)
                                <tr>
                                    <td> <a href="{{ url('prospects/view-prospect/' . $prospect->id) }}">{{ $prospect->first_name }} {{ $prospect->last_name }}</a> </td>
                                    <td>{{ $prospect->company }}</td>
                                    <td>{{ $prospect->email }}</td>
                                    <td>{{ $prospect->phone }}</td>
                                    <td>{{ $prospect->prospect_source }}</td>
                                    <td>{{ $prospect->prospect_status }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_prospect_{{ $prospect->id }}"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_prospect_{{ $prospect->id }}"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Hapus Modal-->
                                <div class="modal fade" id="hapus_prospect_{{ $prospect->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Prospect?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Are you sure delete this prospect {{ $prospect->first_name }} {{ $prospect->last_name }}?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-danger" href="{{ url('/prospects/delete-prospect/' . $prospect->id) }}">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal-->
                                <div class="modal fade" id="edit_prospect_{{ $prospect->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Prospect?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Are you sure edit this prospect {{ $prospect->first_name }} {{ $prospect->last_name }}?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-primary" href="{{ url('/prospects/edit-prospect/' . $prospect->id) }}">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
