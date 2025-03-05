<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealers Warehouse Assessment</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app">
        <navbar></navbar>
        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
</html>
