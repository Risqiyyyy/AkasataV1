<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UploadRdp;

class RdpChartController extends Controller
{
    public function index()
    {
        return view('content.pages.rdp');
    }

    public function store(Request $request)
    {
      $request->validate([
        'json_rdp' => 'required|mimetypes:application/json|max:2048', 
    ]);

        $jsonContent = file_get_contents($request->file('json_rdp')->path());
        $upload = UploadRdp::create(['json_rdp' => $jsonContent]); 

        return redirect()->route('rdp.index')->with('success', 'File berhasil diupload!');
    }

    public function getLastDatardp()
    {
        $lastUpload = UploadRdp::latest()->first();
          if ($lastUpload) {
            $json_file = $lastUpload->json_file;
            
            return response()->json([
              'json_file' => json_decode($json_file)
            ]);
          } else {
            return response()->json(['message' => 'Tidak ada data.']);
          }
    }

    public function getprintrdp(){
      return view('content.pages.ssh');
    }
}
