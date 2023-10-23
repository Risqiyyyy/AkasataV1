<?php

namespace App\Http\Controllers\pages;
use App\Models\Endpoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EndpointController extends Controller
{
  public function index()
  {
    $endpoint = Endpoint::all();
    return view('content.pages.endpoint',compact('endpoint'));
  }

  public function store(Request $request)
    {
        Endpoint::create([
          'hostname' => $request->hostname,
          'regional' => $request->regional,
          'ip' => $request->ip
        ]);

        return redirect()->route('endpoint.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function delete(Endpoint $id)
    {
      $id->delete();
      return redirect()->route('endpoint.index')->with('success','Event has been deleted successfully');
    }

}
