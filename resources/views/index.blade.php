@extends('layouts.layout')
@section('content')




    <div class="container">
        <div style="float: left; width: 100%; background-color: #fff; padding: 50px 0;">
            <div style="margin-bottom: 30px; font-size: 24px; font-weight: 600; text-transform: uppercase; text-align: center; letter-spacing: .2em;">
                Топ продаж
            </div>
            <div class="list-nav">
                <ul id="scrollcategory">
                    <li class="active"><a data-catalog="2" data-tab="tab1" href="javascript:void(0);"><span>Контактные линзы</span></a></li>
                    <li class><a data-catalog="1" data-tab="tab2" href="javascript:void(0);"><span>Оправы</span></a></li>
                    <li class><a data-catalog="3" data-tab="tab3" href="javascript:void(0);"><span>Солнцезащитные очки</span></a></li>
                </ul>
            </div>
            <div style="float: left; width: 100%; position: relative; padding: 30px 40px 0">
                <div style="height: 350px; overflow: hidden;">
                    <div data-x="0" data-count="{{count(((array) json_decode($all))['lenses'])}}" style="width: {{9*363}}px; transform: translateX(0px); transition: all .8s" id="scrolim">
                        @foreach(((array) json_decode($all))['lenses'] as $lense)
                            <div  style="width: 363px; float: left;">
                                <div style="float: left; position: relative; width: 100%;">
                                    <a href="{{route('product', ['id' => $lense->product_id])}}" style="position: absolute; left: 0; top:0; width: 100%; height: 100%; z-index: 1; display: block; cursor: pointer;"></a>
                                    <div style="position: relative; height: 240px; margin-bottom: 25px; width: 100%; display: -webkit-box; display: flex; align-content: center; -webkit-box-align: center; align-items: center; -webkit-box-pack: center; justify-content: center;">
                                        <span>
                                            <picture>
                                                <img src="{{asset("public/storage/{$lense->img}")}}" loading="lazy" style="max-height: 240px; width: auto; max-width: 363px;">
                                            </picture>
                                        </span>
                                    </div>
                                    <div style="position: relative; z-index: 2; padding: 0 20px; overflow: hidden; height: 40px; margin-bottom: 10px; text-transform: uppercase; line-height: 19px; display: -webkit-box; display: flex; -webkit-box-pack: center; justify-content: center; text-align: left;">
                                        <style>
                                            .sliderlink {
                                                color: #37474f; text-decoration: none; -webkit-transition: all .3s; transition: all .3s; text-transform: uppercase;
                                            }
                                        </style>
                                        <a href="{{route('product', ['id' => $lense->product_id])}}" class="sliderlink">Контактные линзы {{$lense->name}}</a>
                                    </div>
                                    <div style="text-align: center; font-size: 20px; padding: 0 5px;">
                                        <div style="display: inline-block; margin: 0 15px; display: inline-block; margin-right: 10px; font-size: 18px;">
                                            {{$lense->price}} грн
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

{{--                <div style="margin: 0; height: 5px; background: transparent; position: relative; bottom: -35px;">--}}
{{--                    <div style="width: 466px; width: 100px; height: 100%; background: #e1e4e5; cursor: pointer; border-radius: 3px;">--}}
{{--                        <div style="position: absolute; top: -9px; left: 0; width: 100%; height: 20px;"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div style="position: absolute; top: 50%; left: 0; width: 100%; margin-top: -25px;" id="controlcenter">
                    <style>
                        .disabled {
                            opacity: 0;
                            visibility: hidden;
                        }
                    </style>
                    <button class="prev disabled" style="left: -25px; -webkit-transform: rotate( 180deg ); transform: rotate( 180deg ); border: none; background-color: #e1e4e6; position: absolute; border-radius: 50%; width: 50px; height: 50px; cursor: pointer; -webkit-transition: all .3s; transition: all .3s;"><span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.30006 7.00056C0.747774 7.00056 0.314975 7.44802 0.333374 8C0.351773 8.55198 0.814404 8.99944 1.36669 8.99944L1.30006 7.00056ZM15.3974 8.70671C15.7749 8.31641 15.7538 7.68359 15.3503 7.29329L8.77428 0.932857C8.37075 0.54255 7.73758 0.54255 7.36007 0.932857C6.98255 1.32316 7.00365 1.95598 7.40718 2.34629L13.2525 8L7.7841 13.6537C7.40658 14.044 7.42768 14.6768 7.83121 15.0671C8.23475 15.4575 8.86791 15.4575 9.24543 15.0671L15.3974 8.70671ZM1.36669 8.99944H14.7L14.6334 7.00056H1.30006L1.36669 8.99944Z" fill="#667780"></path></svg></span></button>
                    <button class="next @if(((array) json_decode($all))['lenses'] <= 3) disabled @endif" style="right: -25px; border: none; background-color: #e1e4e6; position: absolute; border-radius: 50%; width: 50px; height: 50px; cursor: pointer; -webkit-transition: all .3s; transition: all .3s;"><span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.30006 7.00056C0.747774 7.00056 0.314975 7.44802 0.333374 8C0.351773 8.55198 0.814404 8.99944 1.36669 8.99944L1.30006 7.00056ZM15.3974 8.70671C15.7749 8.31641 15.7538 7.68359 15.3503 7.29329L8.77428 0.932857C8.37075 0.54255 7.73758 0.54255 7.36007 0.932857C6.98255 1.32316 7.00365 1.95598 7.40718 2.34629L13.2525 8L7.7841 13.6537C7.40658 14.044 7.42768 14.6768 7.83121 15.0671C8.23475 15.4575 8.86791 15.4575 9.24543 15.0671L15.3974 8.70671ZM1.36669 8.99944H14.7L14.6334 7.00056H1.30006L1.36669 8.99944Z" fill="#667780"></path></svg></span></button>
                </div>
            </div>
        </div>
    </div>
    <div id="productscategory" hidden>
        {{$all}}
    </div>
    <script>
        document.querySelector('#controlcenter').addEventListener('click', e => {
            const elem = document.querySelector('#scrolim')
            const prev = document.querySelector('.prev')
            const next = document.querySelector('.next')
            let n = (Math.abs(+elem.dataset.x) + 363*3)/363
            console.log(n)
            if(e.target.classList.contains('prev') || e.target.closest('button').classList.contains('prev')){
                elem.dataset.x = n - 3 >= 3 ? +elem.dataset.x + 363*3 : +elem.dataset.x + (n - 3)*363
                elem.style.transform = `translateX(${elem.dataset.x}px)`
                next.classList.remove('disabled')
                if(+elem.dataset.x === 0){
                    prev.classList.add('disabled')
                }
            }
            if(e.target.classList.contains('next') || e.target.closest('button').classList.contains('next')){
                elem.dataset.x = +elem.dataset.count - n >= 3 ? +elem.dataset.x - 363*3 : +elem.dataset.x - (+elem.dataset.count - n)*363
                elem.style.transform = `translateX(${elem.dataset.x}px)`
                prev.classList.remove('disabled')
                if((Math.abs(+elem.dataset.x) + 363*3)/363 - +elem.dataset.count === 0) {
                    next.classList.add('disabled')
                }
            }
        })
        document.querySelector('#scrollcategory').addEventListener('click', e => {
            if (e.target.textContent === 'Солнцезащитные очки') {
                e.target.closest('ul').querySelector('.active').classList.remove('active')
                e.target.closest('[data-tab="tab3"]').classList.add('active')
                const items = JSON.parse(document.getElementById('productscategory').textContent)['glasses']

                const html = items.map(i =>
                    `
                    <div  style="width: 363px; float: left;">
                                <div style="float: left; position: relative; width: 100%;">
                                    <a href="/product/${i.product_id}" style="position: absolute; left: 0; top:0; width: 100%; height: 100%; z-index: 1; display: block; cursor: pointer;"></a>
                                    <div style="position: relative; height: 240px; margin-bottom: 25px; width: 100%; display: -webkit-box; display: flex; align-content: center; -webkit-box-align: center; align-items: center; -webkit-box-pack: center; justify-content: center;">
                                        <span>
                                            <picture>
                                                <img src="/public/storage/${i.img}" loading="lazy" style="max-height: 240px; width: auto; max-width: 363px;">
                                            </picture>
                                        </span>
                                    </div>
                                    <div style="position: relative; z-index: 2; padding: 0 20px; overflow: hidden; height: 40px; margin-bottom: 10px; text-transform: uppercase; line-height: 19px; display: -webkit-box; display: flex; -webkit-box-pack: center; justify-content: center; text-align: left;">
                                        <style>
                                            .sliderlink {
                                                color: #37474f; text-decoration: none; -webkit-transition: all .3s; transition: all .3s; text-transform: uppercase;
                                            }
                                        </style>
                                        <a href="/product/${i.product_id}" class="sliderlink">Солнцезащитные очки ${i.name}</a>
                                    </div>
                                    <div style="text-align: center; font-size: 20px; padding: 0 5px;">
                                        <div style="display: inline-block; margin: 0 15px; display: inline-block; margin-right: 10px; font-size: 18px;">
                                            ${i.price} грн
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `
                ).join(' ')
                document.getElementById('scrolim').dataset.count = +items.length
                document.getElementById('scrolim').dataset.x = 0
                document.getElementById('scrolim').style.transform = `translateX(0px)`
                document.querySelector('.prev').classList.add('disabled')
                if(+items.length <= 3) {
                    document.querySelector('.next').classList.add('disabled')
                }
                else {
                    document.querySelector('.next').classList.remove('disabled')
                }
                document.getElementById('scrolim').innerHTML = html
            }
            if (e.target.textContent === 'Оправы') {
                e.target.closest('ul').querySelector('.active').classList.remove('active')
                e.target.closest('[data-tab="tab2"]').classList.add('active')
                const items = JSON.parse(document.getElementById('productscategory').textContent)['frames']

                const html = items.map(i =>
                    `
                    <div  style="width: 363px; float: left;">
                                <div style="float: left; position: relative; width: 100%;">
                                    <a href="/product/${i.product_id}" style="position: absolute; left: 0; top:0; width: 100%; height: 100%; z-index: 1; display: block; cursor: pointer;"></a>
                                    <div style="position: relative; height: 240px; margin-bottom: 25px; width: 100%; display: -webkit-box; display: flex; align-content: center; -webkit-box-align: center; align-items: center; -webkit-box-pack: center; justify-content: center;">
                                        <span>
                                            <picture>
                                                <img src="/public/storage/${i.img}" loading="lazy" style="max-height: 240px; width: auto; max-width: 363px;">
                                            </picture>
                                        </span>
                                    </div>
                                    <div style="position: relative; z-index: 2; padding: 0 20px; overflow: hidden; height: 40px; margin-bottom: 10px; text-transform: uppercase; line-height: 19px; display: -webkit-box; display: flex; -webkit-box-pack: center; justify-content: center; text-align: left;">
                                        <style>
                                            .sliderlink {
                                                color: #37474f; text-decoration: none; -webkit-transition: all .3s; transition: all .3s; text-transform: uppercase;
                                            }
                                        </style>
                                        <a href="/product/${i.product_id}" class="sliderlink">Оправа ${i.name}</a>
                                    </div>
                                    <div style="text-align: center; font-size: 20px; padding: 0 5px;">
                                        <div style="display: inline-block; margin: 0 15px; display: inline-block; margin-right: 10px; font-size: 18px;">
                                            ${i.price} грн
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `
                ).join(' ')
                document.getElementById('scrolim').dataset.count = +items.length
                document.getElementById('scrolim').dataset.x = 0
                document.getElementById('scrolim').style.transform = `translateX(0px)`
                document.querySelector('.prev').classList.add('disabled')
                if(+items.length <= 3) {
                    document.querySelector('.next').classList.add('disabled')
                }
                else {
                    document.querySelector('.next').classList.remove('disabled')
                }
                document.getElementById('scrolim').innerHTML = html
            }
            if (e.target.textContent === 'Контактные линзы') {
                e.target.closest('ul').querySelector('.active').classList.remove('active')
                e.target.closest('[data-tab="tab1"]').classList.add('active')
                const items = JSON.parse(document.getElementById('productscategory').textContent)['lenses']

                const html = items.map(i =>
                    `
                    <div  style="width: 363px; float: left;">
                                <div style="float: left; position: relative; width: 100%;">
                                    <a href="/product/${i.product_id}" style="position: absolute; left: 0; top:0; width: 100%; height: 100%; z-index: 1; display: block; cursor: pointer;"></a>
                                    <div style="position: relative; height: 240px; margin-bottom: 25px; width: 100%; display: -webkit-box; display: flex; align-content: center; -webkit-box-align: center; align-items: center; -webkit-box-pack: center; justify-content: center;">
                                        <span>
                                            <picture>
                                                <img src="/public/storage/${i.img}" loading="lazy" style="max-height: 240px; width: auto; max-width: 363px;">
                                            </picture>
                                        </span>
                                    </div>
                                    <div style="position: relative; z-index: 2; padding: 0 20px; overflow: hidden; height: 40px; margin-bottom: 10px; text-transform: uppercase; line-height: 19px; display: -webkit-box; display: flex; -webkit-box-pack: center; justify-content: center; text-align: left;">
                                        <style>
                                            .sliderlink {
                                                color: #37474f; text-decoration: none; -webkit-transition: all .3s; transition: all .3s; text-transform: uppercase;
                                            }
                                        </style>
                                        <a href="/product/${i.product_id}" class="sliderlink">Контактные линзы ${i.name}</a>
                                    </div>
                                    <div style="text-align: center; font-size: 20px; padding: 0 5px;">
                                        <div style="display: inline-block; margin: 0 15px; display: inline-block; margin-right: 10px; font-size: 18px;">
                                            ${i.price} грн
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `
                ).join(' ')
                document.getElementById('scrolim').dataset.count = +items.length
                document.getElementById('scrolim').dataset.x = 0
                document.getElementById('scrolim').style.transform = `translateX(0px)`
                document.querySelector('.prev').classList.add('disabled')

                if(+items.length <= 3) {
                    document.querySelector('.next').classList.add('disabled')
                }
                else {
                    document.querySelector('.next').classList.remove('disabled')
                }
                document.getElementById('scrolim').innerHTML = html
            }
        })
    </script>



@endsection

