<?php

namespace App\Http\Controllers\pages;
use App\Models\Endpoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EndpointController extends Controller
{
  public function index()
  {
    $endpoint = Endpoint::search(request('search'))->paginate(10);
    return view('content.pages.endpoint',compact('endpoint'));
  }

  public function store(Request $request)
    {

      $request->validate(Endpoint::$rules);
        Endpoint::create($request->all());
        return redirect()->route('endpoint.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function delete(Endpoint $id)
    {
      $id->delete();
      return redirect()->route('endpoint.index')->with('success','Event has been deleted successfully');
    }

}
