@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Judul Halaman -->
            <h3 class="mt-3">Convert Prospect To Customer <small class="text-muted">({{ $prospect->first_name }}
                    {{ $prospect->last_name }} - {{ $prospect->company }})</small></h3>

            <!-- Label "Create New Account" dan "Create New Contact" -->
            <div class="mb-3">
                <span class="badge badge-primary">{{ $prospect->company }}</span>
                <span class="badge badge-primary">{{ $prospect->first_name }}</span>
            </div>

            <!-- Formulir untuk Input Data -->
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3"><strong>Create New Deal for this Account</strong></h5>
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Enter amount" name="amount">
                        </div>
                        <div class="form-group">
                            <label>Deal Name<span class="text-danger">*</span></label>
                            @error('deal_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" placeholder="Enter deal name" name="deal_name">
                        </div>
                        <div class="form-group">
                            <label>Closing Date<span class="text-danger">*</span></label>
                            @error('closing_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="date" class="form-control" name="closing_date">
                        </div>
                        @php
                            $prospect_status = [
                                'Qualifications',
                                'Needs Analysis',
                                'Proposal/ Price Quote',
                                'Negotiation',
                                'Closed Won',
                                'Closed Lost',
                            ];
                        @endphp
                        <div class="form-group">
                            <label>Prospect Status <span class="text-danger">*</span></label>
                            @error('stage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <select class="form-control select2" style="width: 100%;" name="deal_stage">
                                @foreach ($prospect_status as $status)
                                    @if ($status == $prospect->prospect_status)
                                        <option value="{{ $status }}" selected>{{ $status }}</option>
                                    @else
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>


                        <!-- Tombol Convert dan Edit -->
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary mr-2" name="submit"
                                value="submit">Convert</button>
                            <a href="{{ url('prospects/manage-prospects') }}" type="button"
                                class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
