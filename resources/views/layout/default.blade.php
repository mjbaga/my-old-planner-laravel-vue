<!DOCTYPE html>
<html lang="en">
<head>
@include('element.head')    
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    @include('element.script')
</body>
</html>