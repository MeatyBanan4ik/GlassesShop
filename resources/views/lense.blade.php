@extends('layouts.layout')
@section('content')

    <main class="catalog-page">
        <section id="bread">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bread">
                            <ul itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs testtt">
                                <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                                    <a href="/" title="Главная" itemprop="item">
                                        <span itemprop="name">Главная</span>
                                    </a> <meta itemprop="position" content="0">
                                </li>
                                <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                                    <a href="/contact-lenses-and-solutions/" title="Контактные линзы" itemprop="item">
                                        <span itemprop="name">Контактные линзы</span>
                                    </a>
                                    <meta itemprop="position" content="1">
                                </li>
                                <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                                    <span itemprop="name">Контактные линзы {{ $product->name }}</span>
                                    <meta itemprop="position" content="2">
                                </li>
                            </ul>
                        </div>
                        <div class="go-back-mobile">
                            <a href="/contact-lenses-and-solutions/">Контактные линзы</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="catalog">
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="product product-other product-lens">
                        <div class="row">
                            <div class="col-12"><h1>
                                    Контактные линзы {{ $product->name }}</h1>
                            </div>
                            <div class="col-12">
                                <div class="prod-top-info">
                                    <div class="rat">
                                        <div class="art">
                                            <span>
                                                <i>Арт.</i>
                                                {{ $product->vendor_code }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="product-wrap">
                                        <div class="product-slider">
                                            <div class="prod-slider-big">
                                                <div class="prod-slider-big-in js-big-slider slick-initialized slick-slider">
                                                    <div class="slick-list draggable">
                                                        <div class="slick-track" style="opacity: 1; width: 320px; transform: translate3d(0px, 0px, 0px);">
                                                            <div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 320px;">
                                                                <div>
                                                                    <div class="one-big-slide" style="width: 100%; display: inline-block;">
                                                                        <a data-fancybox="gallery" href="{{ asset("public/storage/{$product->img}") }}" tabindex="0">
                                                                            <img src="{{ asset("public/storage/{$product->img}") }}" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <form method="post" action="{{ route('order', ['id' => $product->id]) }}" id="iform">
                                            @csrf
                                            <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                                            <input type="number" name="price" value="{{ $product->price }}" hidden>
                                            <div class="choose-prod-radio">
                                                <div class="list-nav">
                                                    <ul id="choose_eye" class="nav">
                                                        <li>
                                                            <a class="active">
                                                                <h2 data-name="one_eye">Одинаковые глаза</h2>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="">
                                                                <h2 data-name="two_eye">Разные глаза</h2>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                {{--Для одинаковых глаз--}}
                                                <div class="row mt-5" id="one_eye" style="width:auto">
                                                     <div class="choose-lens-option">
                                                         <div class="col">
                                                         <label for="diopters">Диоптрий</label>
                                                         <select class="form-select @error('diopters')  alert-danger @enderror" name="diopters" id="diopters" style="width:auto">]
                                                             @if(is_array($diopters))
                                                                 <option value="">...</option>
                                                                 @foreach($diopters as $dio)
                                                                     <option value="{{ $dio }}">{{ $dio }}</option>
                                                                 @endforeach
                                                             @else
                                                                 <option value="{{ $diopters }}">{{ $diopters }}</option>
                                                             @endif
                                                         </select>

                                                         </div>
                                                         <div class="col">
                                                             <label for="curvature">Радиус</label>
                                                             <select class="form-select @error('curvature') alert-danger @enderror" name="curvature" id="curvature" style="width:auto">
                                                                 @if(is_array($curvature))
                                                                     <option value="">...</option>
                                                                     @foreach($curvature as $cur)
                                                                         <option value="{{ $cur }}">{{ $cur }}</option>
                                                                     @endforeach
                                                                 @else
                                                                     <option value="{{ $curvature }}">{{ $curvature }}</option>
                                                                 @endif
                                                             </select>
                                                         </div>
                                                         @if($attributes->axis != NULL and $attributes->axis != '[""]')
                                                             <div class="col">
                                                                 <label for="axis">Ось</label>
                                                                 <select class="form-select @error('axis') alert-danger @enderror" name="axis" id="axis" style="width:auto">
                                                                     @if(is_array($axis))
                                                                         <option value="">...</option>
                                                                         @foreach($axis as $ax)
                                                                             <option value="{{ $ax }}">{{ $ax }}</option>
                                                                         @endforeach
                                                                     @else
                                                                         <option value="{{ $axis }}">{{ $axis }}</option>
                                                                     @endif
                                                                 </select>
                                                             </div>
                                                         @endif

                                                         @if($attributes->cylinder != NULL and $attributes->cylinder != '[""]')
                                                             <div class="col">
                                                                 <label for="cylinder">Цилиндр</label>
                                                                 <select class="form-select @error('cylinder') alert-danger @enderror" name="cylinder" id="cylinder" style="width:auto">
                                                                     @if(is_array($cylinder))
                                                                         <option value="">...</option>
                                                                         @foreach($cylinder as $cyl)
                                                                             <option value="{{ $cyl }}">{{ $cyl }}</option>
                                                                         @endforeach
                                                                     @else
                                                                         <option value="{{ $cylinder }}">{{ $cylinder }}</option>
                                                                     @endif
                                                                 </select>
                                                             </div>
                                                         @endif
                                                     </div>

                                                </div>
                                                {{--Для разных глаз--}}
                                                <div class="row mt-3 flex-column d-flex choose-lens-option" id="two_eyes" style="width:auto; display:none!important">
                                                    <span class="ml-5 mb-2 eye-tit">Для правого глаза</span>
                                                    <div class="col d-flex">
                                                        <div class="col">
                                                            <label for="r_diopters">Диоптрий</label>
                                                            <select class="form-select @error('r_diopters') alert-danger @enderror" name="r_diopters" id="r_diopters" style="width:auto">
                                                                @if(is_array($diopters))
                                                                    <option value="">...</option>
                                                                    @foreach($diopters as $dio)
                                                                        <option value="{{ $dio }}">{{ $dio }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="{{ $diopters }}">{{ $diopters }}</option>
                                                                @endif
                                                            </select>

                                                        </div>
                                                        <div class="col">
                                                            <label for="r_curvature">Радиус</label>
                                                            <select class="form-select @error('r_curvature') alert-danger @enderror" name="r_curvature" id="r_curvature" style="width:auto">
                                                                @if(is_array($curvature))
                                                                    <option value="">...</option>
                                                                    @foreach($curvature as $cur)
                                                                        <option value="{{ $cur }}">{{ $cur }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="{{ $curvature }}">{{ $curvature }}</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        @if($attributes->axis != NULL and $attributes->axis != '[""]')
                                                            <div class="col">
                                                                <label for="r_axis">Ось</label>
                                                                <select class="form-select @error('r_axis') alert-danger @enderror" name="r_axis" id="r_axis" style="width:auto">
                                                                    @if(is_array($axis))
                                                                        <option value="">...</option>
                                                                        @foreach($axis as $ax)
                                                                            <option value="{{ $ax }}">{{ $ax }}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="{{ $axis }}">{{ $axis }}</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        @endif
                                                        @if($attributes->cylinder != NULL and $attributes->cylinder != '[""]')
                                                            <div class="col">
                                                                <label for="r_cylinder">Цилиндр</label>
                                                                <select class="form-select @error('r_cylinder') alert-danger @enderror" name="r_cylinder" id="r_cylinder" style="width:auto">
                                                                    @if(is_array($cylinder))
                                                                        <option value="">...</option>
                                                                        @foreach($cylinder as $cyl)
                                                                            <option value="{{ $cyl }}">{{ $cyl }}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="{{ $cylinder }}">{{ $cylinder }}</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <span class="mt-3 ml-5 mb-2 eye-tit">Для левого глаза</span>
                                                    <div class="col d-flex">

                                                        <div class="col">
                                                            <label for="l_diopters">Диоптрий</label>
                                                            <select class="form-select @error('l_diopters') alert-danger @enderror" name="l_diopters" id="l_diopters" style="width:auto">
                                                                @if(is_array($diopters))
                                                                    <option value="">...</option>
                                                                    @foreach($diopters as $dio)
                                                                        <option value="{{ $dio }}">{{ $dio }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="{{ $diopters }}">{{ $diopters }}</option>
                                                                @endif
                                                            </select>

                                                        </div>
                                                        <div class="col">
                                                            <label for="l_curvature">Радиус</label>
                                                            <select class="form-select @error('l_curvature') alert-danger @enderror" name="l_curvature" id="l_curvature" style="width:auto">
                                                                @if(is_array($curvature))
                                                                    <option value="">...</option>
                                                                    @foreach($curvature as $cur)
                                                                        <option value="{{ $cur }}">{{ $cur }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="{{ $curvature }}">{{ $curvature }}</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        @if($attributes->axis != NULL and $attributes->axis != '[""]')
                                                            <div class="col">
                                                                <label for="l_axis">Ось</label>
                                                                <select class="form-select @error('l_axis') alert-danger @enderror" name="l_axis" id="l_axis" style="width:auto">
                                                                    @if(is_array($axis))
                                                                        <option value="">...</option>
                                                                        @foreach($axis as $ax)
                                                                            <option value="{{ $ax }}">{{ $ax }}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="{{ $axis }}">{{ $axis }}</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        @endif
                                                        @if($attributes->cylinder != NULL and $attributes->cylinder != '[""]')
                                                            <div class="col">
                                                                <label for="l_cylinder">Цилиндр</label>
                                                                <select class="form-select @error('l_cylinder') alert-danger @enderror" name="l_cylinder" id="l_cylinder" style="width:auto">
                                                                    @if(is_array($cylinder))
                                                                        <option value="">...</option>
                                                                        @foreach($cylinder as $cyl)
                                                                            <option value="{{ $cyl }}">{{ $cyl }}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="{{ $cylinder }}">{{ $cylinder }}</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <label for="count">Количество(уп.)</label>
                                                    <input class="form-control" style="width:25%; font-size: 20px;" maxlength="2" min="1" max="99" value="1" data-price="{{ $product->price }}" type="number" name="count" id="count">
                                                </div>
                                            </div>
                                            <div class="prod-info">

                                                <div class="prod-price">
                                                    <div class="now-prod-price">
                                                        <span id="price">{{ $product->price }}</span>грн
                                                    </div>

                                                </div>

                                                <div class="prod-btn">
                                                    <div class="brod-buy-bt">
                                                        @if($product->in_stock == 1)
                                                            <button class="def-bt" type="submit">В корзину</button>
                                                        @else
                                                            <div class="def-bt" style="background-color:grey!important" type="submit">Нет в наличии</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="mini-about-char">
                                        <div class="about-char-tit">
                                            О товаре
                                        </div>
                                        <div class="about-char-list">
                                            <ul>
                                                <li>
                                                    <span class="min-char-name">Бренд</span>
                                                    <span class="min-char-val">{{ $product->brand }}</span>
                                                </li>
                                                <li>
                                                    <span class="min-char-name">Назначение</span>
                                                    <span class="min-char-val">{{ $attributes->purpose }}</span>
                                                </li>
                                                <li><span class="min-char-name">Влагосодержание</span>
                                                    <span class="min-char-val">{{ $attributes->moisture }}%</span>
                                                </li>
                                                <li><span class="min-char-name">Режим ношения</span>
                                                    <span class="min-char-val">{{ $attributes->wearing_mode }}</span>
                                                </li>
                                                <li>
                                                    <span class="min-char-name">Режим замены</span>
                                                    <span class="min-char-val">{{ $attributes->replacement_mode }}</span></li>
                                            </ul>
                                        </div>
                                        <div class="all-char">
                                            <a href="#tab1-tab" class="js-prod-anchor dash-link">Все характеристики</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="prod-service">
                        <div class="one-prod-serv">
                            <div class="one-prod-serv-tit">
                                Доставка по Украине
                            </div>
                            <div class="one-prod-serv-text">
                                Новая почта
                            </div>
                        </div>
                        <div class="one-prod-serv">
                            <div class="one-prod-serv-tit">
                                Оплата
                            </div> <div class="one-prod-serv-text">
                                Наличными, картой, наложенным платежом
                            </div>
                        </div>
                        <div id="inShopMapButt" class="one-prod-serv">
                            <div class="one-prod-serv-tit">Наличие на складе</div>
                            <div class="one-prod-serv-text">
                                @if($product->in_stock == 1)
                                    Есть в наличии
                                @else
                                    Нет в наличии
                                @endif
                            </div>
                        </div>
                    </div>
                    <div id="elementval" data-iblock="2" data-code="air-optix-plus-hydraglyde-multifocal" data-lang="ru" style="display: none;"></div> <section id="map-shop" style="padding: 80px 0px 50px; display: none;"><div id="shops_list_main" class="container tabl-full"><div class="select-tit">Наличие товара в наших оптиках</div> <div id="shops-list" class="map-shop-in"><div class="map-shop-list"><div class="map-shop-search"><input type="text" required="required" placeholder="Поиск по адресу" class="search-input js-search-input filterOpticsMap"> <button class="search-bt"></button> <button type="reset" class="search-remove js-search-remove"></button></div> <div class="map-shop-list-in js-scroll-to-the-end"><ul id="shopListInMap"></ul></div></div> <div class="map"><div id="newMap" style="position: relative; overflow: hidden;"></div></div></div></div></section> <div class="prod-full-descr"><div class="list-nav"><ul id="myTab" role="tablist" class="nav"><li><a id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true" class="active ">Характеристики</a>
                                </li>
                                <li>
                                    <a id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="true">Описание</a>
                                </li>
                                <li id="link-comm">
                                    <a href="#comm" class="js-prod-anchor">
                                        Отзывы
                                        <span>3</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#comm" class="js-prod-anchor">
                                        Вопросы
                                        <span>2</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div id="myTabContent" class="tab-content">
                            <div id="tab1" role="tabpanel" aria-labelledby="tab1-tab" class="tab-pane fade show active">
                                <div class="one-descr-content">
                                    <div class="tab-tit js-mob-tit">
                                        Характеристики
                                    </div>
                                    <div class="prod-det-char">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>Бренд</td>
                                                <td>
                                                    <a href="">{{ $product->brand }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Назначение</td>
                                                <td>
                                                    <a href="">{{ $attributes->purpose }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Диаметр</td>
                                                <td>
                                                    <span>{{ $attributes->diameter }} мм</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Толщина по центру</td>
                                                <td>
                                                    <span>{{ $attributes->center_thickness }} мм</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Тип материала</td>
                                                <td>
                                                    <a href="">{{ $attributes->material_type }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Влагосодержание</td>
                                                <td>
                                                    <span>{{ $attributes->moisture }}%</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Материал линзы</td>
                                                <td>
                                                    <span>{{ $attributes->lens_material }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Пропускание кислорода</td>
                                                <td>
                                                    <span>{{ $attributes->oxygen_transmission }} Dk/t</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Режим ношения</td>
                                                <td>
                                                    <a href="">{{ $attributes->wearing_mode }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Режим замены</td>
                                                <td>
                                                    <a href="">1 месяц</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Тонировка</td>
                                                <td>
                                                    <span>{{ $attributes->tinting }}</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.querySelector('#choose_eye').addEventListener('click', event =>
        {
            event.preventDefault()
            console.log(document.querySelector('#one_eye'))
            if(event.target.dataset.name === 'one_eye')
            {
                document.querySelector('h2[data-name = "two_eye"]').closest('a').classList.remove('active')
                document.querySelector('h2[data-name = "one_eye"]').closest('a').classList.add('active')
                document.querySelector('#one_eye').style.setProperty('display', 'block', 'important')
                document.querySelector('#two_eyes').style.setProperty('display', 'none', 'important')
            }
            else if (event.target.dataset.name === 'two_eye')
            {
                document.querySelector('h2[data-name = "two_eye"]').closest('a').classList.add('active')
                document.querySelector('h2[data-name = "one_eye"]').closest('a').classList.remove('active')
                document.querySelector('#one_eye').style.setProperty('display', 'none', 'important')
                document.querySelector('#two_eyes').style.setProperty('display', 'block', 'important')
            }
        })

        document.querySelector('#iform').addEventListener('submit', event =>
        {
           document.querySelector('#iform').insertAdjacentHTML('afterbegin', `<input type='text' name='type' value='${event.target.querySelector('.active>h2').dataset.name}' hidden>`)
        })
    </script>

    <script>
        document.getElementById('count').addEventListener('change', event =>
        {
            document.getElementById('price').textContent = event.target.dataset.price * event.target.value
        })
    </script>

    <script>
        document.getElementById('count').oninput = function () {
            if (this.value.length > 2) {
                this.value = this.value.slice(0,2);
            }
        }
    </script>
@endsection


