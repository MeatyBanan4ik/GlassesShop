@extends('admin.layouts.layout')

@section('title')
    @parent Как сделать заказ
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Как сделать заказ</h1>
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
                            <h3 class="card-title">Как сделать заказ</h3>
                        </div>
                        <!-- /.card-header -->

                        <form id="form" role="form" method="post" action="{{ route('add.how_zdelat_zakaz.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Текст</label>
                                    <textarea type="text" name="content" rows="20"
                                           class="form-control @error('content') is-invalid @enderror" id="id"
                                              placeholder="Текст">@if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'how_zdelat_zakaz')->first() != null) {{\Illuminate\Support\Facades\DB::table('additional')->where('page', 'how_zdelat_zakaz')->first()->content}} @endif</textarea>
                                </div>
                            </div>

                            <div class="card-footer d-flex flex-row">
                                <button class="btn btn-primary" id="btn">Сохранить</button>
                        </form>
                        <form id="form" role="form" method="post" action="{{ route('add.how_zdelat_zakaz.delete') }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger ml-2" id="btn">Удалить</button>
                        </form>
                    </div>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <!-- /.content -->
@endsection

