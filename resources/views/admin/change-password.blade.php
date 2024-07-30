    @extends('admin.master.master')

    @section('content')
        {{-- main content --}}
        <div class="right_col" role="main">
            <div class="">

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="">
                                <h2 class="text-center ">Change Password</h2>
                                @if (session('error'))
                                    <div class="alert alert-danger w-50 mx-auto" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success w-50 mx-auto" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="ln_solid"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form action="{{ route('admin.store-password') }}" method="POST" id="demo-form2" data-parsley-validate
                                    class="form-horizontal form-label-left">
                                    @csrf

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="current_password">Current Password <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 d-flex justify-content-between align-items-center ">
                                            <input type="password" id="current_password" name="current_password"
                                                class="form-control ">
                                            <div class="input-group-append">
                                                <span class=" toggle-password ml-3" type="button"
                                                    data-target="#current_password"><i class="fa fa-eye"></i></span>
                                            </div>
                                            <span class="text-danger">
                                                @error('current_password')
                                                    {{ $message }}
                                                @enderror
                                            </span>

                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="new_password">New
                                            Password <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 d-flex justify-content-between align-items-center ">
                                            <input type="password" id="new_password" name="new_password"
                                                class="form-control ">
                                            <div class="input-group-append">
                                                <span class=" toggle-password ml-3" type="button"
                                                    data-target="#new_password"><i class="fa fa-eye"></i></span>
                                            </div>
                                            <span class="text-danger">
                                                @error('new_password')
                                                    {{ $message }}
                                                @enderror
                                            </span>

                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="c_password">Confirm
                                            Password <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 d-flex justify-content-between align-items-center ">
                                            <input type="password" id="confirm_password" name="confirm_password"
                                                class="form-control ">
                                            <div class="input-group-append">
                                                <span class=" toggle-password ml-3" type="button"
                                                    data-target="#confirm_password"><i class="fa fa-eye"></i></span>
                                            </div>
                                            <div class="input-group-append">

                                            </div>
                                            <span class="text-danger">
                                                @error('confirm_password')
                                                    {{ $message }}
                                                @enderror
                                            </span>

                                        </div>
                                    </div>

                                    <div class="item form-group my-5">
                                        <div class="col-md-6 col-sm-6 offset-md-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- /main content --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const togglePasswordBtns = document.querySelectorAll('.toggle-password');

                togglePasswordBtns.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const targetId = this.getAttribute('data-target');
                        const targetInput = document.querySelector(targetId);

                        if (targetInput.getAttribute('type') === 'password') {
                            targetInput.setAttribute('type', 'text');
                            this.innerHTML = '<i class="fa fa-eye-slash"></i>';
                        } else {
                            targetInput.setAttribute('type', 'password');
                            this.innerHTML = '<i class="fa fa-eye"></i>';
                        }
                    });
                });
            });
        </script>
    @endsection
