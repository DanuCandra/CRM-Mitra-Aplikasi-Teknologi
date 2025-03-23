@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <h3 class="mt-3">Add Sales</h3>

            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3"><strong>Create New Sales</strong></h5>
                    <form action="" method="POST" onsubmit="return validatePassword()">
                        @csrf
                        <div class="form-group">
                            <label>Sales Name<span class="text-danger">*</span></label>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label>Email<span class="text-danger">*</span></label>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <label>Password<span class="text-danger">*</span></label>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('password', 'eyeIcon1')">
                                        <i id="eyeIcon1" class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password<span class="text-danger">*</span></label>
                            @error('password_lagi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <input type="password" class="form-control" name="password_lagi" id="password_lagi">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('password_lagi', 'eyeIcon2')">
                                        <i id="eyeIcon2" class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <small id="passwordError" class="text-danger" style="display: none;">Passwords do not match</small>
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary mr-2" name="submit" value="submit">Save</button>
                            <a href="{{ url('sales/manage-sales') }}" type="button" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            var input = document.getElementById(inputId);
            var icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("password_lagi").value;
            var errorText = document.getElementById("passwordError");
            
            if (password !== confirmPassword) {
                errorText.style.display = "block";
                return false;
            } else {
                errorText.style.display = "none";
                return true;
            }
        }
    </script>
@endsection
