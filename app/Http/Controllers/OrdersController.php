<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function index ()
    {
        $orders = $orders =  Order::with(['muestras', 'cliente', 'siralab'])
        ->orderBy('fecha_recepcion', 'desc')
        ->orderBy('hora_recepcion', 'desc')
        ->orderBy('cesavedac', 'asc')
        ->orderBy('folio', 'desc')
        ->paginate(40);
        foreach ($orders as $order) {
            echo $order->aguas_alimentos . '<br><br>';
            foreach ($order->muestras as $muestra) {
                var_dump($order->muestras);
                echo '<br><br>';
                if ($order->aguas_alimentos === 'Aguas') {
                    var_dump($muestra);
                }
            }
        }
        die();
    }
}
