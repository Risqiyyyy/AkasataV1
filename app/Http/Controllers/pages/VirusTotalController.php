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

  public $ipstack_key  = 'a7ebe91373cc99e5757a6cbe56fbe1b8';
  public $db_ip_key    = '12c465725c290a505c5e207e693bde5fd5ffa524';
  public $ipinfodb_key = 'fd1a31af56def272db96b0ec1b3dea8d18025f3d34e1abf8e64f7b525bd993e9';

  public function get_ip($ip)
  {
      if($resuls = $this->get_ip_1($ip)){
          return $resuls;
      }

      if($resuls = $this->get_ip_2($ip)){
          return $resuls;
      }

      if($resuls = $this->get_ip_3($ip)){
          return $resuls;
      }

      if($resuls = $this->get_ip_4($ip)){
          return $resuls;
      }
      
      return [];
  }

  public function get_ip_1($ip)
  {
      $results = [];
      
      $api_key = $this->ipstack_key;

      $client = new \GuzzleHttp\Client([
          'query' => [
              'access_key' => $api_key
          ]
      ]);

      try {
          $req = $client->get('http://api.ipstack.com/' . $ip);
      } catch (ClientException $e) {
          return $results;
      }

      if ($req->getStatusCode() == 200) {
          $response = $req->getBody()->getContents();
          $json = json_decode($response, true);

          if (!empty($json['country_name'])) {
              $results['ip']      = $json['ip'];
              $results['country'] = $json['country_name'];
              $results['state']   = $json['region_name'];
              $results['city']    = $json['city'];
              $results['source']  = 'api.ipapi.com';
          }
      }

      return $results;
  }

  public function get_ip_2($ip)
  {
      $results = [];

      $api_key = $this->db_ip_key;
      $client = new \GuzzleHttp\Client();

      try {
          $req = $client->get('https://api.db-ip.com/v2/' . $api_key . '/' . $ip);
      } catch (ClientException $e) {
          return $results;
      }

      if ($req->getStatusCode() == 200) {
          $response = $req->getBody()->getContents();
          $json = json_decode($response, true);

          if (!empty($json['countryName'])) {
              $results['ip']      = $json['ipAddress'];
              $results['country'] = $json['countryName'];
              $results['state']   = $json['stateProv'];
              $results['city']    = $json['city'];
              $results['source']  = 'api.db-ip.com';
          }
      }

      return $results;
  }

  public function get_ip_3($ip)
  {
      $results = [];

      $client = new \GuzzleHttp\Client();

      try {
          $req = $client->get('http://ip-api.com/json/' . $ip);
      } catch (ClientException $e) {
          return $results;
      }

      if ($req->getStatusCode() == 200) {
          $response = $req->getBody()->getContents();
          $json = json_decode($response, true);

          if (!empty($json['country'])) {
              $results['ip']      = $json['query'];
              $results['country'] = $json['country'];
              $results['state']   = $json['regionName'];
              $results['city']    = $json['city'];
              $results['source']  = 'ip-api.com';
          }
      }

      return $results;
  }

  public function get_ip_4($ip)
  {
      $results = [];

      $api_key = $this->ipinfodb_key;

      $client = new \GuzzleHttp\Client([
          'base_uri' => 'https://api.ipinfodb.com/v3/',
          'timeout'  => 10.0,
          'query' => [
              'key'    => $api_key,
              'ip'     => $ip,
              'format' => 'json'
          ]
      ]);

      try {
          $req = $client->get('ip-city');
      } catch (ClientException $e) {
          return $results;
      }

      if ($req->getStatusCode() == 200) {
          $response = $req->getBody()->getContents();
          $json = json_decode($response, true);

          if (!empty($json['countryName'])) {
              $results['ip']      = $json['ipAddress'];
              $results['country'] = $json['countryName'];
              $results['state']   = $json['regionName'];
              $results['city']    = $json['cityName'];
              $results['source']  = 'api.ipinfodb.com';
          }
      }

      return $results;
  }

  public function get_ip_5($ip)
  {
      $client = new Client();

      $response = $client->get('https://www.virustotal.com/api/v3/ip_addresses/' . $ip, [
          'headers' => [
              'x-apikey' => '1e0d9770ea979cc8091df00ee9eabbbde3f3ce26017d611e861ed9faddfb76b4',
          ],
      ]);

    $result = json_decode($response->getBody()->getContents(), true);
    return $result;
  }

  public function iphash(Request $request)
  {
      $client = new Client();
      $ip = $request->input('input');

      if (!$ip) {
        $result = ['error' => 'Masukan IP Address.'];
            return view('content.pages.VirusTotal', compact('result'));
        }

        $result1 = $this->get_ip_1($ip);
        $result5 = $this->get_ip_5($ip);
          dd($result1,$result5);
        return view('content.pages.VirusTotal', ['result' => $result1, $result5]);

  }
}
