<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upload;

class ChartController extends Controller
{
  public function index()
  {
    return view('content.pages.chart');
  }
  
  public function store(Request $request)
    {
      $request->validate([
        'json_file' => 'required|mimetypes:application/json|max:2048', // Sesuaikan dengan kebutuhan
    ]);
        $jsonContent = file_get_contents($request->file('json_file')->path());
        $upload = Upload::create(['json_file' => json_encode($jsonContent)]); 

        return redirect()->route('chart')->with('success', 'File berhasil diupload!');
    }

    public function getLastData()
    {
        $lastUpload = Upload::latest()->first();

        return response()->json($lastUpload);
    }

    public function getchart(){
      return view('content.pages.ssh');
    }
}
