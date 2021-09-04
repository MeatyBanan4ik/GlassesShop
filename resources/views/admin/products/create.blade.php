@extends('admin.layouts.layout')

@section('title')
    @parent Добавление пользователя
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Главная</h1>
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
                            <h3 class="card-title">Создание товара</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror" id="name"
                                           placeholder="Название товара">
                                </div>
                                <div class="form-group">
                                    <label for="vendor_code">Артикул</label>
                                    <input type="text" name="vendor_code"
                                           class="form-control @error('vendor_code') is-invalid @enderror" id="vendor_code"
                                           placeholder="Артикул товара">
                                </div>
                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="number" name="price"
                                           class="form-control @error('price') is-invalid @enderror" id="price"
                                           placeholder="Цена товара">
                                </div>
                                <div class="form-group">
                                    <label for="brand">Бренд</label>
                                    <input type="text" name="brand"
                                           class="form-control @error('brand') is-invalid @enderror" id="brand"
                                           placeholder="Название бренда">
                                </div>

                                <div class="form-group">
                                    <label for="in_stock">В наличии?</label>
                                    <select name="in_stock" id="in_stock">
                                        <option></option>
                                        <option value="1" selected>Да</option>
                                        <option value="0">Нет</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="description">Описание товара</label>
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="img">Изображение товара</label>
                                    <input type="file" class="form-control-file" name="img" id="img">
                                </div>

                                <div class="form-group">
                                    <label for="category">Тип товара</label>
                                    <select name="category" id="category">
                                        <option></option>
                                        <option value="frames">Оправы</option>
                                        <option value="lenses">Контактные линзы</option>
                                        <option value="glasses">Очки</option>
                                    </select>
                                </div>

                                <div id="thisblock">

                                </div>
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

@section('script')
            <script>
                var select = document.querySelector('#category')
                select.addEventListener('change', function (event)
                {
                    var block = document.querySelector('#thisblock')
                    block.innerHTML = ''
                    if(event.target.value === 'lenses')
                    {
                        block.innerHTML =
                            '<div class="form-group"> <label for="purpose">Назначение линз</label> <input class="form-control" type="text" name="purpose" id="purpose"> </div> <div class="form-group"> <label for="diameter">Диаметр линз(в мм.)</label> <input class="form-control" type="number" step="0.01" name="diameter" id="diameter"> </div> <div class="form-group"> <label for="center_thickness">Толщина по центру(в мм.)</label> <input class="form-control" type="number" step="0.01" name="center_thickness" id="center_thickness"> </div> <div class="form-group"> <label for="material_type">Тип материала</label> <input class="form-control" type="text" name="material_type" id="material_type"> </div> <div class="form-group"> <label for="is_uv">UV</label> <select name="is_uv" id="is_uv"> <option value="0" selected>Нет</option> <option value="1">Да</option> </select> </div> <div class="form-group"> <label for="moisture">Влагосодержание(в %)</label> <input class="form-control" type="text" name="moisture" id="moisture"> </div> <div class="form-group"> <label for="lens_material">Материал линзы</label> <input class="form-control" type="text" name="lens_material" id="lens_material"> </div> <div class="form-group"> <label for="oxygen_transmission">Пропускание кислорода(Dk/t)</label> <input class="form-control" type="number" name="oxygen_transmission" id="oxygen_transmission"> </div> <div class="form-group"> <label for="wearing_mode">Режим ношения</label> <input class="form-control" type="text" name="wearing_mode" id="wearing_mode"placeholder="Если более одного слова - перечислить через запятую"> </div> <div class="form-group"> <label for="replacement_mode">Режим замены</label> <input class="form-control" type="text" name="replacement_mode" id="replacement_mode"></div><div class="form-group"> <label for="tinting">Тонировка</label><input class="form-control" type="text" name="tinting" id="tinting"></div><div class="form-group"><label for="diopters">Диоптрии</label><input type="text" name="diopters" class="form-control"id="diopters" placeholder="Введите диоптрии для этих линз (Если несколько - перечислите через запятую, например: -7.5, -6, 3.5, 5, 9)"></div><div class="form-group"><label for="cylinder">Оптическая сила цилиндра(необязательное поле)</label><input type="text" name="cylinder" class="form-control"id="cylinder" placeholder="Укажите оптическую силу цилиндра для этих линз (Если несколько - перечислите через запятую, например: -2.25, -1.75)"></div><div class="form-group"><label for="axis">Ось(необязательное поле)</label><input type="text" name="axis" class="form-control" id="axis" placeholder="Укажите ось линзы (Если несколько - перечислите через запятую, например: 180, 90, 120)"></div><div class="form-group"><label for="curvature">Радиус кривизны</label><input type="text" name="curvature" class="form-control" id="curvature" placeholder="Укажите радиус кривизны (Если несколько - перечислите через запятую, например: 8.4, 8.6, 9.2 )"></div>'
                    }
                    else if(event.target.value === 'frames' || event.target.value === 'glasses')
                    {
                        block.innerHTML =
                            '<div class="form-block"> <label for="sex">Пол</label> <input type="text" name="sex"class="form-control" id="sex"placeholder="Укажите пол"> </div> <div class="form-block"> <label for="frame_shape">Форма оправы</label> <input type="text" name="frame_shape"class="form-control" id="frame_shape"> </div> <div class="form-block"> <label for="frame_material">Материал оправы</label> <input type="text" name="frame_material"class="form-control" id="frame_material"></div><div class="form-block"><label for="bridge_size">Размер мостика</label><input type="number" name="bridge_size"class="form-control" id="bridge_size"></div><div class="form-block"><label for="eyepiece_size">Размер окуляра</label><input type="number" name="eyepiece_size"class="form-control" id="eyepiece_size"></div><div class="form-block"> <label for="temple_length">Длина заушника</label><input type="number" name="temple_length"class="form-control" id="temple_length"></div>'
                        if(event.target.value === 'glasses')
                        {
                            block.innerHTML+=
                                '<div class="form-block"> <label for="lens_color">Цвет линз</label><input type="text" name="lens_color"class="form-control" id="lens_color"> </div> <div class="form-block"> <label for="polarization">Поляризация</label><select name="polarization" id="polarization"><option></option><option value="1">Да</option><option value="0" selected>Нет</option></select></div><div class="form-block"><label for="mirror">Зеркальные</label><select name="mirror" id="mirror"><option></option><option value="1">Да</option><option value="0" selected>Нет</option></select></div><div class="form-block"><label for="gradient">Градиент</label><select name="gradient" id="gradient"><option></option><option value="1">Да</option><option value="0" selected>Нет</option></select></div><div class="form-block"><label for="lens_material">Материал линз</label><input type="text" name="lens_material"class="form-control" id="lens_material"></div>'
                        }
                    }
                })
            </script>

@endsection

