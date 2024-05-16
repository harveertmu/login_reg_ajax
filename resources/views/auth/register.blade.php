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
                    <h3 class="panel-title">Please Register</h3>

                    <h3 class="panel-title" id="error_message" style="color:red;display:none;"></h3>
                </div>
                <div class="panel-body">
                    <form role="form" id="reg_form">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name" type="name" autofocus="" id="name">
                                <p style="color:red; display:none;" id="name_error">Name field is required
                                <p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" id="email">
                                <p style="color:red; display:none;" id="email_error">Email field is required
                                <p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" id="password" value="" autocomplete="new-password">
                                <p style="color:red; display:none;" id="pass_error">Password field is required
                                <p>
                            </div>

                            <!-- Change this to a button or input when using this as a form -->
                            <a href="#" class="btn btn-lg btn-success btn-block" onclick="register()">Register</a>
                            <a href="/">Login</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function register() {
        $('#name_error').hide();
        $('#email_error').hide();
        $('#pass_error').hide();
        $('#error_message').hide();
        // error_message
        var error = 0;
        var name = $('#name').val();
        var email = $('#email').val();
        var pass = $('#password').val();

        if (name == '') {
            $('#name_error').show();
            var error = 1;
        }
        if (email == '') {
            $('#email_error').show();
            var error = 1;
        }
        if (pass == '') {
            $('#pass_error').show();
            var error = 1;
        }

        if (error == 0) {

            var form_data = $('#reg_form').serialize();

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });


            $.ajax({
                type: 'POST',
                url: '/reg_user',
                data: form_data,
                success: function(result) {
                    // console.log('result',result);
                    // debugger
                    if (result.success_code == '200') {
                        alert('Registration done');
                        // window.location = 'home';
                    } else {
                        $('#error_message').text(result.message);
                        $('#error_message').show();

                    }

                }



            })


        }


    }
</script>

@stop