@extends('admin.layouts.layout')

@section('title')
    @parent Редактирование товара
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование товара</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                            <h3 class="card-title">Товар "{{ $product->name }}"</h3>
                        </div>
                        <!-- /.card-header -->
                        <form role="form" method="post" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method ('put')
                            <div class="card-body">

                                <div class="form-group">
                                <label for="name">Наименование товара</label>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror" value="{{ $product->name }}"
                                       id="name"
                                       placeholder="Название товара">
                                </div>
                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="number" name="price" value="{{ $product->price }}"
                                           class="form-control @error('price') is-invalid @enderror" id="price"
                                           placeholder="Цена товара">
                                </div>
                                <div class="form-group">
                                    <label for="brand">Бренд</label>
                                    <input type="text" name="brand" value="{{ $product->brand }}"
                                           class="form-control @error('brand') is-invalid @enderror" id="brand"
                                           placeholder="Название бренда">
                                </div>

                                <div class="form-group">
                                    <label for="in_stock">В наличии?</label>
                                    <select name="in_stock" id="in_stock">
                                        @if($product->in_stock == '1')
                                            <option  value="1" selected>Да</option>
                                            <option value="0">Нет</option>
                                        @else
                                            <option  value="1">Да</option>
                                            <option value="0" selected>Нет</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="description">Описание товара</label>
                                    <textarea class="form-control" name="description"
                                              id="description">{{ $product->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="img">Изображение товара</label>
                                    <input type="file" class="form-control-file" name="img" id="img">
                                </div>

                                <div class="form-group">
                                    <label for="category">Тип товара</label>
                                    <input readonly id="category"
                                           @if($product->category == 'frames')
                                           value="Оправы"
                                           @elseif($product->category == 'glasses')
                                           value="Очки"
                                           @elseif($product->category == 'lenses')
                                           value="Линзы"
                                        @endif
                                    >

                                </div>

                                @if($product->category == 'frames')

                                    <div class="form-block">
                                        <label for="sex">Пол</label>
                                        <input type="text" value="{{ $prod->sex }}" name="sex"class="form-control"
                                               id="sex"placeholder="Укажите пол">
                                    </div>
                                    <div class="form-block">
                                        <label for="frame_shape">Форма оправы</label>
                                        <input type="text" name="frame_shape" value="{{ $prod->frame_shape }}"
                                               class="form-control" id="frame_shape">
                                    </div>
                                    <div class="form-block">
                                        <label for="frame_material">Материал оправы</label>
                                        <input type="text" name="frame_material" value="{{ $prod->frame_material }}"
                                               class="form-control" id="frame_material">
                                    </div>
                                    <div class="form-block">
                                        <label for="bridge_size">Размер мостика</label>
                                        <input type="number" name="bridge_size" value="{{ $prod->bridge_size }}"
                                               class="form-control" id="bridge_size">
                                    </div>
                                    <div class="form-block">
                                        <label for="eyepiece_size">Размер окуляра</label>
                                        <input type="number" name="eyepiece_size" value="{{ $prod->eyepiece_size }}"
                                               class="form-control" id="eyepiece_size"></div>
                                    <div class="form-block">
                                        <label for="temple_length">Длина заушника</label>
                                        <input type="number" name="temple_length" value="{{ $prod->temple_length }}"
                                               class="form-control" id="temple_length"></div>

                                @elseif($product->category == 'lenses')

                                    <div class="form-group">
                                        <label for="purpose">Назначение линз</label>
                                        <input class="form-control" type="text" value="{{ $prod->purpose }}" name="purpose"
                                               id="purpose">
                                    </div>
                                    <div class="form-group">
                                        <label for="diameter">Диаметр линз(в мм.)</label>
                                        <input class="form-control" type="number" value="{{ $prod->diameter }}" name="diameter"
                                               id="diameter">
                                    </div>
                                    <div class="form-group">
                                        <label for="center_thickness">Толщина по центру(в мм.)</label>
                                        <input class="form-control" type="number" value="{{ $prod->center_thickness }}"
                                               name="center_thickness" id="center_thickness">
                                    </div>
                                    <div class="form-group">
                                        <label for="material_type">Тип материала</label>
                                        <input class="form-control" type="text" value="{{ $prod->material_type }}"
                                               name="material_type" id="material_type">
                                    </div>
                                    <div class="form-group">
                                        <label for="is_uv">UV</label>
                                        <select name="is_uv" id="is_uv">
                                            @if($prod->is_uv == '1')
                                                <option  value="1" selected>Да</option>
                                                <option value="0">Нет</option>
                                            @else
                                                <option  value="1">Да</option>
                                                <option value="0" selected>Нет</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="moisture">Влагосодержание(в %)</label>
                                        <input class="form-control" type="text" value="{{ $prod->moisture }}" name="moisture"
                                               id="moisture">
                                    </div>
                                    <div class="form-group">
                                        <label for="lens_material">Материал линзы</label>
                                        <input class="form-control" type="text" value="{{ $prod->lens_material }}"
                                               name="lens_material" id="lens_material">
                                    </div> <div class="form-group">
                                        <label for="oxygen_transmission">Пропускание кислорода(Dk/t)</label>
                                        <input class="form-control" type="number" value="{{ $prod->oxygen_transmission }}"
                                               name="oxygen_transmission"
                                               id="oxygen_transmission">
                                    </div>
                                    <div class="form-group">
                                        <label for="wearing_mode">Режим ношения</label>
                                        <input class="form-control" type="text" value="{{ $prod->wearing_mode }}"
                                               name="wearing_mode"
                                               id="wearing_mode"
                                               placeholder="Если более одного слова - перечислить через запятую">
                                    </div>
                                    <div class="form-group">
                                        <label for="replacement_mode">Режим замены</label>
                                        <input class="form-control" type="text" value="{{ $prod->replacement_mode }}"
                                               name="replacement_mode"
                                               id="replacement_mode">
                                    </div>
                                    <div class="form-group">
                                        <label for="tinting">Тонировка</label>
                                        <input class="form-control" type="text" value="{{ $prod->tinting }}" name="tinting"
                                               id="tinting">
                                    </div>
                                    <div class="form-group">
                                        <label for="diopters">Диоптрии</label>
                                        <input type="text" name="diopters" class="form-control"id="diopters"
                                               value="@if(is_array($diopters) == 1) {{ join(', ', $diopters) }} @else {{ $diopters }}  @endif" placeholder="Введите диоптрии для этих линз (Если несколько - перечислите через запятую, например: -7.5, -6, 3.5, 5, 9)">
                                    </div>
                                    <div class="form-group">
                                        <label for="cylinder">Оптическая сила цилиндра(необязательное поле)</label>
                                        <input type="text" name="cylinder" class="form-control"id="cylinder"
                                               value="@if(is_array($cylinder)) {{ join(', ', $cylinder) }} @else {{ $cylinder }}  @endif" placeholder="Укажите оптическую силу цилиндра для этих линз (Если несколько - перечислите через запятую, например: -2.25, -1.75)">
                                    </div>

                                    <div class="form-group">
                                        <label for="axis">Ось(необязательное поле)</label>
                                        <input type="text" name="axis" class="form-control"
                                               value="@if(is_array($axis)) {{ join(', ', $axis) }} @else {{ $axis }}  @endif" id="axis" placeholder="Укажите ось линзы (Если несколько - перечислите через запятую, например: 180, 90, 120)">
                                    </div>
                                    <div class="form-group">
                                        <label for="curvature">Радиус кривизны</label>
                                        <input type="text" name="curvature"
                                               value="@if(is_array($curvature)) {{ join(', ', $curvature) }} @else {{ $curvature }}  @endif" class="form-control" id="curvature" placeholder="Укажите радиус кривизны (Если несколько - перечислите через запятую, например: 8.4, 8.6, 9.2 )">'
                                    </div>

                                @elseif ($product->category == 'glasses')

                                    <div class="form-block">
                                        <label for="sex">Пол</label>
                                        <input type="text" name="sex" class="form-control"
                                               id="sex" value="{{ $prod->sex }}" placeholder="Укажите пол">
                                    </div>
                                    <div class="form-block">
                                        <label for="frame_shape">Форма оправы</label>
                                        <input type="text" name="frame_shape" value="{{ $prod->frame_shape }}"
                                               class="form-control" id="frame_shape">
                                    </div>
                                    <div class="form-block">
                                        <label for="frame_material">Материал оправы</label>
                                        <input type="text" value="{{ $prod->frame_material }}"
                                               name="frame_material"class="form-control"
                                               id="frame_material">
                                    </div>
                                    <div class="form-block">
                                        <label for="bridge_size">Размер мостика</label>
                                        <input type="number" value="{{ $prod->bridge_size }}"
                                               name="bridge_size" class="form-control" id="bridge_size">
                                    </div>
                                    <div class="form-block">
                                        <label for="eyepiece_size">Размер окуляра</label>
                                        <input type="number" value="{{ $prod->eyepiece_size }}"
                                               name="eyepiece_size"class="form-control" id="eyepiece_size">
                                    </div>
                                    <div class="form-block">
                                        <label for="temple_length">Длина заушника</label>
                                        <input type="number" value="{{ $prod->temple_length }}"
                                               name="temple_length"class="form-control"
                                               id="temple_length">
                                    </div>
                                    <div class="form-block">
                                        <label for="lens_color">Цвет линз</label>
                                        <input type="text" name="lens_color" value="{{ $prod->lens_color }}"
                                               class="form-control" id="lens_color">
                                    </div>
                                    <div class="form-block">
                                        <label for="polarization">Поляризация</label>
                                        <select name="polarization" id="polarization">
                                            @if($prod->polarization == '1')
                                                <option  value="1" selected>Да</option>
                                                <option value="0">Нет</option>
                                            @else
                                                <option value="0" selected>Нет</option>
                                                <option value="1">Да</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-block">
                                        <label for="mirror">Зеркальные</label>
                                        <select name="mirror" id="mirror">
                                            @if($prod->mirror == '1')
                                                <option  value="1" selected>Да</option>
                                                <option value="0">Нет</option>
                                            @else
                                                <option  value="1">Да</option>
                                                <option value="0" selected>Нет</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-block">
                                        <label for="gradient">Градиент</label>
                                        <select name="gradient" id="gradient">
                                            @if($prod->gradient == '1')
                                                <option  value="1" selected>Да</option>
                                                <option value="0">Нет</option>
                                            @else
                                                <option  value="1">Да</option>
                                                <option value="0" selected>Нет</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-block">
                                        <label for="lens_material">Материал линз</label>
                                        <input type="text" name="lens_material" value="{{ $prod->lens_material }}"
                                               class="form-control" id="lens_material">
                                    </div>

                                @endif
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
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
