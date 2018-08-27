<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>IEI Anchor Pension Managers Limited | @yield('title') </title>
        @include('includes.header_site')        
        
        @yield('content')
        <script type="text/javascript">
        var IMG_URL = {!! json_encode(url('/site/img/')) !!}
        var USER_IMG_URL = {!! json_encode(url('/site/client_imgs/')) !!}
        var BASEURL = {!! json_encode(url('/')) !!}
        </script>
        @include('includes.footer_site')
        