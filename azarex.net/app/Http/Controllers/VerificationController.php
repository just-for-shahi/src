<?php


namespace App\Http\Controllers;


use App\Models\Verification;
use Illuminate\Support\Facades\Route;

class VerificationController extends Controller
{

    public function index(){
        $user = auth()->user();
        $items = Verification::me()->latest()->paginate(15);
        return view('profile.verifications', compact('user', 'items'));
    }

}
