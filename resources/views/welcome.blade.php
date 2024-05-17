<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DHIS2</title>
         <link href="/css/styles.css" rel="stylesheet">
    </head>
    <body class="bg-red">
        <div style="text-align: center;">
            <img src="{{ asset('logo.png') }}" alt="Image Description">
        </div>
        <h1 style="text-align: center;"  class="text-sm font-bold underline">
            Better HealthCare for You
        </h1> 
        <ul style="text-align: center;list-style-type: none;" >
            <li><a href="https://hiskenya.org" target="_blank">HISKenya</a></li>
            <li><a href="https://test.hiskenya.org" target="_blank">Test HISKenya</a></li>
            <li><a href="https://histracker.health.go.ke" target="_blank">HISTracket</a></li>
            <li><a href="https://kmhfl.health.go.ke" target="_blank">KMHFL Health</a></li>
        </ul>
    </body>
</html>
