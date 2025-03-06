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
    <div class="m-4">
        <div class="text-4xl font-bold text-gray-800 mb-4">Add Customer</div>
        <div class="flex justify-center items-center">
            <form class="grid grid-cols-1 m-0 p-0 w-full lg:w-5/6 lg:p-4 rounded-md md:flex-col flex-row justify-center items-center border-0 lg:border-2 border-gray-400 gap-4 [&>*]:w-full [&_input]:h-12 [&_input]:border-2 [&_input]:border-gray-400 [&_input]:rounded-md [&_input]:p-2 [&_input]:focus:outline-none [&_input]:focus:ring-2 [&_input]:focus:ring-blue-500 [&_*]:focus:border-blue-500" method="POST">
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

                <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 m-0 p-2 lg:p-0 lg:m-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 col-span-2">
                        <label class="text-lg font-bold text-gray-800" for="customerName">Customer Name:</label>
                        <input required type="text" id="customerName" name="customerName" value="{{ isset($customer) ? $customer->name : old('customerName') }}" class="@error('customerName') border-2 border-y-red-600 @enderror">
                        <label class="text-lg font-bold text-gray-800" for="phone">Phone:</label>
                        <input required type="tel" id="phone" name="phone" value="{{ isset($customer) ? $customer->phone : old('phone') }}" class="@error('phone') border-2 border-y-red-600 @enderror">
                        <label class="text-lg font-bold text-gray-800" for="email">Email:</label>
                        <input required type="email" id="email" name="email" value="{{ isset($customer) ? $customer->email : old('email') }}" class="@error('email') border-2 border-y-red-600 @enderror">
                        <label class="text-lg font-bold text-gray-800" for="business_type">Type of Business (choose one of the following):</label>
                        <select required id="business_type" name="business_type" class="h-12 border-2 border-gray-400 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('business_type') border-y-red-600 @enderror">
                            <option {{ isset($customer) && $customer->business_type == 'corporation' ? 'selected' : '' }} value="corporation">Corporation</option>
                            <option {{ isset($customer) && $customer->business_type == 'llc' ? 'selected' : '' }} value="llc">LLC</option>
                            <option {{ isset($customer) && $customer->business_type == 'sole' ? 'selected' : '' }} value="sole">Sole Proprietor</option>
                            <option {{ isset($customer) && $customer->business_type == 'other' ? 'selected' : '' }} value="other">Other</option>
                        </select>
                    </div>
                    <div class="1/3">&nbsp;</div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 col-span-2 gap-4">
                        <label class="text-lg font-bold text-gray-800" for="address_1">Billing Address:</label>
                        <div class="grid gap-4">
                            <input required type="text" id="address_1" name="address_1" value="{{ isset($customer) ? $customer->address_1 : old('address_1') }}" class="@error('address_1') border-2 border-y-red-600 @enderror">
                            <input type="text" id="address_2" name="address_2" placeholder="Secondary Address" value="{{ isset($customer) ? $customer->address_2 : old('address_2') }}">
                        </div>
                        <label class="text-lg font-bold text-gray-800" for="city">City:</label>
                        <input required type="text" id="city" name="city" value="{{ isset($customer) ? $customer->city : old('city') }}" class="@error('city') border-2 border-y-red-600 @enderror">
                        <label class="text-lg font-bold text-gray-800" for="state">State:</label>
                        <input required type="text" id="state" name="state" value="{{ isset($customer) ? $customer->state : old('state') }}" class="@error('state') border-2 border-y-red-600 @enderror">
                        <label class="text-lg font-bold text-gray-800" for="zip">Zip Code:</label>
                        <input required type="text" id="zip" name="zip" value="{{ isset($customer) ? $customer->zip : old('zip') }}" class="@error('zip') border-2 border-y-red-600 @enderror">

                    </div>
                </div>

                <div>
                    <div class="text-center mb-4">
                        <span class="text-lg font-bold text-gray-800">Preferred Days of Receiving Shipments </span>
                        <span>(Choose one <b>or more</b> of the following):</span>
                    </div>
                    <div class="grid grid-cols-5 [&_input]:w-full [&_div]:text-center">
                        <div>
                            <label class="select-none text-xs lg:text-lg font-bold text-gray-800" for="monday">Monday</label>
                            <br>
                            <input {{ isset($customer) && in_array('monday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="monday" id="monday">
                        </div>
                        <div>
                            <label class="select-none text-xs lg:text-lg font-bold text-gray-800" for="tuesday">Tuesday</label>
                            <br>
                            <input {{ isset($customer) && in_array('tuesday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="tuesday" id="tuesday">
                        </div>
                        <div>
                            <label class="select-none text-xs lg:text-lg font-bold text-gray-800" for="wednesday">Wednesday</label>
                            <br>
                            <input {{ isset($customer) && in_array('wednesday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="wednesday" id="wednesday">
                        </div>
                        <div>
                            <label class="select-none text-xs lg:text-lg font-bold text-gray-800" for="thursday">Thursday</label>
                            <br>
                            <input {{ isset($customer) && in_array('thursday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="thursday" id="thursday">
                        </div>
                        <div>
                            <label class="select-none text-xs lg:text-lg font-bold text-gray-800" for="friday">Friday</label>
                            <br>
                            <input {{ isset($customer) && in_array('friday', json_decode($customer->availability)) ? 'checked' : '' }} type="checkbox" name="friday" id="friday">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 text-center">
                    <input class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" type="submit" value="Submit">
                    @if(isset($customer))
                        <a href="/customers/{{$customer->account_number}}/delete" class="mt-6 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" type="submit">Delete Customer</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</body>
</html>
