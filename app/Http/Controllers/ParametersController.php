<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameter;

class ParametersController extends Controller
{
    //
    public function index ()
    {
        $parameters = Parameter::limit(40)
            ->get();
    }

    public function create ()
    {

    }

    public function store ()
    {

    }

    public function edit ()
    {

    }

    public function update ()
    {

    }

}
