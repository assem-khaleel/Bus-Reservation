
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to Bus Ticket System</title>

    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link href="{{asset('css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{asset('css/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">

    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     {{--<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>--}}

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>



</head>
<body>
@include('user.user-header')
@yield('user-welcome-content')
@yield('user-profile')
@yield('edit-profile-form')
@yield('bus-list')
@yield('booking-form')
@yield('user-add-bus')
@yield('report-booking')
@stack('script')
@include('user.user-footer')
</body>
</html>