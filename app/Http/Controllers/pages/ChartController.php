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
        'json_file' => 'required|mimetypes:application/json|max:2048',
    ]);

        $jsonContent = file_get_contents($request->file('json_file')->path());
        $upload = Upload::create(['json_file' => $jsonContent]); 

        return redirect()->route('chart')->with('success', 'File berhasil diupload!');
    }

    public function getLastData()
    {
        $lastUpload = Upload::latest()->first();
          if ($lastUpload) {
            $json_file = $lastUpload->json_file;
            
            return response()->json([
              'json_file' => json_decode($json_file)
            ]);
          } else {
            return response()->json(['message' => 'Tidak ada data.']);
          }
    }

    public function getchart(){
      return view('content.pages.ssh');
    }
}
