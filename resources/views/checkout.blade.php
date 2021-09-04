@section('basket')
@endsection
@extends('layouts.layout')
@section('content')

    <section id="sale_order" class="mt-5">
        <div class="container mob-full">
            <div class="bask-page">
                <form action="{{route('order.create')}}" class="row" method="POST" id="checkout_main_form" autocomplete="off"  novalidate>
                    @csrf
                    <div class="col bask-page-wrap">
                        <div class="bask-page-tit">оформление заказа</div>
                        <div class="checkout-step">

                            <div data-step="1" class="one-check-step active" style="cursor: default!important">
                                <div class="one-check-step-top js-title-step"><i>1</i><span>Личные данные</span></div>
                                <div class="one-check-step-descr" style="display: block;">

                                    <div id="myTabContent-log" class="tab-content">
                                        <div id="tab-log-1" role="tabpanel" aria-labelledby="tab-log-1-tab" class="tab-pane fade show active">
                                            <div class="check-log-form">
                                                <div class="one-check-log">
                                                    <div class="one-check-inp ">
                                                        <input type="text" placeholder="Имя и фамилия" name="name" value="{{\Illuminate\Support\Facades\Auth::user()->name}}" data-id="1" data-code="NAME" data-type="text" class="checkout-user-prop check-step-1">
                                                        <div class="help-block error-mess"></div>
                                                    </div>
                                                    <div class="one-check-name">На эти имя и фамилию будет оформлен заказ</div>
                                                </div>
                                                <div class="one-check-log">
                                                    <div class="one-check-inp ">
                                                        <input @if(\Illuminate\Support\Facades\Auth::user()->number != null) readonly style="background-color: rgba(128, 128, 128, 0.1);" @endif type="text" placeholder="Телефон" id="phone" name="number" value="{{\Illuminate\Support\Facades\Auth::user()->number}}" data-id="3" class="checkout-user-prop js-phone-mask check-step-1" maxlength="19">
                                                        <script>
                                                            $(function () {
                                                                $('#phone').mask("+38(099)999-99-99")
                                                            })

                                                        </script>
                                                        <div class="help-block error-mess"></div>
                                                    </div>
                                                    <div class="one-check-name">Телефон нужен для подтверждения заказа</div>
                                                </div>
                                                <div class="one-check-log">
                                                    <div class="one-check-inp ">
                                                        <input @if(\Illuminate\Support\Facades\Auth::user()->email != null) readonly style="background-color: rgba(128, 128, 128, 0.1);" @endif type="text" placeholder="E-mail" name="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}" data-id="4" data-code="EMAIL" data-type="mail" class="checkout-user-prop check-step-1">
                                                        <div class="help-block error-mess"></div>
                                                    </div>
                                                    <div class="one-check-name">На e-mail мы пришлем подробности по заказу</div>
                                                </div>
                                                <div class="check-bt-next"><button type="button" class="def-big-bt js-bt-step" id="check-step-1" data-next="2" data-now="1" >Далее</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-step="2" class="one-check-step" style="cursor: default!important">
                                <div class="one-check-step-top js-title-step"><i>2</i><span>Доставка</span></div>
                                <div class="one-check-step-descr">
                                    <div class="list-nav">
                                        <ul id="myTab-log" role="tablist" class="nav">

                                            <li><a id="tab-delivery-1-tab" class="deliveryType active load_delivery3" data-load="N" data-toggle="tab"  role="tab" aria-controls="tab-delivery-1" aria-selected="false" data-delivery-id="3"><div id="courieron">курьером</div></a></li>
                                            <li><a id="tab-delivery-2-tab" class="deliveryType  load_delivery4" data-load="N" data-toggle="tab" role="tab" aria-controls="tab-delivery-2" aria-selected="false" data-delivery-id="4"><div id="na_sklad">на отделение Новой Почты</div></a></li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <div id="myTabContent-delivery" class="tab-content">
                                        <div id="tab-delivery-1" role="tabpanel" aria-labelledby="tab-delivery-1-tab" class="tab-pane fade show active">
                                            <br>
                                            <div class="check-has-log-form" >
                                                <div class="one-check-log">
                                                    <div class="one-check-inp">
                                                        <input type="text" name="city_c" placeholder="Введите свой город">
                                                    </div>
                                                </div>
                                                <div class="one-check-log">
                                                    <div class="one-check-inp">
                                                        <input type="text" name="region" placeholder="Введите свою область">
                                                    </div>
                                                </div>
                                                <div class="one-check-log">
                                                    <div class="one-check-inp">
                                                        <input type="text" name="street" placeholder="Введите свою улицу">
                                                    </div>
                                                </div>
                                                <div class="one-check-log">
                                                    <div class="one-check-inp half">
                                                        <input type="text" placeholder="Дом" name="house_number">
                                                    </div>
                                                    <div class="one-check-inp half">
                                                        <input type="text" placeholder="Квартира" name="apartment">
                                                    </div>
                                                </div>
                                                <div class="one-check-log">
                                                    <div class="one-check-inp">
                                                        <textarea placeholder="Комментарий к доставке" name="commentary_c"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="tab-delivery-2" role="tabpanel" aria-labelledby="tab-delivery-2-tab" class="tab-pane fade ">


                                            <br>
                                            <div class="check-has-log-form" >
                                                <div class="one-check-log">
                                                    <div class="one-check-inp">
                                                        <input type="text" name="city_p" placeholder="Введите свой город">
                                                    </div>
                                                </div>
                                                <div class="one-check-log">
                                                    <div class="one-check-inp">
                                                        <input type="text" name="region_p" placeholder="Введите свою область">
                                                    </div>
                                                </div>
                                                <div class="one-check-log">
                                                    <div class="one-check-inp">
                                                        <style>
                                                            input::-webkit-outer-spin-button,
                                                            input::-webkit-inner-spin-button {
                                                                -webkit-appearance: none;
                                                            }
                                                        </style>
                                                        <input type="number" name="store" placeholder="Введите номер склада">
                                                    </div>
                                                </div>
                                                <div class="one-check-log">
                                                    <div class="one-check-inp">
                                                        <textarea placeholder="Комментарий к доставке" name="commentary_p"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="check-bt-next">
                                            <button type="button" class="def-big-bt js-bt-step " id="check-step-2" data-next="3" data-now="2">Далее</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div data-step="3" class="one-check-step" style="cursor: default!important" hidden>
                                <div class="one-check-step-top js-title-step"><i>3</i><span>Оплата</span></div>
                                <div class="one-check-step-descr">
                                    <div id="pay-check" class="pay-check">
                                        <div class="one-prod-radio">
                                            <label>
                                                <input checked type="radio" name="payment" value="cash">
                                                <span class="one-prod-radio-body"><i></i>
														<span class="one-prod-radio-descr">
															<span class="one-prod-radio-name"><span class="one-prod-radio-tit">	Наличными при получении</span></span>
														</span>
													</span>
                                            </label>
                                        </div>
                                        <div class="one-prod-radio">
                                            <label>
                                                <input type="radio" name="payment" value="card">
                                                <span class="one-prod-radio-body"><i></i>
														<span class="one-prod-radio-descr">
															<span class="one-prod-radio-name"><span class="one-prod-radio-tit">	Visa/MasterCard</span></span>
														</span>
													</span>
                                            </label>
                                        </div>


                                    </div>
                                    <div class="check-bt-next">
                                        <button type="button" id="check-step-3" data-next="4" data-now="3" class="def-big-bt js-bt-step">Далее</button>
                                    </div>
                                </div>
                            </div>


                            <div data-step="4" class="one-check-step" style="cursor: default!important">
                                <div class="one-check-step-top js-title-step"><i>3</i><span>подтверждение</span></div>
                                <div class="one-check-step-descr">
                                    <div class="check-detal">
                                        <div class="check-detal-tit">Детали заказа</div>
                                        <div class="one-check-detal">
                                            <ul>
                                                <li><span class="name">Имя и фамилия</span> <span class="val" id="name"></span></li>
                                                <li><span class="name">Телефон</span> <span class="val" id="number"></span></li>
                                                <li><span class="name">E-mail</span> <span class="val" id="email"></span></li>
                                            </ul>
                                        </div>
                                        <div class="one-check-detal">
                                            <ul>
                                                <li><span class="name">Способ доставки</span> <span class="val" id="deliverytype"></span></li>
                                                <li><span class="name">Адрес</span> <span class="val" id="address"></span></li>
                                                <li><span class="name">Комментарий</span> <span class="val" id="commentary"></span></li>
                                            </ul>
                                        </div>
                                        <div class="one-check-detal">
                                            <ul>
                                                <li><span class="name">Способ оплаты</span> <span class="val"  id="paytype"></span></li>
                                            </ul>
                                        </div>
                                        <div class="one-check-detal detal-sum">
                                            <ul>
                                                @php
                                                    $sum = 0;
                                                    foreach ($oproducts as $product) {
                                                        $p = \App\Models\Product::where('id', $product->product_id)->first();
                                                        $sum += $p->price * $product->count;
                                                    }
                                                @endphp
                                                <li><span class="name">К оплате</span> <span class="val fulSumToPay">{{$sum}} грн</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="check-bt-next center-bt"><button type="submit" class="def-big-bt checkoutsubmit">подтвердить заказ</button></div>

                                </div>
                            </div>
                            <div class="saveOrderMess mt-2" style="display:none; font-size: 17px; color: #0dac49; padding: 0 0 25px 10px;">Создание заказа...</div>
                        </div>
                    </div>


                    <div class=" col-4 check-right-part">
                        <div class="bask-page-detal detal-check-bask">
                            <div class="bask-detal-sum">
                                <div class="fast-call-tit">Информация о заказе</div>
                                <div id="reloadInfo">
                                    <div class="checkout-bask max-item">
                                        @foreach($oproducts as $product)
                                            @php
                                                $p = \App\Models\Product::where('id', $product->product_id)->first();
                                            @endphp
                                        <div class="bask-item" >


                                            <div class="bask-item-thumb">
                                                <a href="{{route('product',['id' => $product->product_id])}}"><img src="{{ asset("public/storage/".$p->img) }}" alt=""></a>
                                            </div>
                                            <div class="bask-item-descr">

                                                <div class="bask-item-tit">
                                                    <a href="{{route('product',['id' => $product->product_id])}}">
                                                        @if($p->category == 'frame')
                                                            Оправа
                                                        @elseif($p->category == 'lenses')
                                                            Контактные линзы
                                                        @elseif($p->category == 'glasses')
                                                            Очки
                                                        @endif
                                                        {{$p->name}}
                                                     </a>
                                                </div>
                                                <div class="bask-item-info">
                                                    <div class="bask-item-price">
                                                        <div class="now-price">{{$p->price}} <span>грн</span></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="{{$product->id}}" data-name="{{$p->name}}" data-id="{{$p->id}}" data-price="{{$p->price}}" data-category="{{$p->category}}" data-quantity="{{$product->count}}"></div>
                                        @endforeach
                                            <div class="bask-detal-descr">
                                            <div class="bask-detal-name">
                                                <span>Итого</span>
                                            </div>
                                            <div class="bask-detal-val">
                                                <span class="fulSumToPay">{{$sum}} грн</span>
                                            </div>

                                            <div id="nedThis" data-have="" data-can="0"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>


                document.querySelector('#check-step-1').addEventListener('click', event => {
                    document.querySelectorAll('.error').forEach(i => {
                        i.classList.remove('error')
                        i.querySelector('div').remove()
                    })
                    let check = []
                    document.querySelectorAll('.check-log-form>.one-check-log>.one-check-inp>input').forEach(i => {
                        if(i.value.trim() === '') {
                            check.push(i.getAttribute('name'))
                        }
                    })
                    if (check.length === 0) {
                        document.querySelector('[data-step="1"]').classList.remove('active')
                        document.querySelector('[data-step="1"]').classList.add('done')
                        document.querySelector('[data-step="1"]').style.height = '40px'
                        document.querySelector('#tab-log-1').classList.remove('show')
                        document.querySelector('#tab-log-1').classList.remove('active')
                        document.querySelector('#tab-delivery-1').classList.add('show')
                        document.querySelector('#tab-delivery-1').classList.add('active')
                        document.querySelector('[data-step="2"]').style.minHeight = '612px'
                        document.querySelector('[data-step="2"]>.one-check-step-descr').style.setProperty('display', 'block', 'important')
                        document.querySelector('[data-step="2"]').classList.add('active')
                    }  else {
                        check.forEach(i => {
                            const elem = document.querySelector(`input[name="${i}"]`)
                            elem.insertAdjacentHTML('afterend', '<div class="help-block error-mess">Обязательное для заполнения поле</div>')
                            elem.parentNode.classList.add('error')
                        })
                    }
                })

                document.querySelector('#myTab-log').addEventListener('click', event => {
                    if(event.target.id === 'courieron') {
                        document.querySelector('#tab-delivery-2-tab').classList.remove('active')
                        document.querySelector('#tab-delivery-1-tab').classList.add('active')
                        document.querySelector('#tab-delivery-2').classList.remove('active')
                        document.querySelector('#tab-delivery-2').classList.remove('show')
                        document.querySelector('#tab-delivery-1').classList.add('active')
                        document.querySelector('#tab-delivery-1').classList.add('show')
                        document.querySelector('[data-step="2"]').style.minHeight = '612px'

                    }
                    if(event.target.id === 'na_sklad') {
                        document.querySelector('#tab-delivery-1-tab').classList.remove('active')
                        document.querySelector('#tab-delivery-2-tab').classList.add('active')
                        document.querySelector('#tab-delivery-1').classList.remove('active')
                        document.querySelector('#tab-delivery-1').classList.remove('show')
                        document.querySelector('#tab-delivery-2').classList.add('active')
                        document.querySelector('#tab-delivery-2').classList.add('show')
                        document.querySelector('[data-step="2"]').style.minHeight = '150px'
                    }
                })

                document.querySelector('#check-step-2').addEventListener('click', event => {
                    document.querySelectorAll('.error').forEach(i => {
                        i.classList.remove('error')
                        i.querySelector('div').remove()
                    })
                    let check = []
                    if(document.querySelector('#tab-delivery-1-tab').classList.contains('active')){
                        document.querySelectorAll('#tab-delivery-1>.check-has-log-form>.one-check-log>.one-check-inp>input').forEach(i => {
                            console.log(i.getAttribute('name'))
                            if(i.value.trim() === '' && i.getAttribute('name') != 'apartment') {
                                check.push(i.getAttribute('name'))
                            }
                        })
                    }
                    else {
                        document.querySelectorAll('#tab-delivery-2>.check-has-log-form>.one-check-log>.one-check-inp>input').forEach(i => {
                            if(i.value.trim() === '') {
                                check.push(i.getAttribute('name'))
                            }
                        })
                    }

                    if (check.length === 0) {
                        // document.querySelector('[data-step="2"]').classList.remove('active')
                        // document.querySelector('[data-step="2"]').classList.add('done')
                        // document.querySelector('[data-step="2"]').style.height = '40px'
                        // document.querySelector('[data-step="2"]').style.minHeight = '0px'
                        // document.querySelector('[data-step="3"]').style.minHeight = '0px'
                        // document.querySelector('[data-step="2"]>.one-check-step-descr').style.setProperty('display', 'none', 'important')
                        // document.querySelector('[data-step="3"]>.one-check-step-descr').style.setProperty('display', 'block', 'important')
                        // document.querySelector('[data-step="3"]').classList.add('active')
                        document.querySelector('[data-step="2"]').classList.remove('active')
                        document.querySelector('[data-step="2"]').classList.add('done')
                        document.querySelector('[data-step="2"]').style.height = '40px'
                        document.querySelector('[data-step="2"]').style.minHeight = '0px'
                        document.querySelector('[data-step="4"]').style.minHeight = '0px'
                        document.querySelector('[data-step="2"]>.one-check-step-descr').style.setProperty('display', 'none', 'important')
                        document.querySelector('[data-step="4"]>.one-check-step-descr').style.setProperty('display', 'block', 'important')
                        document.querySelector('[data-step="4"]').classList.add('active')
                        document.getElementById('name').textContent = document.querySelector('[name="name"]').value
                        document.getElementById('number').textContent = document.querySelector('[name="number"]').value
                        document.getElementById('email').textContent = document.querySelector('[name="email"]').value
                        document.getElementById('deliverytype').textContent = document.querySelector('#tab-delivery-1-tab').classList.contains('active') ? 'Курьером' : 'На отделение Новой Почты'
                        document.getElementById('address').textContent = document.querySelector('#tab-delivery-1-tab').classList.contains('active') ?  `г. ${document.querySelector('[name="city_c"]').value}, обл. ${document.querySelector('[name="region"]').value},ул. ${document.querySelector('[name="street"]').value}, д. ${document.querySelector('[name="house_number"]').value}${(document.querySelector('[name="apartment"]').value).trim() === '' ? '' : `, кв. ${document.querySelector('[name="apartment"]').value}`}` : `г. ${document.querySelector('[name="city_p"]').value}, обл. ${document.querySelector('[name="region_p"]').value}, отделение №${document.querySelector('[name="store"]').value}`
                        document.getElementById('commentary').textContent = document.querySelector('#tab-delivery-1-tab').classList.contains('active') ? document.querySelector('[name="commentary_c"]').value : document.querySelector('[name="commentary_p"]').value
                        document.getElementById('paytype').textContent = document.querySelector('input[value="cash"]').checked ? 'Наличными при получении' : 'Visa/MasterCard'
                    }  else {
                        check.forEach(i => {
                            const elem = document.querySelector(`input[name="${i}"]`)
                            elem.insertAdjacentHTML('afterend', '<div class="help-block error-mess">Обязательное для заполнения поле</div>')
                            elem.parentNode.classList.add('error')
                        })
                    }
                })

                // document.querySelector('#check-step-3').addEventListener('click', event => {
                //     document.querySelectorAll('.error').forEach(i => {
                //         i.classList.remove('error')
                //         i.querySelector('.help-block.error-mess').remove()
                //     })
                //     let check = []
                //     document.querySelectorAll('input[name="payment"]').forEach(i => {
                //         if (i.checked) {
                //             check.push(i.value)
                //         }
                //     })
                //
                //     if (check.length != 0) {
                //         document.querySelector('[data-step="3"]').classList.remove('active')
                //         document.querySelector('[data-step="3"]').classList.add('done')
                //         document.querySelector('[data-step="3"]').style.height = '40px'
                //         document.querySelector('[data-step="3"]').style.minHeight = '0px'
                //         document.querySelector('[data-step="4"]').style.minHeight = '0px'
                //         document.querySelector('[data-step="3"]>.one-check-step-descr').style.setProperty('display', 'none', 'important')
                //         document.querySelector('[data-step="4"]>.one-check-step-descr').style.setProperty('display', 'block', 'important')
                //         document.querySelector('[data-step="4"]').classList.add('active')
                //         document.getElementById('name').textContent = document.querySelector('[name="name"]').value
                //         document.getElementById('number').textContent = document.querySelector('[name="number"]').value
                //         document.getElementById('email').textContent = document.querySelector('[name="email"]').value
                //         document.getElementById('deliverytype').textContent = document.querySelector('#tab-delivery-1-tab').classList.contains('active') ? 'Курьером' : 'На отделение Новой Почты'
                //         document.getElementById('address').textContent = document.querySelector('#tab-delivery-1-tab').classList.contains('active') ?  `г. ${document.querySelector('[name="city_c"]').value}, обл. ${document.querySelector('[name="region"]').value},ул. ${document.querySelector('[name="street"]').value}, д. ${document.querySelector('[name="house_number"]').value}${(document.querySelector('[name="apartment"]').value).trim() === '' ? '' : `, кв. ${document.querySelector('[name="apartment"]').value}`}` : `г. ${document.querySelector('[name="city_p"]').value}, обл. ${document.querySelector('[name="region_p"]').value}, отделение №${document.querySelector('[name="store"]').value}`
                //         document.getElementById('commentary').textContent = document.querySelector('#tab-delivery-1-tab').classList.contains('active') ? document.querySelector('[name="commentary_c"]').value : document.querySelector('[name="commentary_p"]').value
                //         document.getElementById('paytype').textContent = document.querySelector('input[value="cash"]').checked ? 'Наличными при получении' : 'Visa/MasterCard'
                //     }  else {
                //         const elem = document.querySelector(`#pay-check`)
                //         elem.insertAdjacentHTML('afterend', '<div class="help-block error-mess mb-2">Обязательно выбрать</div>')
                //         elem.parentNode.classList.add('error')
                //     }
                // })
                document.querySelector('.checkoutsubmit').addEventListener('click', event => {
                    document.querySelector('.bask-page-wrap').insertAdjacentHTML('beforeend', `<input name="address" value="${document.getElementById('address').textContent}" hidden> <input name="commentary" value="${document.getElementById('commentary').textContent}" hidden>`)
                    document.querySelector('[data-step="4"]>.one-check-step-descr').style.setProperty('display', 'none', 'important')
                    document.querySelector('[data-step="4"]').classList.add('done')
                    document.querySelector('[data-step="4"]').style.height = '40px'
                    document.querySelector('.saveOrderMess').style.setProperty('display', 'block', 'important')

                })

    </script>
@endsection
