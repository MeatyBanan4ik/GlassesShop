@extends('admin.layouts.layout')
@section('title')
    @parent Заказы
@endsection
@section('content')
    <style>
        ol {
            list-style: none;
            counter-reset: li;
        }
        ol li:before {
            counter-increment: li;
            content: counters(li, ".") ". ";
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Заказы</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Заказы</h3>
                            <form action="{{route('orders.index')}}" class="d-flex flex-row offset-md-7" method="get">
                                <input type="text" name="search" class="form-control" placeholder="Номер телефона/Имя/Е-mail">
                                <select name="status" class="form-control ml-2" style="width: auto">
                                    <option value="">Выберите статус</option>
                                    <option value="w_processing">Ждет обработки</option>
                                    <option value="w_dispatch">Ждет отправки</option>
                                    <option value="submitted">Отправлено</option>
                                    <option value="w_receipt">Ждет получения</option>
                                    <option value="received">Получено</option>
                                </select>

                                <select class="form-control ml-2" id="payment" name="payment">
                                    <option value="">Выберите тип оплаты</option>
                                    <option value="card">Картой</option>
                                    <option value="cash">Наличными при получении</option>
                                </select>

                                <button class="btn btn-primary ml-2">Найти</button>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($orders))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Имя</th>
                                            <th>Номер телефона</th>
                                            <th>Email</th>
                                            <th>Оплата</th>
                                            <th>Цена</th>
                                            <th>Статус</th>
                                            <th>Действие</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user()->first()->name }}</td>
                                                <td><a href="tel: {{$order->user()->first()->number}}">{{$order->user()->first()->number}}</a></td>
                                                <td><a href=mailto:{{$order->user()->first()->email}}">{{$order->user()->first()->email}}</a></td>
                                                <td>
                                                @if($order->payment == 'card')
                                                        Картой
                                                @elseif($order->payment == 'cash_del')
                                                        Наложенным платежом
                                                @elseif($order->payment == 'cash')
                                                        Наличными при получении
                                                @endif</td>
                                                <td>@php
                                                        $sum = 0;
                                                        foreach(\App\Models\Product::getOrderProductInfo($order->id) as $info){
                                                            $sum += $info->count * $info->product_price;
                                                        }
                                                        echo $sum.' UAH';
                                                    @endphp</td>
                                                <td>@if($order->status == 'w_processing')
                                                        Ждет обработки
                                                    @elseif($order->status == 'w_dispatch')
                                                        Ждет отправки
                                                    @elseif($order->status == 'submitted')
                                                        Отправлено
                                                    @elseif($order->status == 'w_receipt')
                                                        Ждет получения
                                                    @elseif($order->status == 'received')
                                                        Получено
                                                    @endif</td>
                                                <td>
                                                    <a href="{{ route('orders.edit', ['order' => $order->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                                        <form action="{{ route('orders.destroy', ['order' => $order->id]) }}" method="post" class="float-left">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Подтвердите удаление')">
                                                                <i
                                                                    class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr class="expandable-body d-none">
                                                <td colspan="10">
                                                    <p style="display: none;">
                                                        <b>Адресс доставки: </b>
                                                        {{$order->address}}
                                                        <br>
                                                        @if($order->commentary)
                                                            <b>Комментарий к заказу: </b>
                                                            {{ $order->commentary }}
                                                        @endif
                                                        <br>
                                                        <b>Товары: </b>
                                                        <br>
                                                        <ol>
                                                            @foreach(\App\Models\Product::getOrderProductInfo($order->id) as $info)
                                                                <li>
                                                                    {!!  '<b>ID:</b>'!!}
                                                                    {{\App\Models\Product::where('id', $info->product_id)->first()->id}}
                                                                    {!! '<b>Название:</b>'!!}
                                                                    {{\App\Models\Product::where('id', $info->product_id)->first()->name}}
                                                                    {!! '<b>Цена:</b>'!!}
                                                                    {{$info->product_price}}
                                                                    {{'UAH'}}
                                                                    {!! '<b>Кол-во:</b>'!!}
                                                                    {{$info->count}}
                                                                    @if($info->parameters !== "[]")
                                                                        {!! '<b>Дополнительные параметры:</b>' !!}
                                                                        <ol>
                                                                            @php
                                                                                $parameters = (array) json_decode($info->parameters);
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
                                                                                    <li style="margin-left: 20px;">
                                                                                        {!! '<b>'!!}
                                                                                        {{trim($key)}}
                                                                                        {!!':</b>'!!}
                                                                                        {{$parametr}}
                                                                                    </li>
                                                                                @endforeach
                                                                                <b>Левый глаз:</b>
                                                                                @foreach($left as $key => $parametr)
                                                                                    <li style="margin-left: 20px;">
                                                                                        &nbsp;{!! '<b>'!!}
                                                                                        {{trim($key)}}
                                                                                        {!!':</b>'!!}
                                                                                        {{$parametr}}
                                                                                    </li>
                                                                                @endforeach
                                                                            @else
                                                                                @foreach($parameters as $key => $parametr)
                                                                                        <li>
                                                                                            &nbsp;{!! '<b>'!!}
                                                                                            {{$key}}
                                                                                            {!!':</b>'!!}
                                                                                            {{$parametr}}
                                                                                        </li>
                                                                                @endforeach
                                                                            @endif
                                                                        </ol>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ol>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Заказов пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $orders->withQueryString()->links() }}
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
