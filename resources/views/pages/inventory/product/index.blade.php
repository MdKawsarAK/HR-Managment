
@extends('layouts.master')
@section('page')
<div class="container my-4">
  <h4 class="mb-3">Product List</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-center">
      <thead class="table-primary">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Photo</th>
          <th>Offer Price</th>
          <th>Regular Price</th>
          <th>Discount</th>
          <th>Weight (g)</th>
          <th>Barcode</th>
          
          <th>Is Brand</th>
          
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Product Row -->
        @foreach ($products as $product )
          <tr>
          <td>{{$product->id}}</td>
          <td>{{$product->name}}</td>
          <td><img src="{{'img/'.$product->photo}}" alt="{{$product->name}}" width="50" class="img-thumbnail"></td>
          <td>{{$product->offer_price}}</td>
          <td>{{$product->regular_price}}</td>
          <td>{{$product->offer_discount}}%</td>
          <td>{{$product->weight}}</td>
          <td>{{$product->barcode}}</td>
          
          <td><span class="badge bg-secondary">{{$product->is_brand}}</span></td>
          
          <td>
            <a href="/products/47" class="btn btn-sm btn-info" title="View">
             View
            </a>
            <a href="/products/47/edit" class="btn btn-sm btn-warning" title="Edit">
              Edit
            </a>
            <form action="/products/47" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure to delete this product?');">
              <input type="hidden" name="_method" value="DELETE">
              <button class="btn btn-sm btn-danger" title="Delete">
                Delete
              </button>
            </form>
          </td>
        </tr>
        @endforeach

        <!-- More products can go here -->

      </tbody>
    </table>
  </div>
</div>

@endsection