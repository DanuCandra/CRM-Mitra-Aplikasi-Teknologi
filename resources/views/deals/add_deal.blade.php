@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Judul Halaman -->
            <h3 class="mt-3">Add Deal</h3>



            <!-- Formulir untuk Input Data -->
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3"><strong>Create New Deal</strong></h5>
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Amount</label>
                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" name="amount" value="0" name="amount">
                        </div>
                        <div class="form-group">
                            <label>Deal Name<span class="text-danger">*</span></label>
                            @error('deal_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" name="deal_name">
                        </div>
                        <div class="form-group">
                            <label>Closing Date<span class="text-danger">*</span></label>
                            @error('closing_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="date" class="form-control" name="closing_date">
                        </div>
                        @php
                                    $customer_status = [
                                        'Qualifications',
                                        'Needs Analysis',
                                        'Proposal/ Price Quote',
                                        'Negotiation',
                                        'Closed Won',
                                        'Closed Lost',
                                    ];
                                @endphp
                                <div class="form-group">
                                    <label>Deal Stage</label>
                                    <select class="form-control select2" style="width: 100%;" name="deal_stage">
                                        @foreach ($customer_status as $status)
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        <div class="form-group">
                            <label>Account Name<span class="text-danger">*</span></label>
                            @error('account_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <select class="form-control select2" style="width: 100%;" name="account_id">
                                @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                
                            @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Contact Name<span class="text-danger">*</span></label>
                            @error('account_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <select class="form-control select2" style="width: 100%;" name="contact_id">
                                @foreach ($contacts as $contact)
                                <option value="{{ $contact->id }}">{{ $contact->contact_name }}</option>
                                
                            @endforeach

                            </select>
                        </div>





                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary mr-2" name="submit" value="submit">Save</button>
                            <a href="{{ url('accounts/manage-accounts') }}" type="button"
                                class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
