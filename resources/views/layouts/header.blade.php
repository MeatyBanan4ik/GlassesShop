<header class="header-desc">
    <!-- header top -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-menu">
                        <div class="header-top-menu">
                            <ul>
                                <li>
                                    <a href="/about/">О компании</a>
                                </li>
                                <li >
                                    <a href="/services/">Услуги</a>
                                </li>
                                <li>
                                    <a href="/delivery/">Доставка и оплата</a>
                                </li>
                                <li>
                                    <a href="/obmen-i-vozvrat/">Обмен и возврат</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="header-top-info">
                        <div class="your-city" id="city-selector">

                        </div>
                        <div class="header-lk">
                            @auth()
                                {{ \Illuminate\Support\Facades\Auth::user()->name }}
                            @endauth
                            @guest
                                    <a href="{{ url('/auth') }}">Войти</a>
                            @endguest
                        </div>
                        <div class="close-menu js-close-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="logo">
                        <a href="/">
                            <img width='160px' src="{{ asset('assets/img/logo.svg')}}" alt="">
                        </a>
                    </div>

                    <div class="header-phone">
                        @if(\Illuminate\Support\Facades\DB::table('contacts')->first() != null)
                            @if(\Illuminate\Support\Facades\DB::table('contacts')->first()->number != null)
                            <span>{{\Illuminate\Support\Facades\DB::table('contacts')->first()->number}}</span>
                            <a href="javascript:void(0);" class="b24-web-form-popup-btn-8">Перезвоните мне</a>
                            @endif
                        @endif
                    </div>
                    <style>
                        .search-res-catalog::-webkit-scrollbar {
                            width: 5px;
                            height: 5px;
                            background-color: transparent;
                        }
                        .search-res-catalog::-webkit-scrollbar-thumb {
                            border-radius: 10px;
                            background-color: #f5f2f7;
                        }
                        .search-res-catalog::-webkit-scrollbar-track {
                            border-radius: 5px;
                            background-color: transparent;
                        }
                    </style>
                    <div class="search">
                        <div class="search-in">
                            <form autocomplete="off" action="{{route('search')}}">
                                <input name="name" type="text" required="required" class= "search-input " placeholder="Поиск">
                                <button class="search-bt"></button>
                                <button type="reset" class="search-remove"></button>
                            </form>
                        </div>
                        <div class="search-check"></div>
                    </div>

                    <script>
                        function debounce(func, wait, immediate) {
                            var timeout
                            return function() {
                                var context = this, args = arguments
                                var later = function() {
                                    timeout = null
                                    if (!immediate) func.apply(context, args)
                                }
                                var callNow = immediate && !timeout
                                clearTimeout(timeout)
                                timeout = setTimeout(later, wait)
                                if (callNow) func.apply(context, args)
                            }
                        }

                        let func = debounce(searchf, 300)
                        function searchf(e) {
                            const value = e.target.value
                            if(value.trim() === '') {
                                document.querySelector('.search-check').innerHTML = ''
                            }
                            if(value.trim().length >= 3) {
                                $.ajax({
                                    url: '{{route('ajaxsearchp')}}',
                                    data: '&value=' + value,
                                    success: function (html) {
                                        document.querySelector('.search-check').innerHTML = html
                                    }
                                })
                            }
                            else {
                                document.querySelector('.search-check').innerHTML = ''
                            }
                        }
                        document.querySelector('.search-input').addEventListener('input', func)
                    </script>

                    <div class="record">
                        <a href="javascript:void(0);" class="def-big-bt">Запись к врачу</a>
                    </div>

                    <div class="fav-bask">
                        <div class="one-el" id="favorites-small">
                        </div>
                        @section('basket')
                        @auth()
                        <div id="small-basket" class="one-el">
                            <a href="#" class="bask-link">
                                @if(\App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('status', 'in_cart')->first() != null and \Illuminate\Support\Facades\DB::table('order_product')->where('order_id', \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('status', 'in_cart')->first()->id)->count() > 0)
                                    @php $products = (\Illuminate\Support\Facades\DB::table('order_product')->where('order_id', (\App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('status', 'in_cart')->first()->id)))->get() @endphp
                                    <i>{{\Illuminate\Support\Facades\DB::table('order_product')->where('order_id', \App\Models\Order::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('status', 'in_cart')->first()->id)->count()}}</i>
                                    <svg width="25" height="30" viewBox="0 0 25 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M24.0768 6.92006C24.0339 5.84745 23.1519 5 22.0784 5L2.92156 5C1.84809 5 0.966064 5.84745 0.923161 6.92007L0.0831939 27.9201C0.0377951 29.0551 0.945672 30 2.0816 30H22.9184C24.0543 30 24.9622 29.0551 24.9168 27.9201L24.0768 6.92006Z" fill="#0DAC49"></path>
                                        <path d="M20 7.5C20 11.6421 16.6421 15 12.5 15C8.35786 15 5 11.6421 5 7.5C5 3.35786 8.35786 0 12.5 0C16.6421 0 20 3.35786 20 7.5ZM7.25 7.5C7.25 10.3995 9.6005 12.75 12.5 12.75C15.3995 12.75 17.75 10.3995 17.75 7.5C17.75 4.6005 15.3995 2.25 12.5 2.25C9.6005 2.25 7.25 4.6005 7.25 7.5Z" fill="#0DAC49"></path>
                                    </svg>
                                    <div class="mini-drop">
                                        <div class="mini-drop-top">
                                            <div class="mini-drop-tit">
                                                Корзина            </div>
                                            <div class="mini-drop-text">
                                                Вы добавили <span class="basket-items-count">@php $count = 0; foreach($products as $p) $count += 1; echo $count; @endphp</span> товаров на сумму                <span class="basket-price">
                                                        @php
                                                            $sum = 0;
                                                            foreach ($products as $product){
                                                                $sum += \App\Models\Product::where('id', $product->product_id)->first()->price * $product->count;
                                                            }
                                                            echo $sum;
                                                        @endphp</span> грн
                                            </div>
                                        </div>

                                        <div class="mini-drop-body">
                                            <div class="mini-drop-list">

                                                <!-- one item -->
                                                @foreach($products as $product)
                                                    @php
                                                        $p = \App\Models\Product::where('id', $product->product_id)->first();
                                                    @endphp
                                                    <div @if( $p->in_stock == 0 ) data-no="true" @endif class="mini-drop-item" data-basket-item-id="{{$product->id}}" data-product-id="{{$product->product_id}}">
                                                        <div class="mini-drop-del" data-itemid="{{$product->id}}" data-name="{{$p->name}}" data-id="{{$p->id}}" data-price="{{$p->price}}" data-brand="{{$p->brand}}" data-category="{{$p->category}}"></div>
                                                        <div class="mini-drop-thumb">
                                                            <img src="{{asset("public/storage/{$p->img}")}}" alt=" ">
                                                        </div>
                                                        <div class="mini-drop-descr">
                                                            <div class="mini-drop-name">
                                                                <a href="{{route('product', ['id' => $p->id])}}">{{$p->name}}</a>
                                                                @if( $p->in_stock == 0 )
                                                                    <p style="color: red;">Нет в наличии</p>
                                                                @endif
                                                            </div>
                                                            @if($product->parameters)
                                                                <div class="mini-drop-option">
                                                                        @php
                                                                            $parameters = (array) json_decode($product->parameters);
                                                                            $keys = array_keys($parameters);
                                                                        @endphp
                                                                        @if(mb_strpos($keys[0], 'глаза') !== false)
                                                                            @php
                                                                                $left = [];
                                                                                $right = [];
                                                                                foreach($keys as $key) {
                                                                                    if(strpos($key, 'правого') !== false){
                                                                                        $right[mb_substr($key, 0, mb_strpos($key, 'правого'))] = $parameters[$key];
                                                                                    }
                                                                                    else {
                                                                                        $left[mb_substr($key, 0,  mb_strpos($key, 'левого'))] = $parameters[$key];
                                                                                    }
                                                                                }
                                                                            @endphp
                                                                            <b >Правый глаз:</b>
                                                                            @foreach($right as $key => $parametr)
                                                                                <li>
                                                                                    {{trim($key)}}: {{$parametr}}
                                                                                </li>
                                                                            @endforeach
                                                                            <b>Левый глаз:</b>
                                                                            @foreach($left as $key => $parametr)
                                                                                <li>
                                                                                    {{trim($key)}}: {{$parametr}}
                                                                                </li>
                                                                            @endforeach
                                                                        @else
                                                                            @foreach($parameters as $key => $parametr)
                                                                                <li>
                                                                                    {{$key}}: {{$parametr}}
                                                                                </li>
                                                                            @endforeach
                                                                        @endif
                                                                </div>
                                                            @endif
                                                            <div class="mini-drop-param">
                                                                <div class="mini-drop-num">
                                                                    <div class="num-in">
                                                                        <span data-id="{{$p->id}}" class="minus js-minus" style="cursor: pointer"></span>
                                                                        <input data-id="{{$p->id}}" onchange="pricedit(this)" name="QUANTITY" type="text" class="in-num no-style" value="{{$product->count}}" max="99">
                                                                        <span data-id="{{$p->id}}" class="plus js-plus" style="cursor: pointer"></span>

                                                                    </div>
                                                                </div>
                                                                <div class="mini-drop-price">
                                                                    <span class="now-price" data-id="{{$p->id}}">{{$product->count * $p->price}}</span> грн
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!-- / one item -->
                                            </div>
                                        </div>

                                        <div class="mini-drop-bot">
                                            <div class="mini-all-sum">
                                                <ul>
                                                    <li class="final-sum">
                                                        <span class="all-sum-name">Итого</span>
                                                        <span class="all-sum-price basket-price">{{$sum}}</span>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="mini-drop-bt">
                                                <a href="{{route('checkout')}}" class="def-big-bt" id="checkout">
                                                    Оформить заказ
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <i class="no-items-count">0</i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" viewBox="0 0 25 30" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5732 5C19.451 4.65433 19.3042 4.3203 19.1349 4C18.5143 2.82591 17.5912 1.83642 16.4693 1.13529C15.3181 0.415813 13.9576 0 12.5 0C11.0424 0 9.68188 0.415813 8.53065 1.13529C7.40879 1.83642 6.48565 2.82591 5.86502 4C5.69571 4.3203 5.54892 4.65433 5.42674 5H2.92154C1.84807 5 0.966044 5.84745 0.923141 6.92007L0.0831745 27.9201C0.0377756 29.0551 0.945652 30 2.08158 30H22.9184C24.0543 30 24.9622 29.0551 24.9168 27.9201L24.0768 6.92006C24.0339 5.84745 23.1519 5 22.0784 5H19.5732ZM17.4003 5C17.0161 4.24845 16.4641 3.59693 15.7937 3.09487C14.8755 2.40727 13.7353 2 12.5 2C11.2646 2 10.1244 2.40727 9.20628 3.09487C8.53588 3.59693 7.98388 4.24845 7.59969 5H17.4003ZM22.9184 28H2.08158L2.92154 7H22.0784L22.9184 28Z" fill="#37474F"/>
                                    </svg>
                                    <div class="mini-drop">
                                        <div class="mini-drop-top">
                                            <div class="mini-drop-tit">
                                                Корзина            </div>
                                            <div class="mini-drop-text">
                                                Вы добавили <span class="basket-items-count">0</span> товаров
                                            </div>
                                        </div>

                                        <div class="mini-drop-body">
                                            <div class="mini-drop-list">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </a>
                        </div>
                                <script>
                                    document.querySelector('.mini-drop-list').addEventListener('click', event => {
                                        if (event.target.classList.contains('minus')){
                                            if(document.querySelector(`.num-in>input[data-id='${event.target.dataset.id}']`).value > 1) {
                                                document.querySelector(`.num-in>input[data-id='${event.target.dataset.id}']`).value = +document.querySelector(`.num-in>input[data-id='${event.target.dataset.id}']`).value - 1
                                            }
                                            else {
                                                document.querySelector(`.num-in>input[data-id='${event.target.dataset.id}']`).value = 1
                                            }
                                            priceedit(event)
                                        }
                                        if (event.target.classList.contains('plus')) {
                                            if (document.querySelector(`.num-in>input[data-id='${event.target.dataset.id}']`).value < 99) {
                                                document.querySelector(`.num-in>input[data-id='${event.target.dataset.id}']`).value = +document.querySelector(`.num-in>input[data-id='${event.target.dataset.id}']`).value + 1
                                            }
                                            else {
                                                document.querySelector(`.num-in>input[data-id='${event.target.dataset.id}']`).value = 99
                                            }
                                            priceedit(event)
                                        }
                                        if (event.target.classList.contains('mini-drop-del')){
                                            event.preventDefault()
                                            $.ajax({
                                                url: '{{route('oproduct.delete')}}',
                                                data: '&id='+event.target.dataset.itemid,
                                                success: function () {
                                                    location.reload()
                                                }
                                            })
                                        }
                                    })

                                    document.getElementById('checkout').addEventListener('click', event => {
                                        sumbit = true
                                        document.querySelectorAll('.mini-drop-item').forEach(i => {
                                            if(i.dataset.no) {
                                                sumbit = false
                                            }
                                        })

                                        if (sumbit) {
                                            ids = {}
                                            document.querySelectorAll('.mini-drop-item').forEach(i => {
                                                ids[`${i.dataset.basketItemId}`] = i.querySelector('input').value
                                            })
                                            json = JSON.stringify(ids)
                                            $.ajax({
                                                url: '{{route('addInOP')}}',
                                                data: 'json='+ json,
                                                success: function () {

                                                },
                                                error: function () {
                                                    event.preventDefault()
                                                    alert('Ошибка!')
                                                }
                                            })
                                        }
                                        else {
                                            event.preventDefault()
                                            alert('Один из ваших товаров сейчас не в наличии')
                                        }

                                    })

                                    function priceedit(event) {
                                        price = document.querySelector(`.mini-drop-del[data-id="${event.target.dataset.id}"]`).dataset.price
                                        count = document.querySelector(`.num-in>input[data-id='${event.target.dataset.id}']`).value
                                        document.querySelector(`.now-price[data-id='${event.target.dataset.id}']`).textContent = `${price*count}`
                                        sum = 0
                                        document.querySelectorAll('.now-price').forEach(i => {
                                            sum = sum + +i.textContent
                                        })
                                        document.querySelector('.all-sum-price').textContent = sum
                                        document.querySelector('.basket-price').textContent = sum
                                    }


                                </script>
                        @endauth
                        @show
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-nav">
        <div class="container">
            <nav class="nav">
                <ul>
                    <li>
                        <a href="/contact-lenses-and-solutions/">
                            Контактные линзы
                        </a>
                        <div class="sub-menu">
                            <div class="sub-menu-descr">
                                <div class="container">
                                    <div class="sub-menu-descr-in">
                                        <div class="one-sub-menu">
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Бренд                                                                                                                            </div>
                                                <ul>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_obshch_brend-alcon/">Alcon</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_obshch_brend-bausch-lomb/">Bausch & Lomb</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_obshch_brend-coopervision/">CooperVision</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_obshch_brend-clearlab/">Clearlab</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_obshch_brend-acuity/">Acuity</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Линейка                                                                                                                            </div>
                                                <ul>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_obshch_lineyka-freshlook/">FreshLook</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_obshch_lineyka-dailies/">Dailies</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_obshch_lineyka-soflens/">SofLens</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_obshch_lineyka-biofinity/">Biofinity</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_obshch_lineyka-air-optix/">Air Optix</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Режим замены                                                                                                                            </div>
                                                <ul>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_mkl_srok_nosheniya-1-den/">1 день</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_mkl_srok_nosheniya-1-mesyats/">1 месяц</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_mkl_srok_nosheniya-3-mesyatsa/">3 месяца</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_mkl_srok_nosheniya-/">6-9 месяцев</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Назначение                                                                                                                            </div>
                                                <ul>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_mkl_naznachenie-tsvetnye/">Цветные</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_mkl_naznachenie-dlya-dali-ili/">Для дали (+ или -)</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_mkl_naznachenie-toricheskie/">Торические</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_mkl_naznachenie-multifokalnye/">Мультифокальные</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Материал линзы                                                                                                                            </div>
                                                <ul>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_mkl_material_linzy-nelfilcon-a/">Nelfilcon A</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_mkl_material_linzy-delefilcon-a/">Delefilcon A</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_mkl_material_linzy-alfafilcon/">Alfafilcon</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_mkl_material_linzy-comfilcon-a/">Comfilcon A</a>
                                                    </li>
                                                    <li>
                                                        <a href="/contact-lenses-and-solutions/es_l_mkl_material_linzy-hilafilcon-b/">Hilafilcon B</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    <a href="/care-products/">Средства для ухода</a>
                                                </div>
                                                <ul>
                                                    <li>
                                                        <a href="/care-products/es_l_rk_kategoriya-kapli/">Капли</a>
                                                    </li>
                                                    <li>
                                                        <a href="/care-products/es_l_rk_kategoriya-rastvor/">Раствор</a>
                                                    </li>
                                                    <li>
                                                        <a href="/care-products/es_l_rk_kategoriya-pincette/">Пинцет</a>
                                                    </li>
                                                    <li>
                                                        <a href="/care-products/es_l_rk_kategoriya-vitamins/">Витамины для глаз</a>
                                                    </li>
                                                    <li>
                                                        <a href="/care-products/es_l_rk_kategoriya-cases/">Контейнер для линз</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-to-cat">
                                    <div class="container">
                                        <div class="go-to-cat-in">
                                            <a class="def-big-bt" href="/contact-lenses-and-solutions/">
                                                Все Контактные линзы
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="/frames-and-lenses/">
                            Оправы
                        </a>
                        <div class="sub-menu">
                            <div class="sub-menu-top">
                                <div class="container">
                                    <ul>
                                        <li>
                                            <a href="/frames-and-lenses/es_obshch_forma_opravy-pryamougolnaya/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/542/542eb81c930fa9e19ac490a6dbb78c71.svg" alt="">
                                                </i>
                                                <span>
                                                    Прямоугольная
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/frames-and-lenses/es_obshch_forma_opravy-kvadratnaya/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/8f6/8f6ff0f6b5256f752ee2a56c11821861.svg" alt="">
                                                </i>
                                                <span>
                                                    Квадратная
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/frames-and-lenses/es_obshch_forma_opravy-babochka/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/292/2920bcb8eb8b2bd32734710b03251e3d.svg" alt="">
                                                </i>
                                                <span>
                                                    Бабочка
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/frames-and-lenses/es_obshch_forma_opravy-koshachiy-glaz/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/2df/2dfa5d1b068786b85ea1fc09da6bbaf2.svg" alt="">
                                                </i>
                                                <span>
                                                    Кошачий глаз
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/frames-and-lenses/es_obshch_forma_opravy-panto/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/2cd/2cd42202013a442f3b960c3145b4a3c3.svg" alt="">
                                                </i>
                                                <span>
                                                    Панто
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sub-menu-descr">
                                <div class="container">
                                    <div class="sub-menu-descr-in">
                                        <div class="one-sub-menu">
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Бренд
                                                </div>
                                                <ul>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_l_obshch_brend-gucci/">Gucci</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_l_obshch_brend-prada/">Prada</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_l_obshch_brend-ray-ban/">Ray-Ban</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_l_obshch_brend-emporio-armani/">Emporio Armani</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_l_obshch_brend-oga/">OGA</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Пол
                                                </div>
                                                <ul>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_obshch_naznachenie_dlya_ispolzovaniya_pol-unisex/">Унисекс</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_obshch_naznachenie_dlya_ispolzovaniya_pol-zhenskie/">Женские</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_obshch_naznachenie_dlya_ispolzovaniya_pol-detskie/">Детские</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_obshch_naznachenie_dlya_ispolzovaniya_pol-muzhskie/">Мужские</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Материал оправы
                                                </div>
                                                <ul>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_obshch_material_opravy-plastik/">Пластик</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_obshch_material_opravy-/">ацетат</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_obshch_material_opravy-metall/">Металл</a>
                                                    </li>
                                                    <li>
                                                        <a href="/frames-and-lenses/es_obshch_material_opravy-/">титан</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-to-cat">
                                    <div class="container">
                                        <div class="go-to-cat-in">
                                            <a class="def-big-bt" href="/frames-and-lenses/">
                                                Все Оправы
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="/sunglasses/">
                            Солнцезащитные очки
                        </a>
                        <div class="sub-menu">
                            <div class="sub-menu-top">
                                <div class="container">
                                    <ul>
                                        <li>
                                            <a href="/sunglasses/es_obshch_forma_opravy-kvadratnaya/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/8f6/8f6ff0f6b5256f752ee2a56c11821861.svg" alt="">
                                                </i>
                                                <span>
                                                    Квадратная
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/sunglasses/es_obshch_forma_opravy-pryamougolnaya/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/542/542eb81c930fa9e19ac490a6dbb78c71.svg" alt="">
                                                </i>
                                                <span>
												    Прямоугольная
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/sunglasses/es_obshch_forma_opravy-aviator/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/875/87534b2bc4c4c6d1b74ec7cf71f559a5.svg" alt="">
                                                </i>
                                                <span>
                                                    Авиатор
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/sunglasses/es_obshch_forma_opravy-panto/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/2cd/2cd42202013a442f3b960c3145b4a3c3.svg" alt="">
                                                </i>
                                                <span>
                                                    Панто
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/sunglasses/es_obshch_forma_opravy-kruglaya/">
                                                <i>
                                                    <img width="85" height="25" src="/upload/uf/714/71426e4934e048c1023fb3add31a9596.svg" alt="">
                                                </i>
                                                <span>
                                                    Круглая
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sub-menu-descr">
                                <div class="container">
                                    <div class="sub-menu-descr-in">
                                        <div class="one-sub-menu">
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Пол
                                                </div>
                                                <ul>
                                                    <li>
                                                        <a href="/sunglasses/es_obshch_naznachenie_dlya_ispolzovaniya_pol-muzhskie/">Мужские</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_obshch_naznachenie_dlya_ispolzovaniya_pol-unisex/">Унисекс</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_obshch_naznachenie_dlya_ispolzovaniya_pol-zhenskie/">Женские</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_obshch_naznachenie_dlya_ispolzovaniya_pol-detskie/">Детские</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Материал оправы
                                                </div>
                                                <ul>
                                                    <li>
                                                        <a href="/sunglasses/es_obshch_material_opravy-metall/">Металл</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_obshch_material_opravy-plastik/">Пластик</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_obshch_material_opravy-/">ацетат</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_obshch_material_opravy-/">нейлон</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_obshch_material_opravy-/">титан</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="one-list-menu">
                                                <div class="one-list-menu-tit">
                                                    Цвет линз
                                                </div>
                                                <ul>
                                                    <li>
                                                        <a href="/sunglasses/es_l_sz_tsvet_linz-siniy/">Синий</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_l_sz_tsvet_linz-serebro/">Серебро</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_l_sz_tsvet_linz-zelenyy/">Зеленый</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_l_sz_tsvet_linz-seryy/">Серый</a>
                                                    </li>
                                                    <li>
                                                        <a href="/sunglasses/es_l_sz_tsvet_linz-korichnevyy/">Коричневый</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="go-to-cat">
                                    <div class="container">
                                        <div class="go-to-cat-in">
                                            <a class="def-big-bt" href="/sunglasses/">
                                                Все Солнцезащитные очки
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="hide-desc-item show-mob-item">
                        <a  href="/ua/care-products/">
                            Средства для ухода
                        </a>
                        <div class="sub-menu">

                        </div>
                    </li>

                    <li class="hide-desc-item show-mob-item">
                        <a  href="/appointment/">
                            Запись к врачу
                        </a>
                        <div class="sub-menu">

                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="mobile-menu">
        <div class="ico-menu">
            <ul>
                <li>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                        <span class="ico-thumb">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.1638 17.5756C5.216 16.8876 5.54202 15.9724 6.2791 15.2362C6.9947 14.5214 8.15633 13.9167 10 13.9167C11.8437 13.9167 13.0053 14.5214 13.7209 15.2362C14.458 15.9724 14.784 16.8876 14.8362 17.5756L14.8663 17.5734C13.4635 18.4763 11.7932 19 10 19C8.20676 19 6.53647 18.4763 5.13365 17.5734L5.1638 17.5756ZM3.42889 16.1515C1.9222 14.5427 1 12.3796 1 10C1 5.02728 5.02728 1 10 1C14.9727 1 19 5.02728 19 10C19 12.3796 18.0778 14.5427 16.5711 16.1515C16.3085 15.3547 15.845 14.5311 15.1343 13.8211C14.0093 12.6974 12.323 11.9167 10 11.9167C7.677 11.9167 5.99072 12.6974 4.86569 13.8211C4.15496 14.5311 3.69154 15.3547 3.42889 16.1515Z" stroke="#667780" stroke-width="2"/>
                                <path d="M12.3334 7.49999C12.3334 8.78865 11.2887 9.83332 10 9.83332C8.71136 9.83332 7.66669 8.78865 7.66669 7.49999C7.66669 6.21133 8.71136 5.16666 10 5.16666C11.2887 5.16666 12.3334 6.21133 12.3334 7.49999Z" stroke="#667780" stroke-width="2"/>
                            </svg>
                        </span>
                        <span class="ico-text">
                            Мой кабинет
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="mobile-call" id="callbackPhoneMobile">
            <div class="mob-phone">
                @if(\Illuminate\Support\Facades\DB::table('contacts')->first() != null)
                    <a href="tel:{{\Illuminate\Support\Facades\DB::table('contacts')->first()->number}}">
                        {{\Illuminate\Support\Facades\DB::table('contacts')->first()->number}}
                    </a>
                @endif
            </div>
            <div class="call-form">
                <form action="#" id="callback-mobile-form">
                    <div class="call-form-inp">
                        <input type="text" name="phone" placeholder="Ваш номер телефону">
                        <div class="help-block-phone error-mess"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="second-mobile-menu">
            <ul>
                <li >
                    <a href="/about/">О компании</a>
                </li>
                <li >
                    <a href="/services/">Услуги</a>
                </li>
                <li >
                    <a href="/delivery/">Доставка и оплата</a>
                </li>
                <li >
                    <a href="/obmen-i-vozvrat/">Обмен и возврат</a>
                </li>
                <li >
                    <a href="/loyalty/">Программы лояльности</a>
                </li>
                <li >
                    <a href="/doctors/">Врачи</a>
                </li>
            </ul>


        </div>
    </div>

</header>

