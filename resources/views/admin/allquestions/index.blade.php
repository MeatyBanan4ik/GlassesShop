@extends('admin.layouts.layout')
@section('title')
    @parent Phone
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Общие вопросы</h1>
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
                            <h3 class="card-title">Вопросы</h3>
                            <form action="{{route('allquestions.index')}}" class="d-flex flex-row offset-md-7" method="get">
                                <input type="text" name="search" class="form-control">
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
                            @if (count($alls))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Имя</th>
                                            <th>Номер телефона</th>
                                            <th>Email</th>
                                            <th>Ответчик</th>
                                            <th>Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($alls as $all)
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>{{ $all->id }}</td>
                                                <td>{{ $all->name }}</td>
                                                <td><a href="tel: {{$all->number}}">{{$all->number}}</a></td>
                                                <td><a href=mailto:{{$all->email}}">{{$all->email}}</a></td>
                                                <td>
                                                    @if($all->user_id)
                                                        <span class="text-success">{{$all->user()->first()->name}}</span>
                                                    @else
                                                        <span class="text-danger">Ожидает ответа</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('allquestions.edit', ['allquestion' => $all->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                                        <form action="{{ route('allquestions.destroy', ['allquestion' => $all->id]) }}" method="post" class="float-left">
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
                                            @if($all->question or $all->answer)
                                            <tr class="expandable-body d-none">
                                                <td colspan="10">
                                                    <p style="display: none;">
                                                        @if($all->question)
                                                            <b>Вопрос: </b>
                                                            {{ $all->question }}
                                                            <br>
                                                        @endif
                                                        @if($all->answer)
                                                            <b>Дополнительная информация: </b>
                                                            {{ $all->answer }}
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
                                <p>Вопросов пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $alls->withQueryString()->links() }}
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
