<?php

namespace App\Http\Controllers;

use App\Models\Lens;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function React\Promise\Stream\first;

class MainController extends Controller
{
    public function index(){
        DB::statement('SET sql_mode = \'\'');
        $lenses = DB::select('select lenses.product_id, products.price, products.img, products.name from `lenses` left join `order_product` on `order_product`.`product_id` = `lenses`.`product_id` left join `products` on `products`.`id` = `lenses`.`product_id` WHERE products.in_stock = 1 group by `lenses`.`product_id` order by COUNT(lenses.product_id) desc limit 9');
        $frames = DB::select('select frames.product_id, products.price, products.img, products.name from `frames` left join `order_product` on `order_product`.`product_id` = `frames`.`product_id` left join `products` on `products`.`id` = `frames`.`product_id` WHERE products.in_stock = 1 group by `frames`.`product_id` order by COUNT(frames.product_id) desc limit 9');
        $glasses = DB::select('select glasses.product_id, products.price, products.img, products.name from `glasses` left join `order_product` on `order_product`.`product_id` = `glasses`.`product_id` left join `products` on `products`.`id` = `glasses`.`product_id` WHERE products.in_stock = 1 group by `glasses`.`product_id` order by COUNT(glasses.product_id) desc limit 9');
        $all = json_encode([
           'lenses' => $lenses,
           'frames' => $frames,
           'glasses' => $glasses
        ]);
        return view('index', compact('all'));
    }
    public function register(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect('/');
    }

    public function auth(Request $request){

        if(Auth::attempt($request->only('email', 'password'))){
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Неправильный логин или пароль');
    }

    public function showproduct(Request $request, $id)
    {

        $product = Product::find($id);


        if(isset($product))
        {
//            $commentary = $product->comm()->paginate(5);
            if($product->category == 'glasses')
            {
                $attributes = $product->glasses()->first();
                return view ('product', compact('product', 'attributes'));
            }
            elseif($product->category == 'lenses')
            {

                $attributes = $product->lens()->first();
                $diopters = json_decode($attributes->diopters);
                $cylinder = json_decode($attributes->cylinder);
                $curvature = json_decode($attributes->curvature);
                $axis = json_decode($attributes->axis);
                return view ('lense', compact('product', 'attributes', 'diopters', 'axis', 'cylinder', 'curvature'));
            }
            elseif($product->category == 'frames')
            {
                $attributes = $product->frame()->first();
                return view ('frame', compact('product', 'attributes'));
            }




        }
        abort('404');
    }

    public function store_order(Request $request)
    {
        $product = Product::find($request->product_id);
        $user_id = auth()->user()->id;
        $shopping = Order::where('status', '=', 'in_cart')->where('user_id', '=', $user_id)->first();
        if($shopping == NULL)
        {
            $shopping = Order::create([
                'user_id' => $user_id,
                'status' => 'in_cart'
            ]);
        }
        if($product->category == 'lenses')
        {
            $attributes = Lens::where('product_id', '=', $request->product_id)->first();
            if($request->type == 'one_eye') {

                $request->validate([
                    'diopters' => 'required',
                    'curvature' => 'required',
                    'count' => 'required'
                ]);
                if($attributes->axis != NULL and $attributes->axis != '[""]'){
                    $request->validate([
                        'axis' => 'required'
                    ]);
                }
                if($attributes->cylinder != NULL and $attributes->cylinder != '[""]') {
                    $request->validate([
                        'cylinder' => 'required'
                    ]);
                }

                $parameters = ([
                    'Диоптрий' => $request->diopters,
                    'Ось' => $request->axis,
                    'Цилиндр' => $request->cylinder,
                    'Радиус кривизны' => $request->curvature,
                ]);

                foreach($parameters as $key => $par)
                {
                    if($par == NULL)
                    {
                        unset($parameters[$key]);
                    }
                }
                $parameters = json_encode($parameters, JSON_UNESCAPED_UNICODE);

                DB::table('order_product')->insert([
                    'product_id' => $request->product_id,
                    'order_id' => $shopping->id,
                    'count' => $request->count,
                    'product_price' => $request->price,
                    'parameters' => $parameters,
                ]);
                return redirect()->route('product', ['id' => $request->product_id])->with('success', "Товар успешно добавлен в корзину");

            }
            elseif($request->type == 'two_eye')
            {
                $attributes = Lens::where('product_id', '=', $request->product_id)->first();

                $request->validate([
                    'r_diopters' => 'required',
                    'l_diopters' => 'required',
                    'r_curvature' => 'required',
                    'l_curvature' => 'required'
                ]);

                if($attributes->axis != NULL and $attributes->axis != '[""]'){
                    $request->validate([
                        'l_axis' => 'required',
                        'r_axis' => 'required'
                    ]);
                }
                if($attributes->cylinder != NULL and $attributes->cylinder != '[""]') {
                    $request->validate([
                        'r_cylinder' => 'required',
                        'l_cylinder' => 'required'
                    ]);
                }

                $parameters = ([
                    'Диоптрий правого глаза' => $request->r_diopters,
                    'Диоптрий левого глаза' => $request->l_diopters,
                    'Ось правого глаза' => $request->r_axis,
                    'Ось левого глаза' => $request->l_axis,
                    'Цилиндр правого глаза' => $request->r_cylinder,
                    'Цилиндр левого глаза' => $request->l_cylinder,
                    'Радиус кривизны правого глаза' => $request->r_curvature,
                    'Радиус кривизны левого глаза' => $request->r_curvature,
                ]);
                foreach($parameters as $key => $par)
                {
                    if($par == NULL)
                    {
                        unset($parameters[$key]);
                    }
                }
                $parameters = json_encode($parameters, JSON_UNESCAPED_UNICODE);
                DB::table('order_product')->insert([
                    'product_id' => $request->product_id,
                    'order_id' => $shopping->id,
                    'count' => $request->count,
                    'product_price' => $request->price,
                    'parameters' => $parameters,
                ]);
                return redirect()->route('product', ['id' => $request->product_id])->with('success', "Товар успешно добавлен в корзину");

            }
            else
            {
                abort('404');
            }
        }
        elseif($product->category == 'glasses' or $product->category == 'frames')
        {
            DB::table('order_product')->insert([
                'product_id' => $request->product_id,
                'order_id' => $shopping->id,
                'count' => '1',
                'product_price' => $request->price,
            ]);
            return redirect()->route('product', ['id' => $request->product_id])->with('success', "Товар успешно добавлен в корзину");
        }
    }

    public function oproduct(Request $request) {
        DB::table('order_product')->where('id', $request->id)->delete();
    }

    public function addinop(Request $request) {
        $ids = json_decode($request->json);
        foreach ($ids as $id => $count) {
            DB::table('order_product')->where('id', $id)->update(['count' => $count]);
        }

    }

    public function checkout() {
        try {
            $oproducts = DB::table('order_product')->where('order_id', (Order::where('user_id', Auth::user()->id)->where('status', 'in_cart')->first())->id)->get();
        }
        catch (Exception $e) {
            abort(404);
        }
        $order = Order::where('user_id', Auth::user()->id)->where('status', 'in_cart')->first();
        return view('checkout', compact('oproducts', 'order'));
    }

    public function create_order(Request $request) {
        Order::where('id', $request->order_id)->first()->update([
            'status' => 'w_processing',
            'payment' => $request->payment,
            'address' => $request->address,
            'commentary' => $request->commentary
        ]);
        DB::table('users')->where('id', Auth::user()->id)->update([
            'number' => $request->number
        ]);
        $products = DB::table('order_product')->where('order_id', $request->order_id)->get();
        foreach ($products as $product) {
            DB::table('order_product')->where('id', $product->id)->update([
                'product_price' => Product::where('id', $product->product_id)->first()->price,
            ]);
        }
        return redirect('/')->with('Заказ успешно создан');
    }

    public function ajaxsearchp(Request $request) {
        $result = Product::where('name', 'like', "%{$request->value}%")->limit(5)->get();
        if (count($result) == 0) {
            return '';
        }
        else {
            $html =
            "
            <div class='search-drop-list'>
                <div class='drop-in'>

                    <div class='search-res-catalog' style='overflow-y: auto; max-height: 380px;'>
                    <div class='search-res-tit' >
                        Вот что мы смогли найти:
                    </div>
            ";
            foreach ($result as $i) {
                $type = '';
                if ($i->category == 'lenses') {
                    $type = 'Контактные линзы';
                }
                if ($i->category == 'frames') {
                    $type = 'Оправа';
                }
                if ($i->category == 'glasses') {
                    $type = 'Солнцезащитные очки';
                }
                $html .=
                    "
                    <div class='search-item'>
                        <div class='search-item-thumb'>
                            <a href='".route('product', ['id' => $i->id])."'>
                                <img src='".asset('public/storage/'.$i->img)."' alt='{$type} {$i->name}'>
                            </a>
                        </div>
                        <div class='search-item-descr'>
                            <div class='search-item-tit'>
                                <a href='".route('product', ['id' => $i->id])."'>
                                   {$type} {$i->name}
                                </a>
                            </div>
                            <div class='search-item-price'>{$i->price} грн</div>
                        </div>
                    </div>
                    ";
            }
            $html .= "</div>

                    <div class='search-all-search'>
                        <a href='".route('search', ['name' => $request->value])."' class='def-big-bt'>
                            Все результаты
                        </a>
                    </div>
                    </div>
            </div>
           ";
            return $html;
        }
    }
}
