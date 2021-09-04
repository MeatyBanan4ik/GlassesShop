@extends('admin.layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Товары</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
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
                            <h3 class="card-title">Список товаров</h3>
                            <form action="{{route('products.index')}}" class="d-flex flex-row offset-md-7" method="get">
                                <input type="text" name="search" class="form-control" placeholder="Артикль/Название/Бренд">
                                <select class="form-control" name="category">
                                    <option value="">Выберите категорию</option>
                                    <option value="frames">Оправы</option>
                                    <option value="lenses">Контактные линзы</option>
                                    <option value="glasses">Очки</option>
                                </select>
                                <button class="btn btn-primary ml-2">Найти</button>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Добавить товар</a>
                            @if (count($products))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Имя</th>
                                            <th>Цена</th>
                                            <th>В наличии</th>
                                            <th>Категория</th>
                                            <th>Бренд</th>
                                            <th>Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $prod)
                                            <tr>
                                                <td>{{ $prod->id }}</td>
                                                <td>{{ $prod->name }}</td>
                                                <td>{{ $prod->price }}</td>
                                                <td>@if($prod->in_stock == 1)Есть в наличии@elseНет в наличии@endif</td>
                                                <td>
                                                    @if($prod->category == 'frames')
                                                        Оправы
                                                    @elseif($prod->category == 'glasses')
                                                        Очки
                                                    @elseif($prod->category == 'lenses')
                                                        Линзы
                                                    @endif
                                                </td>
                                                <td>{{ $prod->brand }}</td>
                                                <td>
                                                    <a href="{{ route('products.edit', ['product' => $prod->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form action="{{ route('products.destroy', ['product' => $prod->id]) }}" method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Подтвердите удаление')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Товаров пока нет...</p>
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
    <!-- /.content -->
@endsection
