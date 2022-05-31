@extends('layouts.app')
@section('content')
    @include('layouts.headers.cards')
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Kmg Import Products</h3>
                    </div>
                    <!-- Light table -->

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Product</th>
                                    <th scope="col" class="sort" data-sort="budget">Price</th>
                                    <th scope="col" class="sort" data-sort="status">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($products->data as $product)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                @if ($product->images)
                                                    <a href="{{ route('product', $product->id) }}"
                                                        class="avatar rounded-circle mr-3">
                                                        <img alt="{{ $product->name }}"
                                                            src="{{ $product->images[0]->src }}">
                                                    </a>
                                                @endif
                                                <div class="media-body">
                                                    <a href="{{ route('product', $product->id) }}">
                                                        <span class="name mb-0 text-sm">{{ $product->name }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="budget">
                                            @if ($product->price)
                                                ${{ $product->price }}
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i>
                                                <span class="status">{{ $product->status }}</span>
                                            </span>
                                        </td>

                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"
                                                        href="{{ route('product', $product->id) }}">Edit</a>
                                                    <a class="dropdown-item" href="#">Remove</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">

                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">

                                <li class="page-item @unless($products->meta->previous_page) disabled @endunless">
                                    <a class="page-link" href="?page={{ $products->meta->previous_page }}"
                                        tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                {{-- <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li> --}}
                                @for ($i = 1; $i <= $products->meta->total_pages; $i++)
                                    <li class="page-item @if ($i == $products->meta->current_page) active @endif">
                                        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item @unless($products->meta->next_page) disabled @endunless">
                                    <a class="page-link" href="?page={{ $products->meta->next_page }}">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
