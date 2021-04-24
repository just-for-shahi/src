<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Course\Course;
use App\Http\Controllers\Finance\Transaction;

class DashboardController extends Controller
{

    public function index(){
        $balance = auth()->user()->balance;
        $coursesNum = Course::where('user', auth()->id())->count();
        $transactionsSum = Transaction::where('user', auth()->id())->sum('amount');
        $courses = Course::where('user', auth()->id())->take(5)->get();
        return view('dashboard', [
            'balance' => $balance,
            'courses_num' => $coursesNum,
            'transactions_sum' => $transactionsSum,
            'courses' => $courses
        ]);
    }

}