<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SPKController extends Controller
{
    public function filternospk()
    {
        $teks1 = "B05JM22";


        $regex = "/[A-Z]{2,5}+/";
        $hasil = [];

        preg_match_all($regex, $teks1, $hasil);

        # kembalikan data dalam bentuk json
        dd($hasil[0][0]);
    }
}