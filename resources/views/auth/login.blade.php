@extends('layouts.main')

@section('title', 'Page Title')

@section('sidebar')

@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>

                    <h3 class="panel-title" id="error_message" style="color:red;display:none;">Please check your credentials</h3>
                </div>
                <div class="panel-body">
                    <form role="form" id="login_form">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="User Name" name="email" type="email" autofocus="" id="email">
                                <p style="color:red; display:none;" id="email_error">Email field is required
                                <p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" id="password" value="" autocomplete="new-password">
                                <p style="color:red; display:none;" id="pass_error">Password field is required
                                <p>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <a href="#" class="btn btn-lg btn-success btn-block" onclick="login()">Login</a>
                            <a href="register">Register</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function login() {

        $('#email_error').hide();
        $('#pass_error').hide();
        $('#error_message').hide();
        // error_message
        var error = 0;
        var email = $('#email').val();
        var pass = $('#password').val();

        if (email == '') {
            $('#email_error').show();
            var error = 1;
        }
        if (pass == '') {
            $('#pass_error').show();
            var error = 1;
        }

        if (error == 0) {

            var form_data = $('#login_form').serialize();

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });


            $.ajax({
                type: 'POST',
                url: '/login',
                data: form_data,
                success: function(result) {
                    // console.log('result',result);
                    // debugger
                    if (result.success_code == '200') {
                        window.location = 'home';
                    } else {
                        $('#error_message').show();

                    }

                }



            })


        }


    }
</script>

@stop