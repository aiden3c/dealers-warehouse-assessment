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
    </div>
    <form class="flex w-1/3 md:flex-col flex-row justify-center items-center border-2 border-gray-400 gap-4 [&>*]:w-full [&_input]:border-2 [&_input]:border-gray-400 [&_input]:rounded-md [&_input]:p-2 [&_input]:focus:outline-none [&_input]:focus:ring-2 [&_input]:focus:ring-blue-500 [&_input]:focus:border-blue-500" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
        <input type="hidden" name="account_number" value="{{ isset($customer) ? $customer->account_number : old('account_number') }}">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <label for="customerName">Customer Name:</label>
        <input required type="text" id="customerName" name="customerName" value="{{ isset($customer) ? $customer->name : old('customerName') }}" class="@error('customerName') border-2 border-y-red-600 @enderror">

        <br>

        <label>Billing Address:</label>
        <input required type="text" id="address_1" name="address_1" value="{{ isset($customer) ? $customer->address_1 : old('address_1') }}" class="@error('address_1') border-2 border-y-red-600 @enderror">
        <input type="text" id="address_2" name="address_2" value="{{ isset($customer) ? $customer->address_2 : old('address_2') }}">
        <label>City:</label>
        <input required type="text" id="city" name="city" value="{{ isset($customer) ? $customer->city : old('city') }}" class="@error('city') border-2 border-y-red-600 @enderror">
        <label>State:</label>
        <input required type="text" id="state" name="state" value="{{ isset($customer) ? $customer->state : old('state') }}" class="@error('state') border-2 border-y-red-600 @enderror">
        <label>Zip Code:</label>
        <input required type="text" id="zip" name="zip" value="{{ isset($customer) ? $customer->zip : old('zip') }}" class="@error('zip') border-2 border-y-red-600 @enderror">

        <br>

        <label for="phone">Phone:</label>
        <input required type="tel" id="phone" name="phone" value="{{ isset($customer) ? $customer->phone : old('phone') }}" class="@error('phone') border-2 border-y-red-600 @enderror">

        <br>

        <label for="email">Email:</label>
        <input required type="email" id="email" name="email" value="{{ isset($customer) ? $customer->email : old('email') }}" class="@error('email') border-2 border-y-red-600 @enderror">

        <br>

        <label for="business_type">Type of Business (choose one of the following):</label>
        <select  required id="business_type" name="business_type" class="@error('business_type') border-2 border-y-red-600 @enderror">
            <option {{ isset($customer) && $customer->business_type == 'corporation' ? 'selected' : '' }} value="corporation">Corporation</option>
            <option {{ isset($customer) && $customer->business_type == 'llc' ? 'selected' : '' }} value="llc">LLC</option>
            <option {{ isset($customer) && $customer->business_type == 'sole' ? 'selected' : '' }} value="sole">Sole Proprietor</option>
            <option {{ isset($customer) && $customer->business_type == 'other' ? 'selected' : '' }} value="other">Other</option>
        </select>

        <br>

        <p>Preferred Days of Receiving Shipments (Choose one *or* more of the following):</p>
        <input {{ isset($customer) && in_array('monday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="monday"> <label>Monday</label>
        <input {{ isset($customer) && in_array('tuesday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="tuesday"> <label>Tuesday</label>
        <input {{ isset($customer) && in_array('wednesday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="wednesday"> <label>Wednesday</label>
        <input {{ isset($customer) && in_array('thursday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="thursday"> <label>Thursday</label>
        <input {{ isset($customer) && in_array('friday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="friday"> <label>Friday</label>

        <br>

        <input type="submit" value="Submit">
    </form>

</body>
</html>
