@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
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
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="name" value="{{ $user->name }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="surname" placeholder="surname" value="{{ $user->surname }}">
                        @error('surname')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="patronymic" placeholder="patronymic" value="{{ $user->patronymic }}">
                        @error('patronymic')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="n" class="form-control" name="age" placeholder="age" value="{{ $user->age }}">
                        @error('age')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="address" value="{{ $user->address }}">
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select name="gender" id="gender"class="custom-select">
                            <option disabled selected>Gender</option>
                            <option {{ $user->gender === 1 ? ' selected ' : ''}} value="1">Male</option>
                            <option {{ $user->gender === 2 ? ' selected ' : ''}} value="2">Female</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <input type="submit" value="Edit" class="btn btn-primary mt-2">
                    </div>
                </form>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
