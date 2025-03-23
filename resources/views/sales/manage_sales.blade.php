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
                            @foreach ($sales as $orang)
                                <tr>
                                    <td>{{ $orang->name }}</td>
                                    <td>{{ $orang->email }}</td>


                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#edit_sales_{{ $orang->id }}"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#hapus_sales_{{ $orang->id }}"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Hapus Modal-->
                                <div class="modal fade" id="hapus_sales_{{ $orang->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Sales</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Are you sure delete this sales
                                                {{ $orang->name }} ?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-danger"
                                                    href="{{ url('/sales/delete-sales/' . $orang->id) }}">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal-->
                                <div class="modal fade" id="edit_sales_{{ $orang->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Sales?</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Are you sure edit this Sales
                                                {{ $orang->name }}?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-primary"
                                                    href="{{ url('/sales/edit-sales/' . $orang->id) }}">Edit</a>
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
