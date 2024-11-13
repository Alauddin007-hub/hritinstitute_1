@extends('admin.layouts.app')

@section('title', 'Product')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update <small>Product</small></h3>
                        </div>
                        <!-- /.card-header -->
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                            <li>{{$err}}</li>
                            @endforeach
                        </div>
                        @endif
                        <!-- form start -->
                        <form method="post" action="{{ route('product.update', $products->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Produc Name</label>
                                    <input type="text" name="name" value="{{$products->name ? $products->name : old('name') }}" class="form-control">
                                </div>
                                <!-- Current Images -->
                                <div class="form-group">
                                    <label>Current Images</label>
                                    <div>
                                    @if (is_array($products->images))
                                            @foreach ($products->images as $image)
                                            <img src="{{ asset($image) }}" alt="Product Image" width="50">
                                            @endforeach
                                            @elseif (is_string($products->images))
                                            @foreach (json_decode($products->images) as $image)
                                            <img src="{{ asset($image) }}" alt="Product Image" width="50">
                                            @endforeach
                                            @else
                                            No Image
                                            @endif
                                    </div>
                                </div>

                                <!-- Upload New Images -->
                                <div class="form-group">
                                    <label for="images">Upload New Images</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    <small class="form-text text-muted">Upload new images to replace current images.</small>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group">
                                <label for="name">Produc Price</label>
                                <input type="number" name="price" class="form-control" value="{{ old('price', $products->price) }}" required>
                                <div class="form-group">
                                    <label for="name">Produc Quantity</label>
                                    <input type="text" name="quantity" value="{{$products->quantity ? $products->quantity : old('quantity') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" class="form-control" required>
                                        @foreach ($cats as $category)
                                        <option value="{{ $category->id }}" {{ $products->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control">{{ old('description', $products->description) }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection