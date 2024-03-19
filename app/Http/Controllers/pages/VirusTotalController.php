<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class VirusTotalController extends Controller
{
  public function index()
  {
    return view('content.pages.VirusTotal');
  }
  public function iphash(Request $request)
  {
      $client = new Client();
      $ip = $request->input('input');

      if (!$ip) {
        $result = ['error' => 'Masukan IP Address.'];
            return view('content.pages.VirusTotal', compact('result'));
    }

    $response = $client->get('https://www.virustotal.com/api/v3/ip_addresses/' . $ip, [
        'headers' => [
            'x-apikey' => '1e0d9770ea979cc8091df00ee9eabbbde3f3ce26017d611e861ed9faddfb76b4',
        ],
    ]);

    $result = json_decode($response->getBody()->getContents(), true);
    return view('content.pages.VirusTotal', ['result' => $result]);
  }
}
