@extends('layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Deals</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Deals</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Deal Name</th>
                                <th>Amount</th>
                                <th>Stage</th>
                                <th>Closing Date</th>
                                <th>Company Name</th>
                                <th>Contact Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Deal Name</th>
                                <th>Amount</th>
                                <th>Stage</th>
                                <th>Closing Date</th>
                                <th>Company Name</th>
                                <th>Contact Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($deals as $deal)
                                <tr>
                                    <td>{{ $deal->deal_name }}</a> </td>
                                    <td>{{ $deal->amount }}</a> </td>
                                    <td>{{ $deal->deal_stage }}</td>
                                    <td>{{ $deal->closing_date }}</td>
                                    <td>{{ $deal->get_account_detail->account_name }}</td>
                                    <td>{{ $deal->get_contact_detail->contact_name }}</td>

                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#edit_contact_{{ $deal->id }}"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#hapus_contact_{{ $deal->id }}"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Hapus Modal-->
                                <div class="modal fade" id="hapus_contact_{{ $deal->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Contact</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Are you sure delete this deal
                                                {{ $deal->deal_name }} ?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-danger"
                                                    href="{{ url('/deals/delete-deal/' . $deal->id) }}">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal-->
                                <div class="modal fade" id="edit_contact_{{ $deal->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Contact?</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Are you sure edit this deal
                                                {{ $deal->deal_name }}?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-primary"
                                                    href="{{ url('/deals/edit-deal/' . $deal->id) }}">Edit</a>
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
