<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CustomerController extends Controller
{
    private function uuidv4(): string //Credit to https://stackoverflow.com/a/15875555 for compliant algorithm
    {
        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public function list(): View
    {
        $customers = DB::table('customers')->orderBy('id', 'DESC')->get();
        // This is used to display easier names for business types
        $business_types = ['corporation' => "Corporation", 'llc' => "LLC", 'sole' => "Sole Proprietor", 'other' => "Other"];
        return view('customers', ['customers' => $customers, 'business_types' => $business_types]);
    }

    public function delete(string $account_number): RedirectResponse
    {
        DB::table('customers')->where('account_number', $account_number)->delete();
        return redirect('/customers');
    }

    public function validate(Request $request): array
    {
        return $request->validate([
            'customerName' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:20',
            'zip' => 'required|string|max:10',
            'phone' => 'required|string|max:16',
            'email' => 'required|email|max:100',
            'business_type' => 'in:corporation,llc,sole,other',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $this->validate($request);
        $days = [];
        foreach($request->all() as $key => $value) {
            if(in_array($key, ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"])) {
                $value = $value == 'on' ? 1 : 0;
                array_push($days, $key);
            }
        }
        $customer = DB::table('customers')->where('account_number', $request->input('account_number'))->update([
            'name' => $request->input('customerName'),
            'address_1' => $request->input('address_1'),
            'address_2' => $request->input('address_2'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip' => $request->input('zip'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'business_type' => $request->input('business_type'),
            'availability' => json_encode($days),
        ]);
        return redirect('/customers');
    }

    public function submit(Request $request): RedirectResponse
    {
        $validated = $this->validate($request);
        if ($validated) {
            $account_number = $this->uuidv4();
            $days = [];
            foreach($request->all() as $key => $value) {
                if(in_array($key, ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"])) {
                    $value = $value == 'on' ? 1 : 0;
                    array_push($days, $key);
                }
            }

            $customer = DB::table('customers')->insert([
                'account_number' => $account_number,
                'name' => $request->input('customerName'),
                'address_1' => $request->input('address_1'),
                'address_2' => $request->input('address_2'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip' => $request->input('zip'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'business_type' => $request->input('business_type'),
                'availability' => json_encode($days),
            ]);
            return redirect('/customers');
        }
        return redirect('/')->withErrors($validated);
    }

    public function show(string $account_number): View
    {
        $customer = DB::table('customers')->where('account_number', $account_number)->first();
        return view('addOrEdit', ['customer' => $customer]);
    }
}
