<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>IEI Anchor | @yield('title') </title>
        <style>
            .table_row:hover{
                cursor: pointer
            }
        </style>
        @include('includes.header_pages')        
        
        @yield('content')
        @include('includes.footer_pages')

