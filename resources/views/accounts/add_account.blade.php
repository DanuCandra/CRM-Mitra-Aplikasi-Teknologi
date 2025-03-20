@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Judul Halaman -->
            <h3 class="mt-3">Add Account</h3>

            

            <!-- Formulir untuk Input Data -->
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3"><strong>Create New Account</strong></h5>
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Account Name<span class="text-danger">*</span></label>
                            @error('account_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control"  name="account_name">
                        </div>
                        <div class="form-group">
                            <label>Phone<span class="text-danger">*</span></label>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            
                            <input type="text" class="form-control" name="website">
                        </div>
                       


                        <!-- Tombol Convert dan Edit -->
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary mr-2" name="submit"
                                value="submit">Save</button>
                            <a href="{{ url('accounts/manage-accounts') }}" type="button"
                                class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
