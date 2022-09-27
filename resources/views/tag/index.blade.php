@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tags</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Admin home</a></li>
                        <li class="breadcrumb-item active">Tags</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <a href="{{ route('tag.create') }}" class="">
                    <input type="submit" class="btn btn-primary mb-2" name="submit" value="New">
                </a>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col" colspan=3 class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <th scope="row">{{ $tag->id }}</th>
                            <td>{{ $tag->title }}</td>
                            <td>
                                <a href="{{ route('tag.edit', $tag->id) }}">
                                    <i class="far fa-edit text-warning"></i>
                                </a>
                            </td>
                            <td class="text-center col-2">
                                <form action="{{ route('tag.delete', $tag->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-transparent">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
