$(function() {

    // AJAX call to add a product to the cart
    $('.btn-add-cart').click(function() {
        var btn = $(this);
        var form = btn.closest('.form-add-cart');
        var action = form.attr('action');
        var quantity = form.find('input[name="quantity"]').val();

        $.post(action, form.serialize() )
            .done(function(res) {
                res = JSON.parse(res);
                if (res.status == 1) {
                    var in_cart = $('#in-cart').text();
                    $('#in-cart').text(parseInt(in_cart) + parseInt(quantity));

                    btn.html('Checkout <i class="fa fa-arrow-right" aria-hidden="true"></i>');
                    btn.attr("href", "/cart");
                    btn.off('click');
                }
                else
                    alert(res.errors.shift());
            }).fail(function() {
                console.log("AJAX request to " + action + "failed.");
            });
    });
});