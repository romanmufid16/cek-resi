<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function index () {
        $apiKey = "9ca666469640db0b043bcbdb9923301b70754281065c09b2777979bffb1c1bc2";
        $url = "https://api.binderbyte.com/v1/list_courier?api_key=$apiKey";
        $response = Http::get($url);
        $data = $response->object();
        
        return view('index', ['data' => $data]);
    }

    public function track (Request $request) {
        $request->validate([
            'courier' => 'required',
            'awb' => 'required',
        ]);

        $apiKey = "9ca666469640db0b043bcbdb9923301b70754281065c09b2777979bffb1c1bc2";
        $courier = $request->input('courier');
        $awb = $request->input('awb');
        $url = "https://api.binderbyte.com/v1/track?api_key=$apiKey&courier=$courier&awb=$awb";

        $response = Http::get($url);

        if ($response->successful()) {
            $resi = $response->object();
            return view('index', ['data' => $this->getCouriers(),'resi' => $resi]);
        } else {
            return back()->withErrors(['msg' => 'Gagal mengaambil data resi.']);
        }
    }

    // Fungsi untuk mendapatkan data ekspedisi
    private function getCouriers()
    {
        $apiKey = "9ca666469640db0b043bcbdb9923301b70754281065c09b2777979bffb1c1bc2";
        $url = "https://api.binderbyte.com/v1/list_courier?api_key=$apiKey";
        $response = Http::get($url);
        return $response->object();
    }
}
