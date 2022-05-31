@extends('layouts.app')
@section('content')
    @include('layouts.headers.cards')
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card p-4">
                    @if (Session::has('success'))
                        <div class="card-header border-0">
                            <div class="alert alert-success" id="alert">
                                <strong>Success:</strong> {{ Session::get('success') }}
                            </div>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger" id="alert">

                            <strong>Error:</strong>{{ Session::get('error') }}
                        </div>
                    @endif
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('products') }}">All Product</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                            </ol>
                        </nav>
                        <h3 class="mb-0">{{ $product->name }}</h3>
                        {{-- <p><b>Price:</b> {{ $product->price }}</p> --}}
                        {{-- <p>Regular Price: {{ $product->regular_price }}</p>
                        <p>Sale Price: {{ $product->sale_price }}</p> --}}
                    </div>

                    <form method="post" action="{{ route('product.update', $product->id) }}">
                        @csrf
                        @forelse ($variants as $variant)
                            <div class="card-header border-0">
                                @foreach ($variant->attributes as $attr)
                                    <h3 class="mb-0">{{ $attr->name }}:
                                        {{ $attr->option }}</h3>
                                @endforeach
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Regular Price
                                                ($)
                                            </label>
                                            <input name=" {{ $variant->id }}[] " class="form-control" type="text"
                                                value="{{ $variant->regular_price }}" id="variant-regular-price">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Sale Price
                                                ($)</label>
                                            <input name="{{ $variant->id }}[]" class="form-control" type="text"
                                                value="{{ $variant->sale_price }}" id="variant-sale-price">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card-header border-0">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Regular Price
                                                ($)
                                            </label>
                                            <input name=" {{ $product->id }}[] " class="form-control" type="text"
                                                value="{{ $product->regular_price }}" id="product-regular-price">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Sale Price
                                                ($)</label>
                                            <input name="{{ $product->id }}[]" class="form-control" type="text"
                                                value="{{ $product->sale_price }}" id="product-sale-price">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                        <div class="card-header">
                            <button type="submit" class="btn btn-success btn-lg"
                                style="width: 250px !important;">Update</button>
                            <button type="reset" class="btn btn-warning btn-lg"
                                style="width: 250px !important;">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
