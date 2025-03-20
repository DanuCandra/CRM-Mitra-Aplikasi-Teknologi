@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Prospect Information</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Prospect Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        
                            <div class="d-flex justify-content-start mb-3">
                                <button onclick="printDiv('printableArea')" class="btn btn-primary btn-sm mr-2">
                                    <i class="fas fa-print"></i> Print
                                </button>
                                <a href="{{ url('/prospects/convert-prospect/' . $prospect->id) }}"
                                    class="btn btn-success btn-sm mr-2">
                                    <i class="fas fa-file-alt"></i> Convert
                                </a>
                                <a href="{{ url('/prospects/edit-prospect/' . $prospect->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>

                            <!-- Area yang akan dicetak -->
                            <div id="printableArea">
                                <h5 class="mb-3"><strong>Prospect Information</strong></h5>
                                <table class="table table-borderless" style="table-layout: fixed; width: 100%;">
                                    <tr>
                                        <td class="text-right font-weight-bold pr-3 w-25">First Name</td>
                                        <td class="w-50">{{ $prospect->first_name }}</td>
                                        <td class="text-right font-weight-bold pr-3 w-25">Last Name</td>
                                        <td class="w-50">{{ $prospect->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right font-weight-bold pr-3">Title</td>
                                        <td>{{ $prospect->title }}</td>
                                        <td class="text-right font-weight-bold pr-3">Email</td>
                                        <td>{{ $prospect->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right font-weight-bold pr-3">Phone</td>
                                        <td>{{ $prospect->phone }}</td>
                                        <td class="text-right font-weight-bold pr-3">Prospect Status</td>
                                        <td>{{ $prospect->prospect_status }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right font-weight-bold pr-3">Prospect Source</td>
                                        <td colspan="3">{{ $prospect->prospect_source }}</td>
                                    </tr>
                                </table>

                                <h5 class="mb-3 mt-4"><strong>Address Information</strong></h5>
                                <table class="table table-borderless" style="table-layout: fixed; width: 100%;">
                                    <tr>
                                        <td class="text-right font-weight-bold pr-3 w-25">Street</td>
                                        <td class="w-50">{{ $prospect->street }}</td>
                                        <td class="text-right font-weight-bold pr-3 w-25">City</td>
                                        <td class="w-50">{{ $prospect->city }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right font-weight-bold pr-3">State</td>
                                        <td>{{ $prospect->state }}</td>
                                        <td class="text-right font-weight-bold pr-3">Zip Code</td>
                                        <td>{{ $prospect->zip_code }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right font-weight-bold pr-3">Country</td>
                                        <td colspan="3">{{ $prospect->country }}</td>
                                    </tr>
                                </table>

                                <h5 class="mb-3 mt-4"><strong>Description Information</strong></h5>
                                <div class="border p-3 rounded bg-light">
                                    <p>{{ $prospect->description }}</p>
                                </div>
                            </div>
                       
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JavaScript untuk Print -->
    <script>
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // Reload agar tampilan kembali normal setelah print
        }
    </script>
@endsection
