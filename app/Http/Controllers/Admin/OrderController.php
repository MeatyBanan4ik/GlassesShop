<?php

namespace App\Http\Controllers\Admin;

use App\Filters\OrderFilter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderFilter $filter)
    {
        $orders = Order::filter($filter)->where('status', '!=', 'in_cart')->orderByDesc('orders.created_at')->paginate(10);
        $options = DB::select('SELECT product_price, parameters FROM order_product');
        return view('admin.orders.index', compact('orders', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'products' => 'required',
            'status' => 'required',
            'payment' => 'required',
            'address' => 'required',
        ]);
        $order = Order::create([
            'user_id' => $request->id,
            'status' => $request->status,
            'payment' => $request->payment,
            'commentary' => $request->comm,
            'address' => $request->address
        ]);
        $products = json_decode($request->products);
        foreach($products as $product){
            $product->parameters = (array) $product->parameters;
            if(array_key_exists('parameters', $product)){
                if(array_key_exists('diopters', $product->parameters)){
                    $product->parameters['Диоптрий'] = $product->parameters['diopters'];
                    unset($product->parameters['diopters']);
                }
                if(array_key_exists('cylinder', $product->parameters)){
                    $product->parameters['Цилиндр'] = $product->parameters['cylinder'];
                    unset($product->parameters['cylinder']);
                }
                if(array_key_exists('curvature', $product->parameters)){
                    $product->parameters['Радиус кривизны'] = $product->parameters['curvature'];
                    unset($product->parameters['curvature']);
                }
                if(array_key_exists('axis', $product->parameters)){
                    $product->parameters['Ось'] = $product->parameters['axis'];
                    unset($product->parameters['axis']);
                }
                if(array_key_exists('diopters_r', $product->parameters)){
                    $product->parameters['Диоптрий правого глаза'] = $product->parameters['diopters_r'];
                    unset($product->parameters['diopters_r']);
                }
                if(array_key_exists('diopters_l', $product->parameters)){
                    $product->parameters['Диоптрий левого глаза'] = $product->parameters['diopters_l'];
                    unset($product->parameters['diopters_l']);
                }
                if(array_key_exists('cylinder_r', $product->parameters)){
                    $product->parameters['Цилиндр правого глаза'] = $product->parameters['cylinder_r'];
                    unset($product->parameters['cylinder_r']);
                }
                if(array_key_exists('cylinder_l', $product->parameters)){
                    $product->parameters['Цилиндр левого глаза'] = $product->parameters['cylinder_l'];
                    unset($product->parameters['cylinder_l']);
                }
                if(array_key_exists('curvature_r', $product->parameters)){
                    $product->parameters['Радиус кривизны правого глаза'] = $product->parameters['curvature_r'];
                    unset($product->parameters['curvature_r']);
                }
                if(array_key_exists('curvature_l', $product->parameters)){
                    $product->parameters['Радиус кривизны левого глаза'] = $product->parameters['curvature_l'];
                    unset($product->parameters['curvature_l']);
                }
                if(array_key_exists('axis_r', $product->parameters)){
                    $product->parameters['Ось правого глаза'] = $product->parameters['axis_r'];
                    unset($product->parameters['axis_r']);
                }
                if(array_key_exists('axis_l', $product->parameters)){
                    $product->parameters['Ось левого глаза'] = $product->parameters['axis_l'];
                    unset($product->parameters['axis_l']);
                }
            }
            DB::table('order_product')->insert([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'count' => $product->count,
                'product_price' => $product->price,
                'parameters' => array_key_exists('parameters', $product) ? json_encode($product->parameters, JSON_UNESCAPED_UNICODE) : null
            ]);
        }
        return redirect()->route('orders.index')->with(['success'=>'Заказ успешно создан']);

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
        $order = Order::find($id);
        return view('admin.orders.edit', compact('order'));
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
        $request->validate([
            'id' => 'required',
            'products' => 'required',
            'status' => 'required',
            'payment' => 'required',
            'address' => 'required',
        ]);
        Order::find($id)->update([
            'status' => $request->status,
            'payment' => $request->payment,
            'commentary' => $request->comm,
            'address' => $request->address
        ]);
        $products = json_decode($request->products);
        foreach($products as $product) {
            $product->parameters = (array)$product->parameters;
            if (array_key_exists('parameters', $product)) {
                if (array_key_exists('diopters', $product->parameters)) {
                    $product->parameters['Диоптрий'] = $product->parameters['diopters'];
                    unset($product->parameters['diopters']);
                }
                if (array_key_exists('cylinder', $product->parameters)) {
                    $product->parameters['Цилиндр'] = $product->parameters['cylinder'];
                    unset($product->parameters['cylinder']);
                }
                if (array_key_exists('curvature', $product->parameters)) {
                    $product->parameters['Радиус кривизны'] = $product->parameters['curvature'];
                    unset($product->parameters['curvature']);
                }
                if (array_key_exists('axis', $product->parameters)) {
                    $product->parameters['Ось'] = $product->parameters['axis'];
                    unset($product->parameters['axis']);
                }
                if (array_key_exists('diopters_r', $product->parameters)) {
                    $product->parameters['Диоптрий правого глаза'] = $product->parameters['diopters_r'];
                    unset($product->parameters['diopters_r']);
                }
                if (array_key_exists('diopters_l', $product->parameters)) {
                    $product->parameters['Диоптрий левого глаза'] = $product->parameters['diopters_l'];
                    unset($product->parameters['diopters_l']);
                }
                if (array_key_exists('cylinder_r', $product->parameters)) {
                    $product->parameters['Цилиндр правого глаза'] = $product->parameters['cylinder_r'];
                    unset($product->parameters['cylinder_r']);
                }
                if (array_key_exists('cylinder_l', $product->parameters)) {
                    $product->parameters['Цилиндр левого глаза'] = $product->parameters['cylinder_l'];
                    unset($product->parameters['cylinder_l']);
                }
                if (array_key_exists('curvature_r', $product->parameters)) {
                    $product->parameters['Радиус кривизны правого глаза'] = $product->parameters['curvature_r'];
                    unset($product->parameters['curvature_r']);
                }
                if (array_key_exists('curvature_l', $product->parameters)) {
                    $product->parameters['Радиус кривизны левого глаза'] = $product->parameters['curvature_l'];
                    unset($product->parameters['curvature_l']);
                }
                if (array_key_exists('axis_r', $product->parameters)) {
                    $product->parameters['Ось правого глаза'] = $product->parameters['axis_r'];
                    unset($product->parameters['axis_r']);
                }
                if (array_key_exists('axis_l', $product->parameters)) {
                    $product->parameters['Ось левого глаза'] = $product->parameters['axis_l'];
                    unset($product->parameters['axis_l']);
                }
            }
        }
        foreach($products as $product) {
            $order_product = DB::table('order_product')->where('order_id', $id)->where('product_id', $product->id)->first();
            if($order_product){
                DB::table('order_product')->where('id', $order_product->id)->update([
                   'count' =>  $product->count,
                    'parameters' => array_key_exists('parameters', $product) ? json_encode($product->parameters, JSON_UNESCAPED_UNICODE) : null
                ]);
            }
            else {
                DB::table('order_product')->insert([
                    'product_id' => $product->id,
                    'order_id' => $id,
                    'count' => $product->count,
                    'product_price' => $product->price,
                    'parameters' => array_key_exists('parameters', $product) ? json_encode($product->parameters, JSON_UNESCAPED_UNICODE) : null
                ]);
            }
        }
        $ids = [];
        foreach ($products as $product){
            $ids[] = $product->id;
        }
        DB::table('order_product')->where('order_id', $id)->whereNotIn('product_id', $ids)->delete();
        return redirect()->route('orders.index')->with(['success'=>'Заказ успешно изменен']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        DB::table('order_product')->where('order_id', $id)->delete();
        return redirect()->route('orders.index')->with(['success'=>'Заказ успешно удален']);
    }
}
