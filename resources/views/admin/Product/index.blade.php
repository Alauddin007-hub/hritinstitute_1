@extends('admin.layouts.app')

@section('title', 'Product')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
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
                        <div class="card-header ">
                            <h3 class="card-title">Product Details</h3><br>
                            <div>
                                <a href="{{route('product.create')}}" class="btn btn-info"> Add Product</a>
                            </div>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $products as $key=>$item )
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>
                                            @if (is_array($item->images))
                                            @foreach ($item->images as $image)
                                            <img src="{{ asset($image) }}" alt="Product Image" width="50">
                                            @endforeach
                                            @elseif (is_string($item->images))
                                            @foreach (json_decode($item->images) as $image)
                                            <img src="{{ asset($image) }}" alt="Product Image" width="50">
                                            @endforeach
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->category->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>
                                            <a class="btn btn-secondary" href="{{route('product.edit', $item->id)}}"><i class="fa-solid fa-pen-to-square"></i>edit</a>

                                            <a class="btn btn-danger" href="{{route('product.delete', $item->id)}}" onclick="return confirm('Are you sure to delete')"><i class="fa-solid fa-trash">delete</i></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection