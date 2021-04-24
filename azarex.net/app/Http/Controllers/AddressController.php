<?php


namespace App\Http\Controllers;


use App\Models\Address;

class AddressController extends Controller
{
    public function index(){
        $user = auth()->user();
        $items = Address::me()->latest()->paginate(15);
        return view('profile.address', compact('user', 'items'));
    }
}
