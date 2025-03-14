<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events=Event::all();
        return Inertia::render('Welcome', ['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 驗證請求中的 event 欄位
        $request->validate([
            'event' => 'required|string|max:255',  // 確保 event 欄位是必填的並且長度不超過 255 字符
        ]); //禁止未輸入資料，空按新增送出！
        
        //dd($request->all());
        $event=new Event;  // 創建新的事件實例並填充資料
        $event->event=$request->event;  // 這裡的 $request->event 是從表單或請求獲取的值
        $event->save();  // 儲存到資料庫

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Event::where('id',$id)->update(['event'=>$request->event]);
        $event=EVENT::find($id);
        $event->event=$request->event;
        $event->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Event::destroy($id);
    }
}