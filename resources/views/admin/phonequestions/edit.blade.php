@extends('admin.layouts.layout')

@section('title')
    @parent Изменение Пользователя
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Перезвонить</h1>
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
                            <h3 class="card-title">Телефон <a href="tel:{{ $phone->number }}">{{ $phone->number }}</a></h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('phonequestions.update', ['phonequestion' => $phone->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">ФИО</label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror" id="name"
                                               placeholder="Имя" value="{{ $phone->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="question">Причина обращения</label>
                                        <textarea type="text" name="question"
                                               class="form-control @error('question') is-invalid @enderror" id="question"
                                                  placeholder="Причина обращения">{{ $phone->question }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="answer">Дополнительная информация</label>
                                        <textarea type="text" name="answer"
                                               class="form-control" id="answer"
                                                  placeholder="Дополнительная информация">{{ $phone->answer }}</textarea>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{ route('phonequestions.index') }}" class="btn btn-primary">Назад</a>
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
