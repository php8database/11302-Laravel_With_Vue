<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events=Event::all();
        return Inertia::render('Welcome', ['events' => $events]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event=new Event();
        $event->event=$request->event;
        $event->save();
        return redirect()->route('home');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event=Event::find($id);
        $event->event=$request->event;
        $event->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::destroy($id);
        
    }
}
