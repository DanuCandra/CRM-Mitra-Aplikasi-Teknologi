@extends('layouts.main')



@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Prospect</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Prospect</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Prospect Information</h3>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">First Name <span class="text-danger">*</span></label>
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="text" class="form-control" id="firstName" placeholder="Enter first name"
                                        name="first_name" value="{{ old('first_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="title">Title<span class="text-danger">*</span></label>
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="text" class="form-control" id="title" placeholder="Enter Title"
                                        name="title" value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number<span class="text-danger">*</span></label>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="text" class="form-control" id="phone"
                                        placeholder="Enter phone number" name="phone" value="{{ old('phone') }}">
                                </div>
                                @php
                                    $prospect_source = ['Advertising', 'Social Media', 'Direct Call', 'Search'];
                                @endphp
                                <div class="form-group">
                                    <label>Prospect Source</label>
                                    <select class="form-control select2" style="width: 100%;" name="prospect_source">
                                        @foreach ($prospect_source as $source)
                                            <option value="{{ $source }}">{{ $source }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName">Last Name<span class="text-danger">*</span></label>
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="text" class="form-control" id="lastName" placeholder="Enter last name"
                                        name="last_name" value="{{ old('last_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="company">Company<span class="text-danger">*</span></label>
                                    @error('company')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="text" class="form-control" id="company" placeholder="Enter Company"
                                        name="company" value="{{ old('company') }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="email" class="form-control" id="email" placeholder="Enter Email"
                                        name="email" value="{{ old('email') }}">
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
                                    <label>Prospect Status</label>
                                    <select class="form-control select2" style="width: 100%;" name="prospect_status">
                                        @foreach ($prospect_status as $status)
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Address Information</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" id="street" placeholder="Enter Street"
                                        name="street">
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" placeholder="Enter State"
                                        name="state">
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country"
                                        placeholder="Enter Country" name="country">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" placeholder="Enter City"
                                        name="city">
                                </div>
                                <div class="form-group">
                                    <label for="zipCode">Zip Code</label>
                                    <input type="text" class="form-control" id="zipCode"
                                        placeholder="Enter Zip Code" name="zip_code">
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Description Information</h3>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="description"></textarea>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                        <a href="{{ url('/dashboard') }}"  class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
