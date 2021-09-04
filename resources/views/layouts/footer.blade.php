<footer>
    <div class="footer-top"  >
        <div class="container tabl-full">
            <div class="row">
                <div class="col-xl-3 col-lg-12 con-part">
                    <div class="foot-block">

                        @if(\Illuminate\Support\Facades\DB::table('contacts')->first() != null)

                            <div class="foot-tit js-mobile-show">

                                <span>Контакты</span>
                            </div>
                            <div class="foot-cont">
                                <div class="foot-cont-in">
                                    @if(\Illuminate\Support\Facades\DB::table('contacts')->first()->number != null)
                                    <div class="foot-cont-one">

                                        <div class="foot-cont-top">
                                            Контактный номер телефона
                                        </div>
                                        <div class="foot-cont-info phone-numb">

                                            <a href="tel:{{\Illuminate\Support\Facades\DB::table('contacts')->first()->number}}">
                                                {{\Illuminate\Support\Facades\DB::table('contacts')->first()->number}}
                                            </a>
                                        </div>

                                    </div>
                                    @endif
                                    @if(\Illuminate\Support\Facades\DB::table('contacts')->first()->supports_graph != null)
                                    <div class="foot-cont-one">
                                        <div class="foot-cont-top">
                                            График работы службы поддержки
                                        </div>
                                        <div class="foot-cont-info time-work">
                                            {!! \Illuminate\Support\Facades\DB::table('contacts')->first()->supports_graph !!}
                                        </div>
                                    </div>
                                        @endif
                                    <div class="foot-soc">
                                        @if(\Illuminate\Support\Facades\DB::table('contacts')->first()->facebook != null or \Illuminate\Support\Facades\DB::table('contacts')->first()->instagram != null)
                                            <div class="foot-cont-top">
                                                Следите за нами
                                            </div>
                                            <ul>
                                                <li>
                                                    @if(\Illuminate\Support\Facades\DB::table('contacts')->first()->facebook != null)
                                                        <a href="{{\Illuminate\Support\Facades\DB::table('contacts')->first()->facebook}}"  target="_blank">
                                                            <svg width="40" height="40" viewBox="0 0 20 20" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                      d="M1.10345 0H18.8966C19.1892 0 19.4699 0.116256 19.6768 0.323193C19.8837 0.530129 20 0.810796 20 1.10345V18.8966C20 19.1892 19.8837 19.4699 19.6768 19.6768C19.4699 19.8837 19.1892 20 18.8966 20H13.7931L13.7931 12.2655H16.4034L16.4039 12.2621H16.4207L16.8103 9.23448H13.8103V7.3069C13.8103 6.57897 13.9795 6.04635 14.7571 5.8872C14.9112 5.8571 15.0888 5.84138 15.2931 5.84138H16.8965L16.8966 5.83793V3.13793C16.8 3.12796 16.7035 3.11862 16.6068 3.10991C15.9596 3.05161 15.3101 3.02183 14.6603 3.02067M14.569 3.02069C12.2621 3.02069 10.6897 4.42759 10.6897 7.01034V9.23793H8.08621V12.2655H10.6897V20H1.10345C0.810796 20 0.530129 19.8837 0.323193 19.6768C0.116256 19.4699 0 19.1892 0 18.8966V1.10345C0 0.810796 0.116256 0.530129 0.323193 0.323193C0.530129 0.116256 0.810796 0 1.10345 0"
                                                                      fill="#667780"/>
                                                            </svg>

                                                        </a>
                                                    @endif
                                                </li>
                                                <li>
                                                    @if(\Illuminate\Support\Facades\DB::table('contacts')->first()->instagram != null)
                                                        <a href="{{\Illuminate\Support\Facades\DB::table('contacts')->first()->instagram}}"  target="_blank">
                                                            <svg width="40" height="40" viewBox="0 0 20 20" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.99603 1.80194C12.6667 1.80194 12.9802 1.81385 14.0357 1.86148C15.0119 1.90514 15.5397 2.06787 15.8929 2.20679C16.3611 2.38936 16.6944 2.60369 17.0437 2.95297C17.3929 3.30224 17.6111 3.63564 17.7897 4.10399C17.9246 4.45723 18.0913 4.98512 18.1349 5.9615C18.1825 7.01727 18.1944 7.33082 18.1944 10.002C18.1944 12.6731 18.1825 12.9867 18.1349 14.0425C18.0913 15.0189 17.9286 15.5467 17.7897 15.9C17.6071 16.3683 17.3929 16.7017 17.0437 17.051C16.6944 17.4003 16.3611 17.6186 15.8929 17.7972C15.5397 17.9321 15.0119 18.0988 14.0357 18.1425C12.9802 18.1901 12.6667 18.202 9.99603 18.202C7.3254 18.202 7.0119 18.1901 5.95635 18.1425C4.98016 18.0988 4.45238 17.9361 4.09921 17.7972C3.63095 17.6146 3.29762 17.4003 2.94841 17.051C2.59921 16.7017 2.38095 16.3683 2.20238 15.9C2.06746 15.5467 1.90079 15.0189 1.85714 14.0425C1.80952 12.9867 1.79762 12.6731 1.79762 10.002C1.79762 7.33082 1.80952 7.01727 1.85714 5.9615C1.90079 4.98512 2.06349 4.45723 2.20238 4.10399C2.38492 3.63564 2.59921 3.30224 2.94841 2.95297C3.29762 2.60369 3.63095 2.38539 4.09921 2.20679C4.45238 2.07184 4.98016 1.90514 5.95635 1.86148C7.0119 1.80988 7.3254 1.80194 9.99603 1.80194ZM9.99603 0C7.28175 0 6.94048 0.0119071 5.87302 0.0595356C4.80952 0.107164 4.08333 0.277833 3.44841 0.523913C2.78968 0.777932 2.23413 1.12324 1.67857 1.6789C1.12302 2.23457 0.781746 2.79421 0.523809 3.4491C0.277778 4.08414 0.107143 4.81048 0.0595238 5.87815C0.0119048 6.94185 0 7.28319 0 9.99802C0 12.7128 0.0119048 13.0542 0.0595238 14.1218C0.107143 15.1856 0.277778 15.9119 0.523809 16.5509C0.777778 17.2098 1.12302 17.7654 1.67857 18.3211C2.23413 18.8768 2.79365 19.2181 3.44841 19.4761C4.08333 19.7222 4.80952 19.8928 5.87698 19.9405C6.94444 19.9881 7.28175 20 10 20C12.7183 20 13.0556 19.9881 14.123 19.9405C15.1865 19.8928 15.9127 19.7222 16.5516 19.4761C17.2103 19.2221 17.7659 18.8768 18.3214 18.3211C18.877 17.7654 19.2183 17.2058 19.4762 16.5509C19.7222 15.9159 19.8929 15.1895 19.9405 14.1218C19.9881 13.0542 20 12.7168 20 9.99802C20 7.27922 19.9881 6.94185 19.9405 5.87418C19.8929 4.81048 19.7222 4.08414 19.4762 3.44513C19.2222 2.78627 18.877 2.2306 18.3214 1.67494C17.7659 1.11927 17.2063 0.777932 16.5516 0.519944C15.9167 0.273864 15.1905 0.103195 14.123 0.0555666C13.0516 0.0119071 12.7103 0 9.99603 0Z"
                                                                      fill="#667780"/>
                                                                <path d="M9.99999 4.94531C7.21093 4.94531 4.9453 7.20703 4.9453 10C4.9453 12.793 7.21093 15.0547 9.99999 15.0547C12.7891 15.0547 15.0547 12.7891 15.0547 10C15.0547 7.21094 12.7891 4.94531 9.99999 4.94531ZM9.99999 13.2812C8.18749 13.2812 6.71874 11.8125 6.71874 10C6.71874 8.1875 8.18749 6.71875 9.99999 6.71875C11.8125 6.71875 13.2812 8.1875 13.2812 10C13.2812 11.8125 11.8125 13.2812 9.99999 13.2812Z"
                                                                      fill="#667780"/>
                                                                <path d="M15.2539 5.92578C15.9054 5.92578 16.4336 5.39762 16.4336 4.74609C16.4336 4.09457 15.9054 3.56641 15.2539 3.56641C14.6024 3.56641 14.0742 4.09457 14.0742 4.74609C14.0742 5.39762 14.6024 5.92578 15.2539 5.92578Z"
                                                                      fill="#667780"/>
                                                            </svg>

                                                        </a>
                                                    @endif
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>

                        </div>
                        @endif
                    </div>
                </div>
                <!--  Menu Help -->
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="foot-block">
                        <div class="foot-tit js-mobile-show">
                            <span>Помощь</span>
                        </div>
                        <div class="foot-cont-in">
                            <div class="foot-menu">
                                <ul>

                                    @if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'faq')->first() != null)
                                        <li>
                                            <a href="{{route('add', ['value' => 'faq'])}}">Часто спрашивают</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="/doc_questions/">Задать вопрос</a>
                                    </li>
                                    <li>
                                        <a href="/reviews/">Оставить отзыв</a>
                                    </li>
                                    @if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'how_zdelat_zakaz')->first() != null)
                                        <li>
                                            <a href="{{route('add', ['value' => 'how_zdelat_zakaz'])}}">Как сделать заказ</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- / Menu Help -->
                <!--  Menu Information -->
                <div class="col-xl-3 col-lg-4 col-md-4 col-12" id="foot-menu-hide">
                    <div class="foot-block">
                        <div class="foot-tit js-mobile-show">
                            <span>правовая информация</span>
                        </div>
                        <div class="foot-cont-in">
                            <div class="foot-menu">
                                <ul id="foot-menu">
                                    @if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'terms_of_use')->first() != null)
                                        <li><a href="{{route('add', ['value' => 'terms_of_use'])}}">Пользовательское соглашение</a></li>
                                    @endif
                                    @if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'code_of_ethics')->first() != null)
                                        <li><a href="{{route('add', ['value' => 'code_of_ethics'])}}">Кодекс этики</a></li>
                                    @endif
                                    @if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'privacy_policy')->first() != null)
                                        <li><a href="{{route('add', ['value' => 'privacy_policy'])}}">Политика конфиденциальности</a></li>
                                    @endif
                                    @if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'warranty')->first() != null)
                                        <li><a href="{{route('add', ['value' => 'warranty'])}}">Гарантия</a></li>
                                    @endif
                                    @if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'delivery_terms')->first() != null)
                                        <li><a href="{{route('add', ['value' => 'delivery_terms'])}}">Условия доставки и оплаты</a></li>
                                    @endif
                                    @if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'return_conditions')->first() != null)
                                        <li><a href="{{route('add', ['value' => 'return_conditions'])}}">Условия обмена/возврата</a></li>
                                    @endif
                                    @if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'vacancies')->first() != null)
                                        <li><a href="{{route('add', ['value' => 'vacancies'])}}">Вакансии</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- / Menu Information -->
                <!--  Menu Personal -->
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="foot-block">
                        <div class="foot-tit js-mobile-show">
                            <span>личный кабинет</span>
                        </div>
                        <div class="foot-cont-in">
                            <div class="foot-menu">
                                <ul>
                                    @auth()
                                        <li>
                                            <a href="#">Мой кабинет</a>
                                        </li>
                                    @endauth
                                    @guest()
                                            <li>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">Вход | Регистрация</a>
                                            </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- / Menu Personal -->
            </div>
        </div>
    </div>

    <div class="footer-bot">
        <div class="container tabl-full">
            <div class="footer-bot-left">
                <div class="cards">
                    <div>
                        <p class="cards-text">Принимаем к оплате:</p>
                    </div>
                    <a href="javascript:void(0)">
                        <img src="{{asset('/assets/img/visa.svg')}}" alt="Visa">
                    </a>
                    <a href="javascript:void(0)">
                        <img src="{{ asset('/assets/img/mastercard.svg')}}" alt="MasterCard">
                    </a>
                </div>
            </div>

            <div class="foot-bot-right">
                <div class="foot-logo">
                    <a href="/">
                        <img src="{{ asset('/assets/img/logo.svg')}}" alt="">
                    </a>
                </div>
                <div class="foot-copy">
                    © {{ date('Y') }} Все права защищены
                </div>
            </div>


        </div>
    </div>
</footer>
<script>
    if(document.getElementById('foot-menu').innerHTML.trim() === '') {
        document.getElementById('foot-menu-hide').remove()
    }
</script>
