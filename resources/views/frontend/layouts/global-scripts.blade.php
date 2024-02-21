<script>
    // Load Product Modal
    function loadProductModal(productId) {
        $.ajax({
            method: 'GET',
            url: `{{ route('load-product-modal', ':productId') }}`.replace(':productId', productId),
            beforeSend: function() {
                $('.overlay-container').removeClass('d-none');
                $('.overlay').addClass('active');
            },
            success: function(response) {
                $('.load_product_modal_body').html(response);
                $('#cartModal').modal('show');

            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            complete: function() {
                $('.overlay').removeClass('active');
                $('.overlay-container').addClass('d-none');

            }
        })
    }

    // Update sidebar cart
    function updateSidebarCart() {
        $.ajax({
            method: 'GET',
            url: `{{ route('get-cart-products') }}`,
            beforeSend: function() {

            },
            success: function(response) {
                $('.cart_contents').html(response);

            },
            error: function(xhr, status, error) {

            },
            complete: function() {


            }
        })
    }
</script>
