<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
  public function index()
  {
    $events = Events::all();
    // dd($events);
    return view('content.pages.events', compact('events'));
  }

  public function store(Request $request)
    {
        // $this->validate($request, [
        //   'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        // ]);
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('/image'), $imageName);

        Events::create([
          'title' => $request->title,
          'hostname' => $request->hostname,
          'tags' => $request->tags,
          'dst' => $request->dst,
          'src' => $request->src,
          'uuid' => $request->uuid,
          'image' => $imageName,
          'date_time' => $request->date_time,
          'deskripsi' => $request->deskripsi
        ]);

        // return redirect()->back();
        // dd($e);
        return redirect()->route('events.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
