<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{    

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {

        $customers = $request->user->customers;

        return response()->json($customers);
    }

    public function create(Request $request) {

        //validate
        $this->validate($request, [
           'firstname' => 'required',
           'lastname'  => 'required'
        ]);

        $customer = new Customer();

        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->user_id = $request->user->id;

        $customer->save();

        return response()->json($customer, 201);
    }
}