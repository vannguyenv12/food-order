<script>
    function showLoader() {
        $('.overlay-container').removeClass('d-none');
        $('.overlay').addClass('active');
    }

    function hideLoader() {
        $('.overlay').removeClass('active');
        $('.overlay-container').addClass('d-none');
    }
    // Load Product Modal
    function loadProductModal(productId) {
        $.ajax({
            method: 'GET',
            url: `{{ route('load-product-modal', ':productId') }}`.replace(':productId', productId),
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                $('.load_product_modal_body').html(response);
                $('#cartModal').modal('show');

            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {
                hideLoader();

            }
        })
    }

    // Update sidebar cart
    function updateSidebarCart(callback = null) {
        $.ajax({
            method: 'GET',
            url: `{{ route('get-cart-products') }}`,
            success: function(response) {
                $('.cart_contents').html(response);
                const cartTotal = $('#cart_total').val();
                const cartCount = $('#cart_products_count').val();

                $('.cart_subtotal').text(`{{ currencyPosition('${cartTotal}') }}`)
                $('.cart_count').text(cartCount);

                if (callback && typeof callback === 'function') {
                    callback();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
        })
    }

    // Remove Sidebar Cart
    function removeProductFromSidebar(rowId) {
        $.ajax({
            method: 'GET',
            url: `{{ route('cart-product-remove', ':rowId') }}`.replace(':rowId', rowId),
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                if (response.status === 'success') {
                    updateSidebarCart(function() {
                        toastr.success(response.message);
                        hideLoader();
                    });
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.message;
                toastr.error(errorMessage);
            },
            complete: function() {
                hideLoader();
            }
        })
    }
</script>
