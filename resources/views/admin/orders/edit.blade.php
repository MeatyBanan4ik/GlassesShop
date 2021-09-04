@extends('admin.layouts.layout')

@section('title')
    @parent Изменение Пользователя
@endsection

@section('content')
    <style>

        * {
            box-sizing: border-box;
        }
        #block p:hover{
            background: rgba(0,0,0, .2);
            cursor: pointer;
        }


    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Перезвонить</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Изменение заказа с ID {{$order->id }}</h3>
                        </div>
                        <!-- /.card-header -->

                        <form id="form" role="form" method="post" action="{{ route('orders.update', ['order' => $order->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Пользователь</label>
                                    <input type="text"
                                           class="form-control @error('id') is-invalid @enderror" id="id"
                                           placeholder="Пользователь" value="{{$order->user()->first()->name}}" disabled>
                                    <input type="text" name="id" hidden id="userinput" value="{{$order->user_id}}">
                                </div>
                                <div id="userblock" class="mt-2"></div>
                                <div></div>
                                <div class="form-group">
                                    <label for="address">Адрес доставки</label>
                                    <input type="text" name="address"
                                           class="form-control @error('address') is-invalid @enderror" id="address"
                                           placeholder="Адрес" value="{{ $order->address }}">
                                </div>
                                <div class="form-group">
                                    <label for="comm">Комментарий к доставке</label>
                                    <textarea type="text" name="comm"
                                              class="form-control @error('comm') is-invalid @enderror" id="comm"
                                              placeholder="Комментарий">{{$order->commentary}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="payment">Оплата</label>
                                    <select class="form-control @error('payment') is-invalid @enderror" id="payment" name="payment">
                                        <option value="">Выберите тип оплаты</option>
                                        <option value="card" @if($order->payment == 'card') selected @endif>Картой</option>
                                        <option value="cash" @if($order->payment == 'cash') selected @endif>Наличными при получении</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Статус</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="">Выберите статус</option>
                                        <option value="w_processing" @if($order->status == 'w_processing') selected @endif>Ждет обработки</option>
                                        <option value="w_dispatch" @if($order->status == 'w_dispatch') selected @endif>Ждет отправки</option>
                                        <option value="submitted" @if($order->status == 'submitted') selected @endif>Отправлено</option>
                                        <option value="w_receipt" @if($order->status == 'w_receipt') selected @endif>Ждет получения</option>
                                        <option value="received" @if($order->status == 'received') selected @endif>Получено</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="products">Товары:</label>
                                    <input type="text"
                                           class="form-control @error('products') is-invalid @enderror" id="products"
                                           placeholder="Товары">
                                    <div id="block" class="mt-2"></div>
                                </div>
                                <div id="product">
                                    <ol>
                                        @foreach($order->products as $product)
                                            @php
                                                if(\App\Models\Product::where('id', $product->id)->first()->category === 'lenses') {
                                                    $param = \Illuminate\Support\Facades\DB::table('lenses')->where('product_id', $product->id)->first();
                                                    $parameters = (array) json_decode(\Illuminate\Support\Facades\DB::table('order_product')->where('order_id', $order->id)->where('product_id', $product->id)->first()->parameters);
                                                    $keys = array_keys($parameters);
                                                }
                                            @endphp
                                            <li class="mt-1" data-id="{{$product->id}}" data-category="{{\App\Models\Product::where('id', $product->id)->first()->category}}" data-price="{{\Illuminate\Support\Facades\DB::select('SELECT product_price FROM order_product WHERE order_id = ? and product_id = ?', [$order->id, $product->id])[0]->product_price}}">
                                                {{$product->vendor_code}} {{$product->category}} {{$product->brand}} {{$product->name}} {{\Illuminate\Support\Facades\DB::select('SELECT product_price FROM order_product WHERE order_id = ? and product_id = ?', [$order->id, $product->id])[0]->product_price}} UAH <br>Количество: <input type="number" min="1" value="{{\Illuminate\Support\Facades\DB::select('SELECT count FROM order_product WHERE order_id = ? and product_id = ?', [$order->id, $product->id])[0]->count}}" style="width: 50px"><br>@if(\App\Models\Product::where('id', $product->id)->first()->category == 'lenses')<span class="ratio" data-id="{{$product->id}}"><input data-id="{{$product->id}}" @if(mb_strpos($keys[0], 'глаза') === false) checked @endif type="radio" id="one_eye"> Одинаковые галаза <input @if(mb_strpos($keys[0], 'глаза') !== false) checked @endif  data-id="{{$product->id}}" type="radio" id="two_eye"> Разные глаза </span><br><span class="additional-js" data-id="{{$product->id}}" data-diopters='{{$param->diopters}}' data-cylinder="{{$param->cylinder}}" data-curvature="{{$param->curvature}}" data-axis="{{$param->axis}}">
                                                    @if(mb_strpos($keys[0], 'глаза') === false)
                                                        @if(((array) json_decode($param->diopters))[0])Диоптрий: <select name="diopters"> @foreach(json_decode($param->diopters) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Диоптрий'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        @if(((array) json_decode($param->cylinder))[0])Цилиндр: <select name="cylinder"> @foreach(json_decode($param->cylinder) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Цилиндр'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        @if(((array) json_decode($param->curvature))[0])Радиус кривизны: <select name="curvature"> @foreach(json_decode($param->curvature) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Радиус кривизны'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        @if(((array) json_decode($param->axis))[0])Ось: <select name="axis"> @foreach(json_decode($param->axis) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Ось'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                    @else
                                                        <b>Правый глаз:</b><br>
                                                        @if(((array) json_decode($param->diopters))[0])Диоптрий: <select name="diopters_r"> @foreach(json_decode($param->diopters) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Диоптрий правого глаза'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        @if(((array) json_decode($param->cylinder))[0])Цилиндр: <select name="cylinder_r"> @foreach(json_decode($param->cylinder) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Цилиндр правого глаза'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        @if(((array) json_decode($param->curvature))[0])Радиус кривизны: <select name="curvature_r"> @foreach(json_decode($param->curvature) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Радиус кривизны правого глаза'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        @if(((array) json_decode($param->axis))[0])Ось: <select name="axis_r"> @foreach(json_decode($param->axis) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Ось правого глаза'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        <br><b>Левый Глаз</b><br>
                                                        @if(((array) json_decode($param->diopters))[0])Диоптрий: <select name="diopters_l"> @foreach(json_decode($param->diopters) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Диоптрий левого глаза'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        @if(((array) json_decode($param->cylinder))[0])Цилиндр: <select name="cylinder_l"> @foreach(json_decode($param->cylinder) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Цилиндр левого глаза'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        @if(((array) json_decode($param->curvature))[0])Радиус кривизны: <select name="curvature_l"> @foreach(json_decode($param->curvature) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Радиус кривизны левого глаза'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                        @if(((array) json_decode($param->axis))[0])Ось: <select name="axis_l"> @foreach(json_decode($param->axis) as $item) <option value="{{$item}}" @if($item == +trim($parameters['Ось левого глаза'])) selected @endif>{{$item}}</option> @endforeach</select> @endif
                                                    @endif
                                                </span> <br>@endif <span data-id="{{$product->id}}" style="cursor: pointer; text-decoration: underline;">Удалить</span> </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" id="btn">Сохранить</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-primary">Назад</a>
                            </div>

                        </form>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <!-- /.content -->
@endsection
@section('script')
            <script>
                let input = document.querySelector('#products')
                input.oninput = (event) => {
                    if(event.target.value && event.target.value.length > 1){
                        $.ajax({
                            url: "{{route('getproducts')}}/"+input.value,
                            cache: false,
                            success: (data) => {
                                const products = JSON.parse(data)
                                document.querySelector('#block').innerHTML = ''
                                let html = products.map(i => `<p data-id='${i.id}' data-vendor='${i.vendor_code}' data-diopters='${i.diopters}' data-cylinder='${i.cylinder}' data-axis='${i.axis}' data-curvature='${i.curvature}' data-name='${i.name}' data-category='${i.category}' data-brand='${i.brand}' data-price='${i.price}'>${i.vendor_code} ${i.category} ${i.brand}  ${i.name}  ${i.price} UAH</p>`).join(' ')
                                document.querySelector('#block').innerHTML = html
                            }
                        })
                    }
                    else {
                        document.querySelector('#block').innerHTML = ''
                    }

                }
                document.querySelector('#block').addEventListener('click', (event) => {
                    if(event.target.dataset.hasOwnProperty('id')){
                        if(document.querySelector(`#product>ol>li[data-id="${event.target.dataset.id}"]>input`) === null) {
                            document.querySelector('#product>ol').insertAdjacentHTML('beforeend', `<li class="mt-1" data-id="${event.target.dataset.id}" data-price="${event.target.dataset.price}" data-category="${event.target.dataset.category}">${event.target.dataset.vendor} ${event.target.dataset.category} ${event.target.dataset.brand} ${event.target.dataset.name} ${event.target.dataset.price} UAH <br> Количество: <input type="number" min="1" value="1" style="width: 50px">`+ checkType(event.target) +` <span data-id="${event.target.dataset.id}" style="cursor: pointer; text-decoration: underline;">Удалить</span> </li>`)
                        }
                        else {
                            document.querySelector(`#product>ol>li[data-id="${event.target.dataset.id}"]>input`).value = +document.querySelector(`#product>ol>li[data-id="${event.target.dataset.id}"]>input`).value + 1
                        }
                        document.querySelector('#block').innerHTML = ''
                        input.value = ''
                    }
                })

                document.querySelector('#product').addEventListener('click', (event) => {
                    if(event.target.textContent === 'Удалить') {
                        document.querySelector(`#product>ol>li[data-id="${event.target.dataset.id}"]`).remove()
                    }
                    if (event.target.tagName.toLowerCase() === 'input') {
                        const elem = document.querySelector(`.additional-js[data-id="${event.target.dataset.id}"]`)
                        const diopters = JSON.parse(elem.dataset.diopters)
                        const cylinder = JSON.parse(elem.dataset.cylinder)
                        const curvature = JSON.parse(elem.dataset.curvature)
                        const axis = JSON.parse(elem.dataset.axis)
                        html = ''
                        if (event.target.id === 'two_eye') {
                            html += '<b>Правый глаз:</b><br>'
                            if(diopters[0].trim()) {
                                html += ' Диоптрий: <select name="diopters_r">'
                                html += diopters.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            if(cylinder[0].trim()) {
                                html += ' Цилиндр: <select name="cylinder_r">'
                                html += cylinder.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            if(curvature[0].trim()) {
                                html += ' Радиус кривизны: <select name="curvature_r">'
                                html += curvature.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            if(axis[0].trim()) {
                                html += ' Ось: <select name="axis_r">'
                                html += axis.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            html += '<br><b>Левый глаз:</b><br>'
                            if(diopters[0].trim()) {
                                html += ' Диоптрий: <select name="diopters_l">'
                                html += diopters.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            if(cylinder[0].trim()) {
                                html += ' Цилиндр: <select name="cylinder_l">'
                                html += cylinder.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            if(curvature[0].trim()) {
                                html += ' Радиус кривизны: <select name="curvature_l">'
                                html += curvature.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            if(axis[0].trim()) {
                                html += ' Ось: <select name="axis_l">'
                                html += axis.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            document.querySelector(`#one_eye[data-id="${event.target.dataset.id}"]`).checked = false
                            elem.innerHTML = ''
                            elem.insertAdjacentHTML('afterbegin', html)
                        }

                        if (event.target.id === 'one_eye') {
                            if(diopters[0].trim()) {
                                html += ' Диоптрий: <select name="diopters">'
                                html += diopters.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            if(cylinder[0].trim()) {
                                html += ' Цилиндр: <select name="cylinder">'
                                html += cylinder.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            if(curvature[0].trim()) {
                                html += ' Радиус кривизны: <select name="curvature">'
                                html += curvature.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }
                            if(axis[0].trim()) {
                                html += ' Ось: <select name="axis">'
                                html += axis.map(i => `<option value="${i}">${i}</option>`).join(' ')
                                html += '</select>'
                            }

                            document.querySelector(`#two_eye[data-id="${event.target.dataset.id}"]`).checked = false
                            elem.innerHTML = ''
                            elem.insertAdjacentHTML('afterbegin', html)
                        }
                    }
                })

                document.querySelector('#btn').addEventListener('click', (event) => {
                    const products = document.querySelectorAll('#product>ol>li')
                    if(products.length > 0) {
                        let productsInput = []
                        for (i = 0; i < products.length; i++) {
                            let param = {}
                            if (products[i].dataset.category === 'lenses'){
                                if (products[i].childNodes[5].childNodes[0].checked) {
                                    document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='diopters']`)
                                    param = {
                                        diopters: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='diopters']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='diopters']`).value : null,
                                        cylinder: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='cylinder']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='cylinder']`).value : null,
                                        curvature: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='curvature']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='curvature']`).value : null,
                                        axis: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='axis']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='axis']`).value : null,
                                    }

                                }

                                if (products[i].childNodes[5].childNodes[2].checked) {
                                    param = {
                                        diopters_r: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='diopters_r']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='diopters_r']`).value : null,
                                        cylinder_r: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='cylinder_r']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='cylinder_r']`).value : null,
                                        curvature_r: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='curvature_r']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='curvature_r']`).value : null,
                                        axis_r: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='axis_r']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='axis_r']`).value : null,
                                        diopters_l: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='diopters_l']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='diopters_l']`).value : null,
                                        cylinder_l: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='cylinder_l']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='cylinder_l']`).value : null,
                                        curvature_l: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='curvature_l']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='curvature_l']`).value : null,
                                        axis_l: document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='axis_l']`) ? document.querySelector(`.additional-js[data-id='${products[i].dataset.id}']`).querySelector(`select[name='axis_l']`).value : null,
                                    }
                                }
                                for (var key in param) {
                                    if(param[key] === null){
                                        delete param[key]
                                    }
                                }
                            }
                            productsInput.push({id: products[i].dataset.id, count: products[i].childNodes[3].value, price: products[i].dataset.price, parameters: {...param} })
                        }
                        const value = JSON.stringify(productsInput)
                        document.querySelector('#form').insertAdjacentHTML('beforeend', `<input hidden value='${value}' name="products">`)
                    }
                })

                function checkType(element) {
                    let text = `<br>`
                    if(element.dataset.category === 'lenses') {
                        let diopters = JSON.parse(element.dataset.diopters)
                        let cylinder = JSON.parse(element.dataset.cylinder)
                        let curvature = JSON.parse(element.dataset.curvature)
                        let axis = JSON.parse(element.dataset.axis)
                        text += `<span class="ratio" data-id="${element.dataset.id}"><input data-id="${element.dataset.id}" type="radio" id='one_eye' checked> Одинаковые глаза <input data-id="${element.dataset.id}" type="radio" id='two_eye'> Разные глаза</span> <br> <span class="additional-js" data-diopters='${element.dataset.diopters}' data-cylinder='${element.dataset.cylinder}' data-curvature='${element.dataset.curvature}' data-axis='${element.dataset.axis}'  data-id="${element.dataset.id}">`
                        if(diopters[0].trim()) {
                            text += ' Диоптрий: <select name="diopters">'
                            text += diopters.map(i => `<option value="${i}">${i}</option>`).join(' ')
                            text += '</select>'
                        }
                        if(cylinder[0].trim()) {
                            text += ' Цилиндр: <select name="cylinder">'
                            text += cylinder.map(i => `<option value="${i}">${i}</option>`).join(' ')
                            text += '</select>'
                        }
                        if(curvature[0].trim()) {
                            text += ' Радиус кривизны: <select name="curvature">'
                            text += curvature.map(i => `<option value="${i}">${i}</option>`).join(' ')
                            text += '</select>'
                        }
                        if(axis[0].trim()) {
                            text += ' Ось: <select name="axis">'
                            text += axis.map(i => `<option value="${i}">${i}</option>`).join(' ')
                            text += '</select>'
                        }
                        text += `</span> <br>`
                    }
                    return text
                }
            </script>
@endsection
