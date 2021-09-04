@extends('admin.layouts.layout')

@section('title')
    @parent Home
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Главная</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\Order::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->where('status', '!=', 'in_cart')->count() }}</h3>
                        <p>Новых заказов</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('orders.index') }}" class="small-box-footer">Больше информации <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ \App\Models\User::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->count() }}</h3>

                        <p>Новых пользователей</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('users.index') }}" class="small-box-footer">Больше информации <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

        </div>

        <div class="row">
                <section class="col-lg-7 connectedSortable ui-sortable">
{{--                    <div class="card direct-chat direct-chat-primary">--}}
{{--                        <div class="card-header ui-sortable-handle" style="">--}}
{{--                            <h3 class="card-title">Direct Chat</h3>--}}

{{--                            <div class="card-tools">--}}
{{--                                <span title="3 New Messages" class="badge badge-primary">3</span>--}}
{{--                                <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                    <i class="fas fa-minus"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- /.card-header -->
{{--                        <div class="card-body">--}}
{{--                            <!-- Conversations are loaded here -->--}}
{{--                            <div class="direct-chat-messages">--}}

{{--                                    @foreach($messages as $message)--}}
{{--                                        @if(\Illuminate\Support\Facades\Auth::user()->id != $message->user_id)--}}
{{--                                            <div class="direct-chat-msg">--}}
{{--                                                <div class="direct-chat-infos clearfix">--}}
{{--                                                    <span class="direct-chat-name float-left">{{$message->user()->first()->name}}</span>--}}
{{--                                                    <span class="direct-chat-timestamp float-right">{{$message->created_at}}</span>--}}
{{--                                                </div>--}}
{{--                                                <img class="direct-chat-img" src="{{asset($message->user()->first()->avatar)}}" alt="message user image">--}}
{{--                                                <div class="direct-chat-text">--}}
{{--                                                    {{$message->content}}--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @else--}}
{{--                                            <div class="direct-chat-msg right">--}}
{{--                                                <div class="direct-chat-infos clearfix">--}}
{{--                                                    <span class="direct-chat-name float-right">{{$message->user()->first()->name}}</span>--}}
{{--                                                    <span class="direct-chat-timestamp float-left">{{$message->created_at}}</span>--}}
{{--                                                </div>--}}
{{--                                                <img class="direct-chat-img" src="{{asset($message->user()->first()->avatar)}}" alt="message user image">--}}
{{--                                                <div class="direct-chat-text">--}}
{{--                                                    {{$message->content}}--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <!-- /.card-body -->--}}
{{--                        <div class="card-footer">--}}
{{--                            <form action="{{route('message.send')}}" method="post">--}}
{{--                                @csrf--}}
{{--                                <div class="input-group">--}}
{{--                                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">--}}
{{--                                    <span class="input-group-append">--}}
{{--                                      <button class="btn btn-primary">Send</button>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-footer-->--}}
{{--                    </div>--}}

                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                Список задач
                            </h3>

                            <div class="card-tools">
                                {{$list->links()}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                            @php
                                date_default_timezone_set('Europe/Kiev');
                            @endphp
                            @foreach($list as $item)
                                <li data-id="{{$item->id}}">
                                    <div class="icheck-primary d-inline ml-2">
                                        <input @if($item->status) checked @endif type="checkbox"  value="{{$item->id}}" name="checklist" id="checklist{{$item->id}}">
                                        <label for="todoCheck1"></label>
                                    </div>
                                    <span class="text">{{$item->text}}</span>
                                    <small class="badge @if((strtotime($item->time) - strtotime(date('Y-m-d H:i'))) >= 96780) badge-success @elseif((strtotime($item->time) - strtotime(date('Y-m-d H:i'))) >= 43200) badge-warning @elseif((strtotime($item->time) - strtotime(date('Y-m-d H:i'))) < 43200) badge-danger @else badge-info @endif"><i class="far fa-clock"></i> {{\Carbon\Carbon::parse($item->time)->diffForHumans()}}</small>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                        <div class="tools">
                                            <a href="{{route('tasks.edit', ['task' => $item->id])}}" class="fas fa-edit"></a>
                                            <i data-id="{{$item->id}}" class="fas fa-trash"></i>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                <a href="{{route('tasks.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Добавить задачу</a>
                            @endif
                        </div>
                    </div>
                </section>

                <section class="col-lg-5 connectedSortable ui-sortable">
{{--                    <div class="card" style="position: relative; left: 0px; top: 0px;">--}}
{{--                        <div class="card-header ui-sortable-handle" style="">--}}
{{--                            <h3 class="card-title">--}}
{{--                                <i class="fas fa-chart-pie mr-1"></i>--}}
{{--                                Sales--}}
{{--                            </h3>--}}
{{--                            <div class="card-tools">--}}
{{--                                <ul class="nav nav-pills ml-auto">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" href="#revenue-chart" data-toggle="tab">Area</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link active" href="#sales-chart" data-toggle="tab">Donut</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div><!-- /.card-header -->--}}

{{--                        <div class="card-body">--}}
{{--                            <div class="tab-content p-0">--}}
{{--                                <!-- Morris chart - Sales -->--}}
{{--                                <div class="chart tab-pane" id="revenue-chart" style="position: relative; height: 300px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>--}}
{{--                                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px; display: block; width: 900px;" width="900" class="chartjs-render-monitor"></canvas>--}}
{{--                                </div>--}}
{{--                                <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>--}}
{{--                                    <canvas id="sales-chart-canvas" height="300" style="height: 300px; display: block; width: 900px;" class="chartjs-render-monitor" width="900"></canvas>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- /.card-body -->--}}
{{--                    </div>--}}

                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Последние заказы</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>ID заказа</th>
                                        <th>Имя покупателя</th>
                                        <th>Статус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td><a href="{{route('orders.edit', ['order' => $order->id])}}">{{$order->id}}</a></td>
                                            <td>{{$order->user()->first()->name}}</td>
                                            <td>@if($order->status == 'w_processing')
                                                    <span class="badge badge-danger">Ждет обработки</span>
                                                @elseif($order->status == 'w_dispatch')
                                                    <span class="badge badge-warning">Ждет отправки</span>
                                                @elseif($order->status == 'submitted')
                                                    <span class="badge badge-info">Отправлено</span>
                                                @elseif($order->status == 'w_receipt')
                                                    <span class="badge badge-secondary">Ждет получения</span>
                                                @elseif($order->status == 'received')
                                                    <span class="badge badge-success">Получено</span>
                                                @endif</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="{{route('orders.create')}}" class="btn btn-sm btn-info float-left">Разместить новый заказ</a>
                            <a href="{{route('orders.index')}}" class="btn btn-sm btn-secondary float-right">Посмотреть все заказы</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </section>
            <!-- /.card-footer-->
    </div>
    </div>
@endsection

@section('script')
    <script>

        document.querySelector('.todo-list').addEventListener('click', function (event) {
           if (event.target.classList.contains('fa-trash')) {
                $.ajax({
                    url: '{{route('task.delete')}}',
                    data: '&id='+event.target.dataset.id,
                    success: function () {
                        document.querySelector(`li[data-id="${event.target.dataset.id}"]`).remove()
                    }
                })
            }
            if(event.target.tagName.toLowerCase() === 'input'){
                $.ajax({
                    url: '{{route('task.check')}}',
                    data: 'check='+event.target.checked+'&id='+event.target.value,
                    error: async function (error) {
                        event.target.checked = event.target.checked ? false : true
                        if(event.target.checked) {
                            document.querySelector(`li[data-id="${event.target.value}"]`).classList.add('done')
                        }
                        else {
                            document.querySelector(`li[data-id="${event.target.value}"]`).classList.remove('done')
                        }
                    }
                })
            }
        })


    </script>
@endsection

