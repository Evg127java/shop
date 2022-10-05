@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Admin home</a></li>
                        <li class="breadcrumb-item active">Product's create</li>
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
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="title" value="{{ old('title') }}">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="description" placeholder="description" value="{{ old('description') }}">
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="content" placeholder="content">{{ old('content')}}</textarea>
                        @error('content')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="select2" multiple="multiple" data-placeholder="Select tags" style="width: 100%;" name="tags[]">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ is_array(old('tags')) && in_array($tag->id, old('tags'), false) ? ' selected' : '' }}>{{ $tag->title }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="select2" multiple="multiple" data-placeholder="Select colors" style="width: 100%;" name="colors[]">
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}" {{ is_array(old('colors')) && in_array($color->id, old('colors'), false) ? ' selected' : '' }}>{{ $color->title }}</option>
                            @endforeach
                        </select>
                        @error('colors')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="form-control select2" name="category_id" style="width: 100%;">
                            <option selected disabled>Select category</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ old('category_id') == $category->id ? ' selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="form-control select2" name="group_id" style="width: 100%;">
                            <option selected disabled>Select group</option>
                            @foreach($groups as $group)
                                <option
                                    value="{{ $group->id }}" {{ old('group_id') == $group->id ? ' selected' : '' }}>{{ $group->title }}</option>
                            @endforeach
                        </select>
                        @error('group_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image_preview">Image preview</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input" id="image_preview">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @error('preview_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label>Product images:</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="product_images[1]" type="file" class="custom-file-input" id="product_image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @error('product_images')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="product_images[2]" type="file" class="custom-file-input" id="product_image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @error('product_images')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="product_images[3]" type="file" class="custom-file-input" id="product_image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @error('product_images')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="price" placeholder="price" value="{{ old('price') }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" name="count" placeholder="count" value="{{ old('count') }}">
                        @error('count')
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
