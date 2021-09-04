<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Europe/Kiev');
        $request->validate([
            'text' => 'required',
            'time' => 'required|date|after_or_equal:now'
        ]);
        DB::table('to_do_list')->insert([
           'text' => $request->text,
           'time' => $request->time
        ]);
        return redirect()->route('admin.index')->with(['success' => 'Задание успешно создано']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = DB::table('to_do_list')->find($id);
        $task->time = new \DateTime($task->time);
        $task->time = $task->time->format('Y-m-d\TH:i');
        return view('admin.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Europe/Kiev');
        $task = DB::table('to_do_list')->find($id);
        $task->time = new \DateTime($task->time);
        $task->time = $task->time->format('Y-m-d H:i');
        if((new \DateTime($request->time))->format('Y-m-d H:i') != $task->time) {
            $request->validate([
                'text' => 'required',
                'time' => 'required|date|after_or_equal:now'
            ]);
        }
        else {
            $request->validate([
                'text' => 'required'
            ]);
        }
        DB::table('to_do_list')->where('id', $id)->update([
            'time' => $request->time,
            'text' => $request->text
        ]);
        return redirect()->route('admin.index')->with(['success' => 'Задание успешно изменено']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
