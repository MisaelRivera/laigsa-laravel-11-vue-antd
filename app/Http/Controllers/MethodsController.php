<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MethodsController extends Controller
{
    //
    public function index ()
    {
        $methods = Method::limit(40)
            ->get();
        $data = [
            'methodsProp' => $methods,
            'totalItemsProp' => Method::count()
        ];

        return Inertia::render();
    }

    public function create ()
    {

    }

    public function store (Request $request)
    {

    }

    public function show (Request $request)
    {

    }

    public function edit ()
    {

    }

    public function update (Request $request)
    {

    }

    public function destroy (Request $request)
    {
        
    }
}
