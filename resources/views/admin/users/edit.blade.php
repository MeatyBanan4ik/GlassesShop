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
                    <h1>Редактирование пользователя</h1>
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
                            <h3 class="card-title">Пользователь {{ $user->name }}</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('users.update', ['user' => $user->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">ФИО</label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror" id="name"
                                               placeholder="Имя" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">EMAIL</label>
                                        <input type="text" name="email"
                                               class="form-control @error('email') is-invalid @enderror" id="email"
                                               placeholder="Email" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">ПАРОЛЬ</label>
                                        <input type="text" name="password"
                                               class="form-control @error('password') is-invalid @enderror" id="password"
                                               placeholder="Пароль" value="{{ old('password') }}">
                                    </div>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                                        <div class="form-group">
                                            <label for="role">Роль</label>
                                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                                                <option value="user">Пользователь</option>
                                                <option value="moder" @if($user->role == 'moder') selected @endif>Модератор</option>
                                                <option value="admin" @if($user->role == 'admin') selected @endif>Админ</option>
                                            </select>
                                        </div>
                                    @endif
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
