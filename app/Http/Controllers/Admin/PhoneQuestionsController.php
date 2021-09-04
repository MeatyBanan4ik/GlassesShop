<?php

namespace App\Http\Controllers\Admin;

use App\Filters\PhoneQuestionFilter;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PhoneQuestionFilter $filter)
    {
        $phones = Question::filter($filter)->where('type', 'phone')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.phonequestions.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $phone = Question::find($id);
        if($phone->type != 'phone') {
            abort(404);
        }
        return view('admin.phonequestions.edit', compact('phone'));
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
        $phone = Question::find($id);
        $request->validate([
           'name' => 'required',
            'question' => 'required'
        ]);
        if($request->name == $phone->name and $request->question == $phone->question and $request->answer == $phone->answer){
            return redirect()->route('phonequestions.index');
        }
        $phone->update([
            'name' => $request->name,
            'question' => $request->question,
            'user_id' => Auth::user()->id,
            empty($request->answer) ? : 'answer' => $request->answer,
        ]);
        return redirect()->route('phonequestions.index')->with('success', 'Вы успешно сохранили данные по телефону '.$phone->number);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role == 'admin'){
            Question::destroy($id);
            return redirect()->route('phonequestions.index')->with('success', "Запрос на звонок с ID '.$id.' успешно удален");
        }
        abort(404);
    }
}
