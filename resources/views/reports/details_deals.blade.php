@extends('layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">



        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Deals For Sales <span
                class="font-weight-bold text-primary">{{ $sales->name }}</span></h1>
        <!-- Tombol Back -->
        <a href="{{ url('/reports/view-report/' . $sales->id) }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <!-- Filter Tanggal -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="GET" action="{{ url('/reports/details-deals/' . $sales->id) }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Start Date:</label>
                            <input type="date" class="form-control" name="start_date"
                                value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">End Date:</label>
                            <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deals as $deal)
                                <tr>
                                    <td>{{ $deal->deal_name }}</td>
                                    <td>Rp {{ number_format($deal->amount, 0, ',', '.') }}</td>
                                    <td>{{ $deal->deal_stage }}</td>
                                    <td>{{ $deal->closing_date }}</td>
                                    <td>{{ $deal->get_account_detail->account_name }}</td>
                                    <td>{{ $deal->get_contact_detail->contact_name }}</td>
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
