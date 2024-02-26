<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
<form action="" id="modal_add_to_cart_form">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="fp__cart_popup_img">
        <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100">
    </div>
    <div class="fp__cart_popup_text">
        <a href="{{ route('product.show', $product->slug) }}" class="title">{!! $product->name !!}</a>
        <p class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <span>(201)</span>
        </p>
        <h4 class="price">
            @if ($product->offer_price > 0)
                <input type="hidden" name="base_price" value="{{ $product->offer_price }}">

                {{ currencyPosition($product->offer_price) }}
                <del>{{ currencyPosition($product->price) }} </del>
            @else
                <input type="hidden" name="base_price" value="{{ $product->price }}">

                {{ currencyPosition($product->price) }}
            @endif

        </h4>

        @if ($product->productSizes()->exists())
            <div class="details_size">
                <h5>select size</h5>
                @foreach ($product->productSizes as $productSize)
                    <div class="form-check">
                        <input class="form-check-input modal_product_size" type="radio" name="product_size"
                            data-price="{{ $productSize->price }}" id="size-{{ $productSize->id }}"
                            value="{{ $productSize->id }}">
                        <label class="form-check-label" for="size-{{ $productSize->id }}">
                            {{ $productSize->name }} <span>+ {{ currencyPosition($productSize->price) }}</span>
                        </label>
                    </div>
                @endforeach

            </div>
        @endif

        @if ($product->productOptions()->exists())
            <div class="details_extra_item">
                <h5>select option <span>(optional)</span></h5>
                @foreach ($product->productOptions as $productOption)
                    <div class="form-check">
                        <input class="form-check-input modal_product_option" type="checkbox" name="product_option[]"
                            value="{{ $productOption->id }}" id="option-{{ $productOption->id }}"
                            data-price="{{ $productOption->price }}">
                        <label class="form-check-label" for="option-{{ $productOption->id }}">
                            {{ $productOption->name }} <span>+ {{ currencyPosition($productOption->price) }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endif


        <div class="details_quentity">
            <h5>select quentity</h5>
            <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                <div class="quentity_btn">
                    <button class="btn btn-danger decrement"><i class="fal fa-minus"></i></button>
                    <input type="text" id="quantity" placeholder="1" name="quantity" value="1" readonly>
                    <button class="btn btn-success increment"><i class="fal fa-plus"></i></button>
                </div>
                @if ($product->offer_price > 0)
                    <h3 id="total_price">{{ currencyPosition($product->offer_price) }}</h3>
                @else
                    <h3 id="total_price">{{ currencyPosition($product->price) }}</h3>
                @endif
            </div>
        </div>
        <ul class="details_button_area d-flex flex-wrap">
            @if ($product->quantity === 0)
                <li><button class="common_btn bg-danger" type="button">Stock Out</button></li>
            @else
                <li><button class="common_btn modal_cart_button" type="submit">add to cart</button></li>
            @endif
        </ul>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('input[name="product_size"]').on('change', function() {
            updateTotalPrice();
        });

        $('input[name="product_option[]"]').on('change', function() {
            updateTotalPrice();
        });

        // Update quantity
        $('.increment').on('click', function(e) {
            e.preventDefault();

            let quantity = $('#quantity');
            let currentQuantity = parseFloat(quantity.val());
            quantity.val(currentQuantity + 1);
            updateTotalPrice();
        })

        $('.decrement').on('click', function(e) {
            e.preventDefault();

            let quantity = $('#quantity');
            let currentQuantity = parseFloat(quantity.val());
            if (currentQuantity > 1) {
                quantity.val(currentQuantity - 1);
                updateTotalPrice();
            }
        })

        // Update price
        function updateTotalPrice() {
            let basePrice = parseFloat($('input[name="base_price"]').val());
            let selectedSizePrice = 0;
            let selectedOptionsPrice = 0;
            let quantity = parseFloat($('#quantity').val());

            // Calculate the selected size price
            let selectedSize = $('.modal_product_size:checked');
            if (selectedSize.length > 0) {
                selectedSizePrice = parseFloat(selectedSize.data('price'));
            }

            // Calculate the selected option price
            let selectedOptions = $('input[name="product_option[]"]:checked');
            $(selectedOptions).each(function() {
                selectedOptionsPrice += parseFloat($(this).data('price'));
            })



            // Calculate total price
            let totalPrice = (basePrice + selectedSizePrice + selectedOptionsPrice) * quantity;

            $('#total_price').text("{{ config('settings.site_currency_icon') }}" + totalPrice);
        }

        // Add to cart submit form
        $('#modal_add_to_cart_form').on('submit', function(e) {
            e.preventDefault();

            // Validation
            let selectedSize = $('.modal_product_size');

            if (selectedSize.length > 0) {
                if (!$('.modal_product_size:checked').val()) {
                    toastr.error('Please select a size');
                    console.error('Please select a size')
                    return;
                }

            }


            let formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: `{{ route('add-to-cart') }}`,
                data: formData,
                beforeSend: function() {
                    $('.modal_cart_button').attr('disabled', true);

                    $('.modal_cart_button').html(
                        `<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Loading...`
                    );
                },
                success: function(response) {
                    updateSidebarCart();
                    toastr.success(response.message);
                },
                error: function(xhr, status, error) {
                    let errorMessage = xhr.responseJSON.message;
                    toastr.error(errorMessage);
                },
                complete: function() {
                    $('.modal_cart_button').html(
                        `Add To Cart`
                    );
                    $('.modal_cart_button').attr('disabled', false);

                }
            })
        })
    })
</script>
