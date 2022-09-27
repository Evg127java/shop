@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create user</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Admin home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="surname" placeholder="surname" value="{{ old('surname') }}">
                        @error('surname')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="patronymic" placeholder="patronymic" value="{{ old('patronymic') }}">
                        @error('patronymic')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="n" class="form-control" name="age" placeholder="age" value="{{ old('age') }}">
                        @error('age')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="address" value="{{ old('address') }}">
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select name="gender" id="gender"class="custom-select">
                            <option disabled selected>Gender</option>
                            <option {{ old('gender') === 1 ? ' selected ' : ''}} value="1">Male</option>
                            <option {{ old('gender') === 2 ? ' selected ' : ''}} value="2">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="password">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="password_confirmation">
                        @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Create" class="btn btn-primary mt-2">
                    </div>
                </form>
            </div>
            <!-- /.row (main row) -->
        </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
