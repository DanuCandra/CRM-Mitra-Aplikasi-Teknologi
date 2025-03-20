@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Judul Halaman -->
            <h3 class="mt-3">Add Contact</h3>



            <!-- Formulir untuk Input Data -->
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3"><strong>Create New Contact</strong></h5>
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Contact Name<span class="text-danger">*</span></label>
                            @error('contact_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" name="contact_name">
                        </div>

                        <div class="form-group">
                            <label>Account Name<span class="text-danger">*</span></label>
                            @error('account_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <select class="form-control select2" style="width: 100%;" name="account_id">
                                <option value="">Select Account</option>
                                @foreach ( $account_list as $list )
                                <option value="{{ $list->id }}">{{ $list->account_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phone<span class="text-danger">*</span></label>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            
                            <input type="text" class="form-control" name="email">
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
