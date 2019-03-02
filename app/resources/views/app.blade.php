<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} - @yield('title', 'Home')</title>
    ​
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app"></div>

<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
<script>
    $(function(){
        var pagetop=$('#returnTop');
        pagetop.hide();

        $(window).scroll(function(){
            if($(this).scrollTop()>600){
                pagetop.fadeIn();
            }else{
                pagetop.fadeOut();
            }
        });
        pagetop.click(function(){
            $('body,html').animate({
                scrollTop: 0},600);
            return false;
        });
    });
</script>
</body>
</html>
