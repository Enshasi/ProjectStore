<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        // $this->middleware(['auth'])->except('index')
        // $this->middleware(['auth'])->only('index')
    }
   public function index(){

    $order_pending = Order::where('status' , 'pending')->count();
    $order_processing = Order::where('status' , 'processing')->count();
    $order_completed = Order::where('status' , 'completed')->count();
    $order_delivering = Order::where('status' , 'delivering')->count();
    $payment_pending = Payment::where('status' , 'pending')->count();
    $payment_completed = Payment::where('status' , 'completed')->count();
    $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 300, 'height' => 200])
        ->labels(['Pending', 'processing' ,'completed' , 'delivering'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB' , '#63b47b' ,'#eb65d0'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB' , '#63b47b','#eb65d0'],
                'data' => [$order_pending, $order_processing,$order_completed,$order_delivering]
            ]
        ])
        ->options([]);

        $chartjs2 =app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Payments Status'])
        ->datasets([
            [
                "label" => "Payment Pending",
                'backgroundColor' => ['#6639b7'],
                'data' => [$payment_pending ]
            ],
            [
                "label" => "Payment Completed",
                'backgroundColor' => [ '#ffb900'],
                'data' => [ $payment_completed]

            ],

        ])
        ->options([]);

        return view('dashboard.dashboard' , compact('chartjs' , 'chartjs2'));
   }
}
