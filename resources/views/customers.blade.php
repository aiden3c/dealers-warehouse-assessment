<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealers Warehouse Assessment</title>
    @vite(['resources/js/app.js'])
    @vite('resources/css/app.css')
</head>
<body>
    <div id="app">
        <navbar></navbar>
        <div class="content">
            @yield('content')
        </div>
        <div class="m-4">
            <div class="text-4xl font-bold mb-4">Customers</div>
            <div class="grid-cols-1 lg:grid grid-cols-2 gap-4">
                @foreach ($customers as $customer)
                    <?php
                        $customer->business_type = $business_types[$customer->business_type];
                    ?>
                    <customer-card customer='{!! json_encode($customer) !!}'></customer-card>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
