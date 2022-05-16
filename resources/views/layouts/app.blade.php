<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('/css/tabler.css') }}">
    <link rel="stylesheet" href="{{ asset('/icon/css/boxicons.min.css') }}">
    @livewireStyles
</head>
<body>
    
    <div class="page">
        @include('partials.navbar')
        
        <div class="page-wrapper">
            <div class="page-header">
                <div class="container">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    
    @livewireScripts
    <script src="{{ asset('/js/tabler.js') }}"></script>
</body>
</html>