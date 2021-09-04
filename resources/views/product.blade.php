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
                                    <a href="/sunglasses/" title="Солнцезащитные очки" itemprop="item">
                                        <span itemprop="name">Солнцезащитные очки</span>
                                    </a>
                                    <meta itemprop="position" content="1">
                                </li>
                                <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                                    <span itemprop="name">Солнцезащитные очки {{ $product->name }}</span>
                                    <meta itemprop="position" content="2">
                                </li>
                            </ul>
                        </div>
                        <div class="go-back-mobile">
                            <a href="/sunglasses/">Солнцезащитные очки</a>
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
            <div class="product ">
                <div class="container tabl-full">
                    <input type="hidden" id="templateFolder" value="/local/templates/main_v2/components/aniart/product.detail/main"><input type="hidden" id="ibid" value="3">
                    <input type="hidden" id="lang" value="ru">
                    <div id="dontforgonbay" data-dontforgonbay="">

                    </div>
                    <div class="product-top">
                        <meta itemprop="image" content="/assets/img/police-1.jpg">
                        <meta itemprop="description" content="Солнцезащитные очки {{ $product->name }}">
                        <div class="row"><div class="col-12">
                                <h1>Солнцезащитные очки {{ $product->name }}</h1>
                            </div>
                            <div class="col-12">
                                <div class="prod-top-info">
                                    <div class="leave-comm">
                                        <a href="#link-comm" class="js-prod-anchor">
                                            Оставить отзыв
                                        </a>
                                    </div>
                                    <div class="art">
                                        <span>
                                            <i>Арт.</i>{{ $product->vendor_code }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="product-wrap">
                                    <div class="product-slider">
                                        <div class="marketingBlock">
                                            <div class="prod-vobler"></div>
                                        </div>

                                        <div class="one-big-slide" style="width: 100%; display: inline-block;">
                                            <a data-fancybox="gallery" href="{{ asset("public/storage/{$product->img}") }}" tabindex="-1">
                                                <img src="{{ asset("public/storage/{$product->img}") }}" alt="">
                                            </a>
                                        </div>

                                    </div>
                                    <div class="prod-info">
                                        <div class="prod-price">
                                            <div class="now-prod-price">
                                                <span>{{ $product->price }}</span>грн
                                            </div>
                                        </div>
                                        <div class="prod-btn">
                                            <div class="brod-buy-bt">
                                                <form method="post" action="{{ route('order', ['id'=> $product->id]) }}" id="iform">
                                                    @csrf
                                                    <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                                                    <input type="number" name="price" value="{{ $product->price }}" hidden>
                                                    @if($product->in_stock == 1)
                                                        <button class="def-bt" type="submit">В корзину</button>
                                                    @else
                                                        <div class="def-bt" style="background-color:grey!important" type="submit">Нет в наличии</div>
                                                    @endif
                                                </form>
                                            </div>

                                            <div class="clear">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mini-about-char">
                                        <div class="about-char-tit">
                                            О товаре
                                        </div>
                                        <div class="about-char-list">
                                            <ul>
                                                <li>
                                                    <span class="min-char-name">Пол</span>
                                                    <span class="min-char-val">{{ $attributes->sex }}</span>
                                                </li>
                                                <li>
                                                    <span class="min-char-name">Бренд</span>
                                                    <span class="min-char-val">{{ $product->brand }}</span>
                                                </li>
                                                <li>
                                                    <span class="min-char-name">Форма оправы</span>
                                                    <span class="min-char-val">{{ $attributes->frame_shape }}</span>
                                                </li>
                                                <li>
                                                    <span class="min-char-name">Материал оправы</span>
                                                    <span class="min-char-val">{{ $attributes->frame_material }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="all-char">
                                            <a href="#tab1-tab" class="dash-link js-prod-anchor">
                                                Все характеристики
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="prod-service">
                        <div class="one-prod-serv">
                            <div class="one-prod-serv-tit">
                                <div class="one-prod-serv-tit">
                                    Доставка по Украине
                                </div>
                                <div class="one-prod-serv-text">
                                    Новая почта
                                </div>
                            </div>
                        </div>
                        <div class="one-prod-serv">
                            <div class="one-prod-serv-tit">
                                Оплата
                            </div> <div class="one-prod-serv-text">
                                Наличными, картой, наложенным платежом
                            </div>
                        </div>
                        <div class="one-prod-serv">
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
                </div>
            </div>
        </section>
        <div class="prod-full-descr">
            <div class="list-nav">
                <ul id="myTab" role="tablist" class="nav">
                    <li>
                        <a id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true" class="active ">
                            Характеристики
                        </a>
                    </li>
                    <li id="link-comm"><a id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">
                            Отзывы
                            <span>

                            </span>
                        </a>
                    </li>
                    <li>
                        <a id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">
                            Вопросы
                            <span>

                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="myTabContent" class="tab-content">
                <div id="tab1" role="tabpanel" aria-labelledby="tab1-tab" class="tab-pane fade show active">
                    <div class="one-descr-content">
                        <div class="tab-tit js-mob-tit">Характеристики</div>
                        <div class="prod-det-char">
                            <table>
                                <tbody>
                                <tr>
                                    <td>Пол</td>
                                    <td>{{ $attributes->sex }}</td>
                                </tr>
                                <tr>
                                    <td>Бренд</td>
                                    <td>{{ $product->brand }}</td>
                                </tr>
                                <tr>
                                    <td>Форма оправы</td>
                                    <td>{{ $attributes->frame_shape }}</td>
                                </tr>
                                <tr>
                                    <td>Материал оправы</td>
                                    <td>{{ $attributes->frame_material }}</td>
                                </tr>
                                <tr>
                                    <td>Цвет линз</td>
                                    <td>{{ $attributes->lens_color }}</td>
                                </tr>
                                <tr>
                                    <td>Поляризация</td>
                                    <td>
                                        @if($attributes->polarization == 1)
                                            Да
                                        @else
                                            Нет
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Зеркальная</td>
                                    <td>
                                        @if($attributes->mirror == 1)
                                            Да
                                        @else
                                            Нет
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Градиентная</td>
                                    <td>
                                        @if($attributes->gradient == 1)
                                            Да
                                        @else
                                            Нет
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Материал линз</td>
                                    <td>
                                        {{ $attributes->lens_material }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Размер мостика</td>
                                    <td>
                                        <span>{{ $attributes->bridge_size }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Размер окуляра</td>
                                    <td>
                                        <span>{{ $attributes->eyepiece_size }}</span>
                                    </td></tr>
                                <tr>
                                    <td>Длина заушника</td>
                                    <td>
                                        <span>{{ $attributes->temple_length }}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab2" role="tabpanel" aria-labelledby="tab2-tab" class="tab-pane fade ">
                    <div class="one-descr-content">
                        <div class="no-comment">
                            <div class="no-comment-tit">Будьте первыми, кто оставит отзыв!</div>
                            <div class="no-comment-bt">
                                <a href="" data-toggle="modal" data-target="#leaveCommModal" class="def-big-bt">
                                    Оставить отзыв
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab3" role="tabpanel" aria-labelledby="tab3-tab" class="tab-pane fade">
                    <div class="one-descr-content"><div class="no-comment">
                            <div class="no-comment-tit">
                                Будьте первыми, кто оставит вопрос!
                            </div>
                            <div class="no-comment-bt">
                                <a href="" data-toggle="modal" data-target="#addQuestModalProduct" class="def-big-bt">
                                    Задать вопрос
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="comm" class="comments">
            <div class="list-nav">
                <ul id="myTab2" role="tablist" class="nav">

                </ul>
            </div>
            <div id="myTabContent" class="tab-content">
                <div class="acc-tab-mob js-mob-acc">
                    Отзывы
                </div>
                <div id="tab-comm-1" role="tabpanel" aria-labelledby="tab-comm-1-tab" class="tab-pane fade show "><div class="tab-comm-body"><div class="no-comment"><div class="no-comment-tit">
                    Будьте первыми, кто оставит отзыв!
                            </div>
                            <div class="no-comment-bt">
                                <a href="" data-toggle="modal" data-target="#leaveCommModal" class="def-big-bt">
                                    Оставить отзыв
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="application/javascript">
                    document.addEventListener('DOMContentLoaded', function() {
                        ProductReviews.setTemplate('main');
                        ProductReviews.setParams('YToxMjp7czo0OiJCSU5EIjtzOjIxOiJwb2xpY2Utc3BsYjQyLTA3MDAtNTMiO3M6OToiUEFHRV9TSVpFIjtpOjQ7czo3OiJQUk9EVUNUIjtOO3M6MTA6IkNBQ0hFX1RZUEUiO3M6MToiQSI7czo4OiJQQUdFX1ZBUiI7czo0OiJwYWdlIjtzOjg6IlBBR0VfTlVNIjtpOjE7czo1OiJ+QklORCI7czoyMToicG9saWNlLXNwbGI0Mi0wNzAwLTUzIjtzOjEwOiJ+UEFHRV9TSVpFIjtpOjQ7czo4OiJ+UFJPRFVDVCI7TjtzOjExOiJ+Q0FDSEVfVFlQRSI7czoxOiJBIjtzOjk6In5QQUdFX1ZBUiI7czo0OiJwYWdlIjtzOjk6In5QQUdFX05VTSI7aToxO30=.f5fd81f04a5ad68a8b4ea9e959b751e2e1e875ea5a8b276bf921800e74dfa7f4');
                        ProductReviews.setLang('ru');
                        ProductReviews.setPagination(
                            {'NavNum':'2','NavPageCount':'0','NavPageNomer':'1','NavPageSize':'4','NavRecordCount':'0','leftGoods':'-4','pageItems':'-4'}            );
                    });
                </script>
                <div>

                </div>
                <div class="acc-tab-mob js-mob-acc">
                    Вопросы
                </div>
                <div id="tab-comm-2" role="tabpanel" aria-labelledby="tab-comm-2-tab" class="tab-pane fade"><div class="tab-comm-body"><div class="no-comment"><div class="no-comment-tit">
                                            Будьте первыми, кто оставит вопрос!            </div> <div class="no-comment-bt"><a href="javascript:void(0)" data-toggle="modal" data-target="#addQuestModalProduct" class="def-big-bt">
                                                Задать вопрос                </a></div></div></div></div>
                <script type="application/javascript">
                                document.addEventListener('DOMContentLoaded', function() {
                                    ProductQuestions.setTemplate('main');
                                    ProductQuestions.setParams('YToxMjp7czo0OiJCSU5EIjtzOjIxOiJwb2xpY2Utc3BsYjQyLTA3MDAtNTMiO3M6OToiUEFHRV9TSVpFIjtpOjQ7czo3OiJQUk9EVUNUIjtOO3M6MTA6IkNBQ0hFX1RZUEUiO3M6MToiQSI7czo4OiJQQUdFX1ZBUiI7czo0OiJwYWdlIjtzOjg6IlBBR0VfTlVNIjtpOjE7czo1OiJ+QklORCI7czoyMToicG9saWNlLXNwbGI0Mi0wNzAwLTUzIjtzOjEwOiJ+UEFHRV9TSVpFIjtpOjQ7czo4OiJ+UFJPRFVDVCI7TjtzOjExOiJ+Q0FDSEVfVFlQRSI7czoxOiJBIjtzOjk6In5QQUdFX1ZBUiI7czo0OiJwYWdlIjtzOjk6In5QQUdFX05VTSI7aToxO30=.d1e20a669683adaa176b4e18404f5494742e70fe682758b260f2308cc68e2040');
                                    ProductQuestions.setPagination(
                                        {'NavNum':'3','NavPageCount':'0','NavPageNomer':'1','NavPageSize':'4','NavRecordCount':'0','leftGoods':'-4','pageItems':'-4'}            );
                                });
                </script>
                <div class="acc-tab-mob js-mob-acc">
                    Описание
                </div>
                <div id="tab-comm-3" role="tabpanel" aria-labelledby="tab-comm-3-tab" class="tab-pane fade">
                    <div class="tab-comm-body">
                        <div class="no-comment">
                            <div class="no-comment-bt">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="carous-blog">
            <div class="container tabl-full">
                <div class="carous-wrap no-bg">
                    <div class="select-tit">
                        полезно узнать
                    </div>
                    <div class="corousel-parent">
                        <div class="corousel-body js-init-carous" style="overflow: hidden;">
                            <div class="carousel-init" style="transform: translateZ(0px); width: 4752px;">
                                <div class="one-carous-news active">
                                    <div class="one-carous-news-in">
                                        <div class="one-news-carous-thumb">
                                            <a href="/articles/solntsezashchitnye-ochki/kak-vybrat-solntsezashchitnye-ochki-dlya-sporta/">
                                                <img src="/assets/img/police-1.jpg" alt="Как выбрать солнцезащитные очки для спорта">
                                            </a>
                                        </div>
                                        <div class="one-news-carous-tit">
                                            <a href="/articles/solntsezashchitnye-ochki/kak-vybrat-solntsezashchitnye-ochki-dlya-sporta/">
                                                Как выбрать солнцезащитные очки для
                                            </a>
                                        </div>
                                        <div class="one-news-carous-info">
                                            <time>
                                                14.07.2021</time>
                                        </div>
                                    </div>
                                </div>
                                <div class="one-carous-news">
                                    <div class="one-carous-news-in">
                                        <div class="one-news-carous-thumb">
                                            <a href="/articles/opticheskie-linzy-nikon/fotokhromnye-linzy-nikon-transitions-s-zabotoy-o-zdorove-glaz/">
                                                <img src="/assets/img/police-1.jpg" alt="Фотохромные линзы Nikon Transitions — с заботой о здоровье глаз">
                                            </a>
                                        </div>
                                        <div class="one-news-carous-tit">
                                            <a href="/articles/opticheskie-linzy-nikon/fotokhromnye-linzy-nikon-transitions-s-zabotoy-o-zdorove-glaz/">
                                                Фотохромные линзы Nikon Transitions — с заботой о здоровье глаз
                                            </a>
                                        </div>
                                        <div class="one-news-carous-info"><time>
                                                06.07.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/opticheskie-linzy-nikon/linzy-nikon-dlya-vashikh-ochkov-eksklyuzivno-v-lyuksoptike/"><img src="/upload/iblock/a62/a62c42c5c3c4ef208a3fc57fdb436ded.jpg" alt="Линзы Nikon для ваших очков — эксклюзивно в Люксоптике"></a></div> <div class="one-news-carous-tit"><a href="/articles/opticheskie-linzy-nikon/linzy-nikon-dlya-vashikh-ochkov-eksklyuzivno-v-lyuksoptike/">
                                                Линзы Nikon для ваших очков — эксклюзивно в Люксоптике                                        </a></div> <div class="one-news-carous-info"><time>
                                                06.07.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/opravy/ochki-ray-ban-kak-otlichit-poddelku-ot-originala/"><img src="/upload/iblock/c8b/c8bbdc2c387deaf663e81f51fac66c00.jpg" alt="Очки Ray-Ban: как отличить подделку от оригинала"></a></div> <div class="one-news-carous-tit"><a href="/articles/opravy/ochki-ray-ban-kak-otlichit-poddelku-ot-originala/">
                                                Очки Ray-Ban: как отличить подделку от оригинала                                        </a></div> <div class="one-news-carous-info"><time>
                                                18.06.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/opticheskie-linzy-nikon/pokrytie-seecoat-next-ot-nikon-novyy-uroven-dolgovechnosti-linz-dlya-vashikh-ochkov/"><img src="/upload/iblock/22a/22af373a2466398a5c945763eb25d187.jpg" alt="Линзы Nikon с покрытием SeeCoat Next — новый уровень долговечности"></a></div> <div class="one-news-carous-tit"><a href="/articles/opticheskie-linzy-nikon/pokrytie-seecoat-next-ot-nikon-novyy-uroven-dolgovechnosti-linz-dlya-vashikh-ochkov/">
                                                Линзы Nikon с покрытием SeeCoat Next — новый уровень долговечности                                        </a></div> <div class="one-news-carous-info"><time>
                                                19.04.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/zabolevaniya-glaz/kak-ubrat-pokrasnenie-glaz/"><img src="/upload/iblock/b22/b228cb7b884c5200c4c4e65581648f28.jpg" alt="Как убрать покраснение глаз"></a></div> <div class="one-news-carous-tit"><a href="/articles/zabolevaniya-glaz/kak-ubrat-pokrasnenie-glaz/">
                                                Как убрать покраснение глаз                                        </a></div> <div class="one-news-carous-info"><time>
                                                19.04.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/drugoe/wow-lyuksoptika-gde-rabotaet-master-na-vse-ochki/"><img src="/upload/iblock/b2d/b2d248d5ef33882f543002fa4b048d09.jpg" alt="WoW-Люксоптика: где работает мастер на все очки"></a></div> <div class="one-news-carous-tit"><a href="/articles/drugoe/wow-lyuksoptika-gde-rabotaet-master-na-vse-ochki/">
                                                WoW-Люксоптика: где работает мастер на все очки                                        </a></div> <div class="one-news-carous-info"><time>
                                                13.04.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/drugoe/onlayn-primerka-ochkov-na-sayte-lyuksoptiki-nerealnaya-novinka-dlya-realnykh-pokupok/"><img src="/upload/iblock/e5d/e5dae118572ae644bf7b2cb6e0f948f6.jpg" alt="Онлайн-примерка очков на сайте Люксоптики — нереальная новинка для реальных покупок"></a></div> <div class="one-news-carous-tit"><a href="/articles/drugoe/onlayn-primerka-ochkov-na-sayte-lyuksoptiki-nerealnaya-novinka-dlya-realnykh-pokupok/">
                                                Онлайн-примерка очков на сайте Люксоптики — нереальная новинка для реальных покупок                                        </a></div> <div class="one-news-carous-info"><time>
                                                08.04.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/opravy/imidzhevye-ochki-casta-v-lyuksoptike/"><img src="/upload/iblock/8a4/8a4d10f65f5b2723da44c4ab0cf3cfab.jpg" alt="Имиджевые очки Casta в Люксоптике"></a></div> <div class="one-news-carous-tit"><a href="/articles/opravy/imidzhevye-ochki-casta-v-lyuksoptike/">
                                                Имиджевые очки Casta в Люксоптике                                        </a></div> <div class="one-news-carous-info"><time>
                                                05.04.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/zabolevaniya-glaz/apparatnoe-lechenie-v-lyuksoptike-fitnes-dlya-zdorovya-glaz-detey-i-vzroslykh/"><img src="/upload/iblock/b87/b87c76a4c24f947754bfcb7b198ec1be.jpg" alt="Аппаратное лечение в Люксоптике — «фитнес» для здоровья глаз детей и взрослых"></a></div> <div class="one-news-carous-tit"><a href="/articles/zabolevaniya-glaz/apparatnoe-lechenie-v-lyuksoptike-fitnes-dlya-zdorovya-glaz-detey-i-vzroslykh/">
                                                Аппаратное лечение в Люксоптике — «фитнес» для здоровья глаз детей и взрослых                                        </a></div> <div class="one-news-carous-info"><time>
                                                05.04.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/kontaktnye-linzy-i-aksessuary/mozhno-li-nosit-kontaktnye-linzy-pri-prostude/"><img src="/upload/iblock/845/845e62d025fd79486e8c53c508e7fed8.jpg" alt="Можно ли носить контактные линзы при простуде?"></a></div> <div class="one-news-carous-tit"><a href="/articles/kontaktnye-linzy-i-aksessuary/mozhno-li-nosit-kontaktnye-linzy-pri-prostude/">
                                                Можно ли носить контактные линзы при простуде?                                        </a></div> <div class="one-news-carous-info"><time>
                                                10.03.2021                                        </time></div></div></div> <div class="one-carous-news"><div class="one-carous-news-in"><div class="one-news-carous-thumb"><a href="/articles/solntsezashchitnye-ochki/pochti-bezgranichnyy-vybor-solntsezashchitnykh-ochkov-v-lyuksoptike/"><img src="/upload/iblock/d2e/d2e1f98cf5629a6a8f6c67e04324d502.jpg" alt="Почти безграничный выбор солнцезащитных очков в Люксоптике"></a></div> <div class="one-news-carous-tit"><a href="/articles/solntsezashchitnye-ochki/pochti-bezgranichnyy-vybor-solntsezashchitnykh-ochkov-v-lyuksoptike/">
                                                Почти безграничный выбор солнцезащитных очков в Люксоптике                                        </a></div> <div class="one-news-carous-info"><time>
                                                05.03.2021                                        </time></div></div></div></div></div> <div class="scrollbar" style=""><div class="handle" style="transform: translateZ(0px) translateX(0px); width: 50px;"><div class="mousearea"></div></div></div> <div class="controls center"><button class="btn-car prev disabled" disabled=""><span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.30006 7.00056C0.747774 7.00056 0.314975 7.44802 0.333374 8C0.351773 8.55198 0.814404 8.99944 1.36669 8.99944L1.30006 7.00056ZM15.3974 8.70671C15.7749 8.31641 15.7538 7.68359 15.3503 7.29329L8.77428 0.932857C8.37075 0.54255 7.73758 0.54255 7.36007 0.932857C6.98255 1.32316 7.00365 1.95598 7.40718 2.34629L13.2525 8L7.7841 13.6537C7.40658 14.044 7.42768 14.6768 7.83121 15.0671C8.23475 15.4575 8.86791 15.4575 9.24543 15.0671L15.3974 8.70671ZM1.36669 8.99944H14.7L14.6334 7.00056H1.30006L1.36669 8.99944Z" fill="#667780"></path></svg></span></button> <button class="btn-car next"><span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.30006 7.00056C0.747774 7.00056 0.314975 7.44802 0.333374 8C0.351773 8.55198 0.814404 8.99944 1.36669 8.99944L1.30006 7.00056ZM15.3974 8.70671C15.7749 8.31641 15.7538 7.68359 15.3503 7.29329L8.77428 0.932857C8.37075 0.54255 7.73758 0.54255 7.36007 0.932857C6.98255 1.32316 7.00365 1.95598 7.40718 2.34629L13.2525 8L7.7841 13.6537C7.40658 14.044 7.42768 14.6768 7.83121 15.0671C8.23475 15.4575 8.86791 15.4575 9.24543 15.0671L15.3974 8.70671ZM1.36669 8.99944H14.7L14.6334 7.00056H1.30006L1.36669 8.99944Z" fill="#667780"></path></svg></span></button></div></div></div></div></section><script type="application/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                if(!ArticlesSlider){
                    //set component params
                    ArticlesSlider.setTemplate('product.detail-slider');
                    ArticlesSlider.setParams('YTozNTp7czoxMDoiQ0FDSEVfVFlQRSI7czoxOiJBIjtzOjEwOiJDQUNIRV9USU1FIjtpOjM2MDAwO3M6ODoiQUpBWF9NT0QiO3M6MToiTiI7czoxMzoiU09SVF9TRUNUSU9OUyI7YToxOntzOjQ6IlNPUlQiO3M6MzoiQVNDIjt9czo0OiJTT1JUIjthOjE6e3M6MTI6IkRBVEVfQ1JFQVRFRCI7czo0OiJERVNDIjt9czo0OiJMQU5HIjtzOjI6InJ1IjtzOjEyOiJTRUNUSU9OX0NPREUiO3M6MDoiIjtzOjEwOiJBQk9VVF9QQUdFIjtiOjA7czoxMToiU0VBUkNIX1BBR0UiO2I6MDtzOjE0OiJTRUNUSU9OU19MSU1JVCI7aTo1MDtzOjExOiJTRUNUSU9OX0lEUyI7YTowOnt9czoxNToiSVNfQUxMX0FSVElDTEVTIjtiOjE7czo4OiJQQUdFX05VTSI7aToxO3M6ODoiUEFHRV9WQVIiO3M6NDoicGFnZSI7czo5OiJQQUdFX1NJWkUiO2k6MTI7czo2OiJGSUxURVIiO2E6Mjp7czo2OiJBQ1RJVkUiO3M6MToiWSI7czoxMToiREVQVEhfTEVWRUwiO2k6MTt9czoxMToifkNBQ0hFX1RZUEUiO3M6MToiQSI7czoxMToifkNBQ0hFX1RJTUUiO2k6MzYwMDA7czo5OiJ+QUpBWF9NT0QiO3M6MToiTiI7czoxNDoiflNPUlRfU0VDVElPTlMiO2E6MTp7czo0OiJTT1JUIjtzOjM6IkFTQyI7fXM6NToiflNPUlQiO2E6MTp7czoxMjoiREFURV9DUkVBVEVEIjtzOjQ6IkRFU0MiO31zOjU6In5MQU5HIjtzOjI6InJ1IjtzOjEzOiJ+U0VDVElPTl9DT0RFIjtzOjA6IiI7czoxMToifkFCT1VUX1BBR0UiO2I6MDtzOjEyOiJ+U0VBUkNIX1BBR0UiO2I6MDtzOjE1OiJ+U0VDVElPTlNfTElNSVQiO2k6NTA7czoxMjoiflNFQ1RJT05fSURTIjthOjA6e31zOjE2OiJ+SVNfQUxMX0FSVElDTEVTIjtiOjE7czo5OiJ+UEFHRV9OVU0iO2k6MTtzOjk6In5QQUdFX1ZBUiI7czo0OiJwYWdlIjtzOjEwOiJ+UEFHRV9TSVpFIjtpOjEyO3M6NzoifkZJTFRFUiI7YToyOntzOjY6IkFDVElWRSI7czoxOiJZIjtzOjExOiJERVBUSF9MRVZFTCI7aToxO31zOjk6Ik9QRU5fUEFHRSI7YjowO3M6MTI6IkdFVF9DVVJfUEFHRSI7czozNDoiL3N1bmdsYXNzZXMvcG9saWNlLXNwbGI0Mi0wNzAwLTUzLyI7czoxMjoiRUxFTUVOVF9DT0RFIjtOO30=.f341df22b5e933d7e5780ecfc381bfc699a5c2984515e48cb705293ad5db4aff');
                    ArticlesSlider.setPagination(
                        {'NavNum':'5','NavPageCount':'8','NavPageNomer':'1','NavPageSize':'12','NavRecordCount':'88','NavPageVar':'page','leftGoods':'76','pageItems':'12'}            );
                    ArticlesSlider.setLang('ru');
                }
            });
        </script>
          </main>


@endsection
