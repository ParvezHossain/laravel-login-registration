<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    //
    public function index(){
        $flights = Flight::paginate(10);
        return view("flight.index", ['flights' => $flights]);
    }
}
