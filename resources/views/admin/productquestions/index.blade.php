@extends('admin.layouts.layout')
@section('title')
    @parent Вопросы к продуктам
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Вопросы к продуктам</h1>
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
                            <h3 class="card-title">Вопросы к продуктам</h3>
                            <form action="{{route('productquestions.index')}}" class="d-flex flex-row offset-md-7" method="get">
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
                            @if (count($products))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Имя</th>
                                            <th>Продукт</th>
                                            <th>Ответчик</th>
                                            <th>Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td><a href="{{-- route('products.index') --}}">Имя продукта</a></td>
                                                <td>
                                                    @if($product->user_id)
                                                        <span class="text-success">{{$product->user()->first()->name}}</span>
                                                    @else
                                                        <span class="text-danger">Ожидает ответа</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('productquestions.edit', ['productquestion' => $product->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                                        <form action="{{ route('productquestions.destroy', ['productquestion' => $product->id]) }}" method="post" class="float-left">
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
                                            @if($product->question or $product->answer)
                                            <tr class="expandable-body d-none">
                                                <td colspan="10">
                                                    <p style="display: none;">
                                                        @if($product->question)
                                                            <b>Вопрос: </b>
                                                            {{ $product->question }}
                                                            <br>
                                                        @endif
                                                        @if($product->answer)
                                                            <b>Ответ: </b>
                                                            {{ $product->answer }}
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
                                        <p>Вопросов к продуктам пока что нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $products->withQueryString()->links() }}
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
