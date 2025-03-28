@extends('layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Contact</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Contact</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Contact Name</th>
                                <th>Account Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>From Sales</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Contact Name</th>
                                <th>Account Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>From Sales</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->contact_name }}</a> </td>
                                    <td>{{ $contact->getAccountDetail->account_name }}</a> </td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td> <a href="{{ url('reports/view-report/' . $contact->user->id) }}"><span
                                                class="font-weight-bold text-primary">{{ $contact->user->name }}</span></a>
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
