@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product's editing</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Admin home</a></li>
                        <li class="breadcrumb-item active">Product's editing</li>
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
                <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="name" value="{{ $product->title }}">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="description" placeholder="description" value="{{ $product->description }}">
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="content" placeholder="content">{{ $product->content }}</textarea>
                        @error('content')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="select2" multiple="multiple" data-placeholder="Select tags" style="width: 100%;" name="tags[]">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ $product->tags && $product->tags->pluck('id')->contains($tag->id) ? ' selected' : '' }}>{{ $tag->title }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="select2" multiple="multiple" data-placeholder="Select colors" style="width: 100%;" name="colors[]">
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}" {{ $product->colors && $product->colors->pluck('id')->contains($color->id) ? ' selected' : '' }}>{{ $color->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control select2" name="category_id" style="width: 100%;">
                            <option selected disabled>Select category</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ $product->category_id == $category->id ? ' selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(!is_null($product->preview_image))
                        <div class="w-25" >
                            <img src="{{ Storage::url($product->preview_image) }}" alt="image" style="width: 128px;">
                        </div>
                    @endif
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @error('preview_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" name="price" placeholder="price" value="{{ $product->price }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" name="count" placeholder="count" value="{{ $product->count }}">
                        @error('count')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary mt-2">
                    </div>
                </form>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
