@extends('admin.layout.loginMaster')

@section('styles')
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }
        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }
        .form button:hover,.form button:active,.form button:focus {
            background: #43A047;
        }
        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }
        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }
        .form .register-form {
            display: none;
        }
        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }
        .container:before, .container:after {
            content: "";
            display: block;
            clear: both;
        }
        .container .info {
            margin: 50px auto;
            text-align: center;
        }
        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }
        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }
        .container .info span a {
            color: #000000;
            text-decoration: none;
        }
        .container .info span .fa {
            color: #EF3B3A;
        }
        body{
            background-color: #ECF0F5;
        }

    </style>
@stop

@section('main-body')
    <div>
        <div class="login-page">
            <h3 class="text-center">Login to access Counter Panel</h3>
            <div class="form">
                @if(Session::has('error'))
                    <h4 class="text-center" style="color: darkred;"><i class="fa fa-warning"></i> {{ Session::get('error') }}</h4>
                @endif
                <form class="login-form" method="post" action="{{url('counter-management/login-validation')}}">
                    {{ csrf_field() }}
                    <input type="text" placeholder="username" name="username" id="focusedInput" required value="{{ old('username') }}"/>
                    @if ($errors->has('username'))
                        <span class="help-block has-error" style="color: darkred; text-align: left;">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                    <input type="password" placeholder="password" name="password" id="focusedInput" required value="{{ old('password') }}"/>
                    @if ($errors->has('password'))
                        <span class="help-block" style="color: darkred; text-align: left;">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <button type="submit">login</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $('.message a').click(function(){
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
    </script>
@stop