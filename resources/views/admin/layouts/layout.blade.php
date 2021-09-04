<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@section('title')Admin ::  @show</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.index') }}" class="nav-link">Home</a>
            </li>

        </ul>

        <!-- SEARCH FORM -->


        <!-- Right navbar links -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" target="_blank" class="brand-link">
            <img src="{{ asset('assets/admin/img/AdminLTELogo.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">На сайт</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
{{--                <div class="image">--}}
{{--                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->avatar }}" class="img-circle elevation-2"--}}
{{--                         alt="User Image">--}}
{{--                </div>--}}
                <div class="info">
                    <a class="d-block">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Главная</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Товары
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список товаров</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Новый товар</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Заказы
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список заказов</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('orders.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Новый заказ</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>
                                Диагностика
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('diagnostics.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список записей</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('diagnostics.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Новая запись</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('diagnostics.settings') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Настройка записей</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Пользователи
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список пользователей</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Добавить пользователя</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-phone-square-alt"></i>
                            <p id="allcount">
                                Обратная Связь
                                <i class="right fas fa-angle-left"></i>
                                @if(\App\Models\Question::where('user_id', '=', NULL)->count())
                                    <span class="badge badge-info right counter">
                                            @if(\App\Models\Question::where('user_id', '=', NULL)->count() > 99)
                                            99+
                                        @else
                                            {{\App\Models\Question::where('user_id', '=', NULL)->count()}}
                                        @endif
                                        </span>
                                @endif
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" >
                                <a href="{{ route('phonequestions.index') }}" class="nav-link" id="count_phone">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Перезвонить</p>
                                    @if(\App\Models\Question::where('type', '=', 'phone')->where('user_id', '=', NULL)->count())
                                        <span class="badge badge-info right counter">
                                            @if(\App\Models\Question::where('type', '=', 'phone')->where('user_id', '=', NULL)->count() > 99)
                                                99+
                                            @else
                                                {{\App\Models\Question::where('type', '=', 'phone')->where('user_id', '=', NULL)->count()}}
                                            @endif
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('allquestions.index') }}" class="nav-link" id="count_all">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Общие вопросы</p>
                                    @if(\App\Models\Question::where('type', '=', 'all')->where('user_id', '=', NULL)->count())
                                        <span class="badge badge-info right counter">
                                            @if(\App\Models\Question::where('type', '=', 'all')->where('user_id', '=', NULL)->count() > 99)
                                                99+
                                            @else
                                                {{\App\Models\Question::where('type', '=', 'all')->where('user_id', '=', NULL)->count()}}
                                            @endif
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('productquestions.index') }}" class="nav-link" id="count_prod">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Вопросы к товарам</p>
                                    @if(\App\Models\Question::where('type', '=', 'product')->where('user_id', '=', NULL)->count())
                                        <span class="badge badge-info right counter">
                                            @if(\App\Models\Question::where('type', '=', 'product')->where('user_id', '=', NULL)->count() > 99)
                                                99+
                                            @else
                                                {{\App\Models\Question::where('type', '=', 'product')->where('user_id', '=', NULL)->count()}}
                                            @endif
                                        </span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.contact') }}" class="nav-link">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>Контакты</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Доп. информация
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('add.faq.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Часто спрашивают</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('add.how_zdelat_zakaz.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Как сделать заказ</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('add.terms_of_use.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Польз. соглашение</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('add.code_of_ethics.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Кодекс этики</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('add.privacy_policy.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Политика конфиденц.</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('add.warranty.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Гарантия</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('add.delivery_terms.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Условия доставки</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('add.return_conditions.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Условия возврата</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('add.vacancies.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Вакансии</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    @elseif (session()->has('errors'))
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach (session('errors') as $error)
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
            </div>
        </div>

        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<script src="{{ asset('assets/admin/js/admin.js') }}"></script>

{{--<script>--}}
{{--    document.addEventListener("DOMContentLoaded", function(event) {--}}
{{--        function count(count, selector)--}}
{{--        {--}}
{{--            let node = document.querySelector('#'+selector.id+'>.counter')--}}
{{--            if(node){--}}
{{--                selector.removeChild(node)--}}
{{--            }--}}

{{--            if(count > 0)--}}
{{--            {--}}
{{--                let span = document.createElement('span')--}}
{{--                span.classList.add('badge', 'badge-info', 'right', 'counter')--}}
{{--                if(count > 99)--}}
{{--                {--}}
{{--                    span.textContent = '99+'--}}
{{--                    selector.insertAdjacentElement('beforeend', span)--}}
{{--                }--}}
{{--                else--}}
{{--                {--}}
{{--                    span.textContent = count--}}
{{--                    selector.insertAdjacentElement('beforeend', span)--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}
{{--        function show()--}}
{{--        {--}}
{{--            $.ajax({--}}
{{--                url: "{{ route('countquestions') }}",--}}
{{--                cache: false,--}}
{{--                success: function(data){--}}
{{--                    let counter = JSON.parse(data)--}}
{{--                    let count_prod = document.querySelector('#count_prod')--}}
{{--                    let count_phone = document.querySelector('#count_phone')--}}
{{--                    let count_all = document.querySelector('#count_all')--}}
{{--                    let allcount = document.querySelector('#allcount')--}}
{{--                    count(counter['prod_count'], count_prod)--}}
{{--                    count(counter['phone_count'], count_phone)--}}
{{--                    count(counter['all_count'], count_all)--}}
{{--                    count(counter['all_count']+counter['phone_count']+counter['prod_count'], allcount)--}}


{{--                }--}}

{{--            });--}}

{{--        }--}}

{{--        $(document).ready(function(){--}}
{{--            setInterval('show()', 1000);--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

<script>
    $('.nav-sidebar a').each(function () {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;
        if (link == location) {
            $(this).addClass('active');
            $(this).closest('.has-treeview').addClass('menu-open');
        }
    });
</script>


@yield('script')



</body>
</html>
