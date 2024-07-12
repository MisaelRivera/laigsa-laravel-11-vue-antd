<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Inertia\Inertia;

class ClientsController extends Controller
{
    public function index (Request $request)
    {
        $data = [
            'pageProp' => $request->has('page') ? $request->query('page'):1,
            'itemsProp' => $request->has('items') ? $request->query('items'):40,
            'pagesProp' => $request->has('pages') ? $request->query('pages'):10,
        ];
        $data['clientsProp'] = Client::orderBy('cliente')
            ->offset($data['page'] - 1)
            ->limit($data['items'])
            ->get();
        return Inertia::render('clients/Index');
    }
}
