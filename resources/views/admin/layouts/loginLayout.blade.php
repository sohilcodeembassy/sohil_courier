<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Austrans Logistic') }}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/core.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/components.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/colors.css') }}" rel="stylesheet">
    <!-- /global stylesheets -->
    @stack('css')

    <!-- Core JS files -->
    <script src="{{ asset('backend/assets/js/plugins/loaders/pace.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/core/libraries/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/core/libraries/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/plugins/loaders/blockui.min.js') }}" type="text/javascript"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('backend/assets/js/plugins/forms/validation/validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/plugins/forms/styling/uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/core/app.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ asset('backend/assets/js/plugins/ui/ripple.min.js') }}" type="text/javascript"></script> -->
    @stack('js')
    <!-- /theme JS files -->

</head>
<body class="login-container login-cover">

    @yield('content')

</body>
</html>
