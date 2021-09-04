@extends('admin.layouts.layout')

@section('title')
    @parent Пользовательское соглашение
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Пользовательское соглашение</h1>
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
                            <h3 class="card-title">Пользовательское соглашение</h3>
                        </div>
                        <!-- /.card-header -->

                        <form id="form" role="form" method="post" action="{{ route('add.terms_of_use.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Текст</label>
                                    <textarea type="text" name="content" rows="20"
                                           class="form-control @error('content') is-invalid @enderror" id="id"
                                              placeholder="Текст">@if(\Illuminate\Support\Facades\DB::table('additional')->where('page', 'terms_of_use')->first() != null) {{\Illuminate\Support\Facades\DB::table('additional')->where('page', 'terms_of_use')->first()->content}} @endif</textarea>
                                </div>
                            </div>

                            <div class="card-footer d-flex flex-row">
                                <button class="btn btn-primary" id="btn">Сохранить</button>
                        </form>
                        <form id="form" role="form" method="post" action="{{ route('add.terms_of_use.delete') }}">
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

