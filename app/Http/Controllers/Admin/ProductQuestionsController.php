<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ProductQuestionFilter;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductQuestionFilter $filter)
    {
        $products = Question::filter($filter)->where('type', 'product')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.productquestions.index', compact('products'));
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
        $product = Question::find($id);
        if($product->type != 'product') {
            abort(404);
        }
        return view('admin.productquestions.edit', compact('product'));
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
        $product = Question::find($id);
        $request->validate([
           'answer' => 'required'
        ]);
        $product->update([
            'answer' => $request->answer,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('productquestions.index')->with('success', 'Вы успешно сохранили данные по запросу '.$id);
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
            return redirect()->route('productquestions.index')->with('success', "Вопрос с ID $id успешно удален");
        }
        abort(404);
    }

}
