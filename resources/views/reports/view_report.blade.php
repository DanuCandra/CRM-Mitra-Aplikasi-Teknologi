@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Deals</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $deals_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ url('/reports/details-deals/' . $sales->id) }}" class="btn btn-sm btn-primary mt-2">More Info</a>
                    </div>
                </div>
            </div>
            

            <!-- Total Amount Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total (Amount)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($total_amount, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-sm btn-success mt-2">More Info</a>
                    </div>
                </div>
            </div>

            <!-- Activity Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Activity</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Aktivitas</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-sm btn-info mt-2">More Info</a>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Deals</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $deals_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-sm btn-warning mt-2">More Info</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection