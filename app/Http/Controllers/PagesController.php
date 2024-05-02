<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
    //
    public function index ()
    {
        return Inertia::render('Index', [
            'title' => 'Hi, is working',
            'backgroundUrl' => asset('img/background.jpg'),
        ]);
    }

    public function us ()
    {
        return Inertia::render('Nosotros', ['title' => 'This is Us']);
    }

    public function contact ()
    {
        return Inertia::render('Contacto', ['title' => 'Contacto']);
    }

    public function login ()
    {
        return Inertia::render('Login', ['title' => 'Login']);
    }
}
