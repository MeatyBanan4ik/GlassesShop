<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(){
        $messages = Message::all();
        $orders = Order::orderByDesc('updated_at')->where('status', '!=', 'in_cart')->limit(9)->get();
        $list = DB::table('to_do_list')->orderBy('status')->orderByDesc('id')->paginate(10);
        return view('admin.index', compact('messages', 'orders', 'list'));
    }

    public function count_question(){
        $prod_count = Question::where('type', '=', 'product')->where('user_id', '=', NULL)->count();
        $phone_count= Question::where('type', '=', 'phone')->where('user_id', '=', NULL)->count();
        $all_count = Question::where('type', '=', 'all')->where('user_id', '=', NULL)->count();
        return json_encode(compact('prod_count', 'all_count', 'phone_count'));
    }

    public function getProducts($value) {
        $products = Product::where('name', 'like', '%'.$value.'%')->orWhere('id', $value)->orWhere('vendor_code', 'like', '%'.$value.'%')->limit(5)->get();
        foreach ($products as $product) {
            if ($product->category == 'lenses') {
                $lens = DB::table('lenses')->where('product_id', $product->id)->first();
                $product->diopters = $lens->diopters;
                $product->cylinder = $lens->cylinder;
                $product->axis = $lens->axis;
                $product->curvature = $lens->curvature;
            }
        }
        return json_encode($products);
    }

    public function getProductInfo($id) {
        return json_encode(Product::where('id', $id)->first());
    }

    public function getUsers(Request $request) {
        return json_encode(User::where('name', 'like', '%'.$request->user.'%')->orWhere('number', 'like', '%'.$request->user.'%')->orWhere('email', 'like', '%'.$request->user.'%')->limit(5)->get());
    }

    public function TaskCheck(Request $request) {
        if($request->check != 'false'){
            DB::table('to_do_list')->where('id', $request->id)->update(
                ['status' => 1]
            );
        }
        else {
            DB::table('to_do_list')->where('id', $request->id)->update(
                ['status' => 0]
            );
        }

    }

    public function TaskDelete(Request $request) {
        if (Auth::user()->role == 'admin') {
            DB::table('to_do_list')->where('id', $request->id)->delete();
        }
    }

    public function contact() {
        $contact = DB::table('contacts')->first();
        if ($contact) {
            $contact->supports_graph = str_replace('<br>', "\n", $contact->supports_graph);
        }
        else {
            DB::table('contacts')->insert([
               'number'=> null,
                'supports_graph' => null,
                'instagram' => null,
                'facebook' => null
            ]);
            $contact = DB::table('contacts')->first();
        }
        return view('admin.contacts', compact('contact'));
    }

    public function edit_contact   (Request $request) {
        $supports_graph = str_replace("\n",'<br>', str_replace("\r\n",'<br>' , $request->supports_graph));
        DB::table('contacts')->updateOrInsert(['id' => 1], ['supports_graph' => trim($supports_graph) != '' ? $supports_graph : null, 'number' => trim($request->number) != '' ? $request->number : null, 'instagram' => trim($request->instagram) != '' ? $request->instagram : null, 'facebook' => trim($request->facebook) != '' ? $request->facebook : null]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }



}

