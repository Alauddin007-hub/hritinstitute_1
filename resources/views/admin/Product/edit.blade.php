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
                        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Produc Name</label>
                                    <input type="text" name="name" value="{{$products->name ? $products->name : old('name') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name">Produc Image</label>
                                    <input type="file" name="images[]" multiple accept="image/*" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name">Produc Price</label>
                                    <input type="text" name="price" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name">Produc Quantity</label>
                                    <input type="text" name="quantity" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name">Category</label>
                                    <select name="category_id" class="form-control">
                                        
                                        <option value="selected">Chosse once</option>
                                        @foreach ($cats as $cat)
                                        <option value="{{$cat->id}}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control"></textarea>
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