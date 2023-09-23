{{-- {{ $product->categories->name }} --}}
@extends('layouts.backendapp')
@section('title', 'Product')
@section('backendContent')

    <div class="page_header mt-3">
        <div class="card_body">
            <h3>Product</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header_card_links d-flex align-items-center">
                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.product.create') }}" class="btn btn-primary">Create</a>
                        </div>

                        <div class="links_item pr-5 ">
                            <a href="{{ route('dashboard.product.archieve') }}" class="btn btn-primary">Archieve</a>
                        </div>

                        <div class="links_item pr-5  ">
                            <a href="{{ route('dashboard.product.index') }}" class="btn btn-primary">Refresh</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table mb-0 thead-border-top-0">
                <thead>
                    <th>Image</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Categories</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Discount</th>
                    <th>Action</th>
                </thead>

                @forelse ($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="" width="60"
                                style="border-radius: 10px">
                        </td>
                        <td>{{ $product->user->name }}</td>
                        <td>{{ Str::limit($product->title, 15, '...') }}</td>
                        <td>
                            @foreach ($product->categories as $category)
                                <a class="badge badge-info">
                                    {{ $category->name ?? '' }}
                                </a>
                            @endforeach
                        </td>
                        <td>
                            {{ $product->price }}
                            <input type="radio" name="price" class="price-checkbox" data-price="{{ $product->price }}">
                        </td>
                        <td>
                            {{ $product->sale_price }}
                            <input type="radio" name="price" class="sale-price-checkbox"
                                data-sale-price="{{ $product->sale_price }}">
                        </td>
                        <td>{{ $product->discount }}</td>
                        <td>
                            <a href="{{ route('dashboard.inventory.create', $product->id) }}"
                                class="badge bg-warning">Inventory</a>
                            @can('edit')
                                <a href="{{ route('dashboard.product.edit', $product->id) }}" class="badge bg-success">Edit</a>
                            @endcan

                            @can('edit')
                                <form action="{{ route('dashboard.product.delete', $product->id) }}" method="post"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button class="badge bg-danger border-0 delete_btn" type="button">Delete</button>
                                </form>
                            @endcan

                            <button class="send-whatsapp-button" onclick="sendToWhatsApp(this)">
                                Send to WhatsApp
                            </button>

                            {{-- <a
                                href="whatsapp://send?text=Product_Name%20{{ $product->title }}%0APrice%20{{ $product->price }}%0ADiscount%20{{ $product->discount }}%0AClient_Name:%20{{ $product->user->name }}%0AImage:%20{{ asset('storage/products/' . $product->image) }}"><i
                                    class="lab la-whatsapp text-success h3 vertical-align-center"></i></a> --}}

                        </td>

                    </tr>
                @empty
                    <td colspan="8" width="200" style="text-align:center;vertical-align:middle">
                        <div class="empty_img m-auto">
                            <img src="{{ asset('assets/backend/images/logos/empty.png') }}" alt="" class="w-50">
                        </div>
                    </td>
                @endforelse


            </table>
            {{ $products->links('vendor.custome') }}
        </div>
    </div>
@endsection

@section('sweet-js')
    <script>
        $('.delete_btn').on('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('form').submit();
                }
            })
        })
    </script>

    <script>
        function sendToWhatsApp(button) {
            const row = button.closest('tr');
            const priceCheckbox = row.querySelector('.price-checkbox');
            const salePriceCheckbox = row.querySelector('.sale-price-checkbox');

            if (priceCheckbox.checked) {
                sendToWhatsAppWithPrice(priceCheckbox.getAttribute('data-price'));
            } else if (salePriceCheckbox.checked) {
                sendToWhatsAppWithPrice(salePriceCheckbox.getAttribute('data-sale-price'));
            } else {
                alert('Please select a price.');
            }
        }

        function sendToWhatsAppWithPrice(selectedPrice) {
            const productTitle = encodeURIComponent("Product Title: {{ $product->title }}");
            const productPrice = encodeURIComponent("Price: " + selectedPrice);
            const clientName = encodeURIComponent("Client Name: {{ $product->user->name }}");
            const productImage = encodeURIComponent("Image: {{ asset('storage/products/' . $product->image) }}");

            const whatsappLink = `whatsapp://send?text=${productTitle}%0A${productPrice}%0A${clientName}%0A${productImage}`;
            window.location.href = whatsappLink;
        }
    </script>
@endsection
 
