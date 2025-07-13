@extends("layouts.master")

@section("page")
  <?php
  use App\Models\Inventory\Product;
  $products = Product::all();

  //print_r($products);
  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-6">
        <h1>General Form</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">General Form</li>
        </ol>
      </div>
      </div>
    </div><!-- /.container-fluid -->
    </section> --}}

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="row">
      <!-- left column -->
      <div class="col-md-12">


        <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th class="d-flex justify-content-center">Action</th>
          </tr>
          @foreach($products as $product)
        <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->offer_price}}</td>
        <td class="d-flex justify-content-center">
        <div class="btn-group">
          <a class="btn btn-primary" href="{{url('products/' . $product->id)}}">View</a>
          <a class="btn btn-danger" href="{{url('products/' . $product->id . '/delete')}}">Delete</a>
          <a class="btn btn-success" href="{{url('products/' . $product->id . '/edit')}}">Edit</a>
        </div>
        </td>
        </tr>
      @endforeach
          </table>
        </div>
        </div>
        <!-- /.card -->
      </div>
      </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection