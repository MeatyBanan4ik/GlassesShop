@extends('admin.layouts.layout')

@section('title')
    @parent Контакты
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Контакты</h1>
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
                            <h3 class="card-title">Контакты</h3>
                        </div>
                        <!-- /.card-header -->

                        <form id="form" role="form" method="post" action="{{ route('admin.contact') }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Номер</label>
                                    <input type="text" name="number"
                                           class="form-control @error('number') is-invalid @enderror" id="id"
                                           placeholder="Номер" value="{{$contact->number}}">
                                </div>
                                <div class="form-group">
                                    <label for="address">График работы службы поддержки</label>
                                    <textarea type="text" name="supports_graph"
                                           class="form-control @error('supports_graph') is-invalid @enderror" id="address">{{$contact->supports_graph}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="id">Instagram</label>
                                    <input type="text" name="instagram"
                                           class="form-control @error('instagram') is-invalid @enderror" id="id"
                                           placeholder="Instagram" value="{{$contact->instagram}}">
                                </div>
                                <div class="form-group">
                                    <label for="id">Facebook</label>
                                    <input type="text" name="facebook"
                                           class="form-control @error('facebook') is-invalid @enderror" id="id"
                                           placeholder="Facebook" value="{{$contact->facebook}}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" id="btn">Сохранить</button>
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

