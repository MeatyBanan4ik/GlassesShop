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
                            <h3 class="card-title">Вопрос от пользователя {{ $product->name }} к продукту <a
                                    href="">Продукт_нейм</a></h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('productquestions.update', ['productquestion' => $product->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Имя</label>
                                        <input type="text" disabled
                                               class="form-control" id="name"
                                               placeholder="Имя" value="{{ $product->name }}">
                                    </div>
                                    @if($product->number)
                                    <div class="form-group">
                                        <label for="number">Номер</label>
                                        <input type="text" disabled
                                               class="form-control" id="number"
                                               placeholder="Имя" value="{{ $product->number }}">
                                    </div>
                                    @endif
                                    @if($product->email)
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" disabled
                                                   class="form-control" id="email"
                                                   placeholder="Email" value="{{ $product->email }}">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="question">Вопрос</label>
                                        <textarea type="text" disabled
                                               class="form-control" id="question"
                                                  placeholder="Причина обращения">{{ $product->question }}</textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="answer">Ответ</label>
                                        <textarea type="text" name="answer"
                                               class="form-control @error('answer') is-invalid @enderror" id="answer"
                                                  placeholder="Ответ">{{ $product->answer }}</textarea>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{ route('productquestions.index') }}" class="btn btn-primary">Назад</a>
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
