@extends('admin.layouts.layout')

@section('title')
    @parent Добавление Задания
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Создание задания</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Создание задания</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('tasks.store') }}" id="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="text">Текст задачи</label>
                                    <textarea type="text" name="text"
                                           class="form-control @error('text') is-invalid @enderror" id="text"
                                              placeholder="Текст задачи">{{ old('text') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="time">Время выполнения</label>
                                    <input style="width: auto" type="datetime-local" name="time" id="time" value="{{old('time')}}" class="form-control @error('time') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button  class="btn btn-primary" id="btn">Сохранить</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection
