@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Admin home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                <a href="{{ route('product.create') }}" class="">
                    <input type="submit" class="btn btn-primary mb-2" name="submit" value="New">
                </a>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Content</th>
                        <th scope="col">Preview</th>
                        <th scope="col">Price</th>
                        <th scope="col">In stock</th>
                        <th scope="col">Is_published</th>
                        <th scope="col" colspan=2 class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="text-center">
                            <th scope="row"  class="align-middle">{{ $product->id }}</th>
                            <td  class="align-middle">{{ $product->title }}</td>
                            <td class="align-middle">{{ $product->description }}</td>
                            <td class="align-middle">{{ $product->content }}</td>

                            <td class="align-middle">
                                <a href="{{ Storage::url($product->preview_image) }}">
                                    <img src="{{ Storage::url($product->preview_image) }}" alt="image"
                                         style="width: 64px;">
                                </a>
                            </td>

                            <td class="align-middle">{{ $product->price }}</td>
                            <td class="align-middle">{{ $product->count }}</td>
                            <td class="align-middle">{{ $product->is_published ? 'Yes' : 'No' }}</td>
                            <td  class="align-middle">
                                <a href="{{ route('product.edit', $product->id) }}">
                                    <i class="far fa-edit text-warning"></i>
                                </a>
                            </td>
                            <td  class="align-middle col-0">
                                <form action="{{ route('product.delete', $product->id) }}"
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
