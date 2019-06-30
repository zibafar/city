<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('/')}}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/')}}css/bootstrap-rtl.css">
    <link rel="stylesheet" href="{{asset('/')}}css/main.css">
    <meta name="developer" content="sadjad zibafar">
    <meta name="website" content="http:://.zibafar.me">
    <meta name='copyright' content='Gilace'>
    <meta name='designer' content='www.Gilace.com'>
    <meta name='reply-to' content='sadjadzibafar@gmail.com'>
    @yield('css')
    <title>{{\App\Assistance::getTitle(\Request::route()->getName())}}</title>
</head>
<body>
@include('includes.header')

<div class="my_container">
    @include('includes.menu')
    @yield('content')
</div>
@yield('page_js')
@include('includes.footer')
@yield('js')
</body>
</html>