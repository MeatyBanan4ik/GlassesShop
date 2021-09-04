<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frame;
use App\Models\Glasses;
use App\Models\Lens;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'vendor_code' => 'required|unique:products',
            'price' => 'required',
            'brand' => 'required',
            'in_stock' => ['required', Rule::in('1', '0')],
            'description' => 'required',
            'category' => ['required', Rule::in('glasses', 'frames', 'lenses')],
            'img' => 'required|image',
        ]);
        if($request->category == 'frames')
        {
            $request->validate([
                'sex' => 'required',
                'frame_shape' => 'required',
                'frame_material' => 'required',
                'bridge_size' => 'required',
                'eyepiece_size' => 'required',
                'temple_length' => 'required',
            ]);
        }
        elseif($request->category == 'lenses')
        {
            $request->validate([
                'purpose' => 'required',
                'diameter' => 'required',
                'center_thickness' => 'required',
                'material_type' => 'required',
                'is_uv' => ['required', Rule::in('1', '0')],
                'moisture' => 'required',
                'lens_material' => 'required',
                'oxygen_transmission' => 'required',
                'wearing_mode' => 'required',
                'replacement_mode' => 'required',
                'tinting' => 'required',
                'curvature' => 'required',
                'diopters' => 'required',
            ]);
        }
        elseif($request->category == 'glasses')
        {
            $request->validate([
                'sex' => 'required',
                'frame_shape' => 'required',
                'frame_material' => 'required',
                'bridge_size' => 'required',
                'eyepiece_size' => 'required',
                'temple_length' => 'required',
                'lens_color' => 'required',
                'polarization' => ['required', Rule::in('1', '0')],
                'mirror' => ['required', Rule::in('1', '0')],
                'gradient' => ['required', Rule::in('1', '0')],
                'lens_material' => 'required',

            ]);
        }

        $folder = date('Y-m-d');
        $img = $request->file('img')->store("assets/img/{$folder}", 'public');

        $data = Product::create([
            'name' => $request->name,
            'vendor_code' => $request->vendor_code,
            'price' => $request->price,
            'description' => $request->description,
            'brand' => $request->brand,
            'in_stock' => $request->in_stock,
            'category' => $request->category,
            'img' => $img
        ]);
        if($request->category == 'frames')
        {
            Frame::create([
                'product_id' => $data->id,
                'sex' => $request->sex,
                'frame_shape' => $request->frame_shape,
                'frame_material' => $request->frame_material,
                'bridge_size' => $request->bridge_size,
                'eyepiece_size' => $request->eyepiece_size,
                'temple_length' => $request->temple_length,


            ]);
        }
        elseif($request->category == 'lenses')
        {
            $diopters = explode(',', $request->diopters);
            $axis = explode(',', $request->axis);
            $cylinder = explode(',', $request->cylinder);
            $curvature = explode(',', $request->curvature);
            sort($diopters);
            sort($axis);
            sort($cylinder);
            sort($curvature);
            $diopters = json_encode($diopters);
            $axis = json_encode($axis);
            $cylinder = json_encode($cylinder);
            $curvature = json_encode($curvature);
            Lens::create([
                'product_id' => $data->id,
                'purpose' => $request->purpose,
                'diameter' => $request->diameter,
                'center_thickness' => $request->center_thickness,
                'material_type' => $request->material_type,
                'is_uv' => $request->is_uv,
                'moisture' => $request->moisture,
                'lens_material' => $request->lens_material,
                'oxygen_transmission' => $request->oxygen_transmission,
                'wearing_mode' => $request->wearing_mode,
                'replacement_mode' => $request->replacement_mode,
                'tinting' => $request->tinting,
                'diopters' => $diopters,
                'curvature' => $curvature,
                'axis' => $axis,
                'cylinder' => $cylinder

            ]);
        }
        elseif($request->category == 'glasses')
        {
            Glasses::create([
                'product_id' => $data->id,
                'sex' => $request->sex,
                'frame_shape' => $request->frame_shape,
                'frame_material' => $request->frame_material,
                'bridge_size' => $request->bridge_size,
                'eyepiece_size' => $request->eyepiece_size,
                'temple_length' => $request->temple_length,
                'lens_color' => $request->lens_color,
                'polarization' => $request->polarization,
                'mirror' => $request->mirror,
                'gradient' => $request->gradient,
                'lens_material' => $request->lens_material,
            ]);
        }
        return redirect('admin/products')->with('success', 'Product created');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if ($product->category == 'frames')
        {
            $prod = Frame::where('product_id', '=', $id)->first();

            return view('admin.products.edit', compact('product', 'prod'));
        }
        elseif ($product->category == 'lenses')
        {

            $prod = Lens::where('product_id', '=', $id)->first();
            $diopters = json_decode($prod->diopters);
            $cylinder = json_decode($prod->cylinder);
            $curvature = json_decode($prod->curvature);
            $axis = json_decode($prod->axis);

            return view('admin.products.edit', compact('product', 'prod', 'diopters', 'axis', 'cylinder', 'curvature'));
        }
        elseif ($product->category == 'glasses')
        {
            $prod = Glasses::where('product_id', '=', $id)->first();

            return view('admin.products.edit', compact('product', 'prod'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::find($id);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'in_stock' => ['required', Rule::in('1', '0')],
            'description' => 'required',
            'category' => [Rule::in('glasses', 'frames', 'lenses')],
        ]);

        if($product->category == 'frames')
        {
            $frame = Frame::where('product_id', '=', $id)->first();
            $request->validate([
                'sex' => 'required',
                'frame_shape' => 'required',
                'frame_material' => 'required',
                'bridge_size' => 'required',
                'eyepiece_size' => 'required',
                'temple_length' => 'required',
            ]);
            $frame->update($request->all());
        }
        elseif($product->category == 'lenses')
        {
            $lense = Lens::where('product_id', '=', $id)->first();
            $request->validate([
                'purpose' => 'required',
                'diameter' => 'required',
                'center_thickness' => 'required',
                'material_type' => 'required',
                'is_uv' => ['required', Rule::in('1', '0')],
                'moisture' => 'required',
                'lens_material' => 'required',
                'oxygen_transmission' => 'required',
                'wearing_mode' => 'required',
                'replacement_mode' => 'required',
                'tinting' => 'required',
                'curvature' => 'required',
                'diopters' => 'required',
            ]);
            $diopters = explode(',', $request->diopters);
            $axis = explode(',', $request->axis);
            $cylinder = explode(',', $request->cylinder);
            $curvature = explode(',', $request->curvature);
            sort($diopters);
            sort($axis);
            sort($cylinder);
            sort($curvature);
            $diopters = json_encode($diopters);
            $axis = json_encode($axis);
            $cylinder = json_encode($cylinder);
            $curvature = json_encode($curvature);
            $lense->update([
                'purpose' => $request->purpose,
                'diameter' => $request->diameter,
                'center_thickness' => $request->center_thickness,
                'material_type' => $request->material_type,
                'is_uv' => $request->is_uv,
                'moisture' => $request->moisture,
                'lens_material' => $request->lens_material,
                'oxygen_transmission' => $request->oxygen_transmission,
                'wearing_mode' => $request->wearing_mode,
                'replacement_mode' => $request->replacement_mode,
                'tinting' => $request->tinting,
                'diopters' => $diopters,
                'curvature' => $curvature,
                'axis' => $axis,
                'cylinder' => $cylinder
            ]);

        }
        elseif($product->category == 'glasses')
        {
            $glasses = Glasses::where('product_id', '=', $id)->first();
            $request->validate([
                'sex' => 'required',
                'frame_shape' => 'required',
                'frame_material' => 'required',
                'bridge_size' => 'required',
                'eyepiece_size' => 'required',
                'temple_length' => 'required',
                'lens_color' => 'required',
                'polarization' => ['required', Rule::in('1', '0')],
                'mirror' => ['required', Rule::in('1', '0')],
                'gradient' => ['required', Rule::in('1', '0')],
                'lens_material' => 'required',
            ]);
            $glasses->update($request->all());

        }
        $product->update($request->all());
        if($request->img != NULL)
        {   $request->validate([
            'img' => 'required|image',
        ]);
            $folder = date('Y-m-d');
            $file = $request->file('img')->store("assets/img/{$folder}", 'public');
            Product::where('id', '=', $id)->update(array('img' => $file));
        }

        return redirect()->route('products.index')->with('success', "Данные о продукте под id $id изменены");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $ptype = Product::find($id)->category;




        if($ptype == 'frames')
        {
            $frame_id = Frame::where('product_id', '=', $id)->first()->id;
            Frame::destroy($frame_id);
        }
        if($ptype == 'lenses')
        {
            $lens_id = Lens::where('product_id', '=', $id)->first()->id;
            Lens::destroy($lens_id);
        }
        if($ptype == 'glasses')
        {
            $frame_id = Glasses::where('product_id', '=', $id)->first()->id;
            Glasses::destroy($frame_id);

        }
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', 'Продукт удален');
    }
}
