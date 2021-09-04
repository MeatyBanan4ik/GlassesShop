@extends('admin.layouts.layout')
@section('title')
    @parent Phone
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Перезвонить</h1>
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
                            <h3 class="card-title">Номера телефонов</h3>
                            <form action="{{route('phonequestions.index')}}" class="d-flex flex-row offset-md-7" method="get">
                                <input type="text" name="number" class="form-control">
                                <select name="status" class="form-control ml-2" style="width: auto">
                                    <option></option>
                                    <option value="wait">Ожидает ответа</option>
                                    <option value="ans">Обработан</option>
                                </select>

                                <button class="btn btn-primary ml-2">Найти</button>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($phones))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Имя</th>
                                            <th>Номер телефона</th>
                                            <th>Ответчик</th>
                                            <th>Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($phones as $phone)
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>{{ $phone->id }}</td>
                                                <td>{{ $phone->name }}</td>
                                                <td><a href="tel: {{$phone->number}}">{{$phone->number}}</a></td>
                                                <td>
                                                    @if($phone->user_id)
                                                        <span class="text-success">{{$phone->user()->first()->name}}</span>
                                                    @else
                                                        <span class="text-danger">Ожидает звонка</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('phonequestions.edit', ['phonequestion' => $phone->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                                        <form action="{{ route('phonequestions.destroy', ['phonequestion' => $phone->id]) }}" method="post" class="float-left">
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
                                            @if($phone->question or $phone->answer)
                                            <tr class="expandable-body d-none">
                                                <td colspan="10">
                                                    <p style="display: none;">
                                                        @if($phone->question)
                                                            <b>Вопрос: </b>
                                                            {{ $phone->question }}
                                                            <br>
                                                        @endif
                                                        @if($phone->answer)
                                                            <b>Дополнительная информация: </b>
                                                            {{ $phone->answer }}
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Номеров телефонов пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $phones->withQueryString()->links() }}
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
