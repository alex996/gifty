$(function() {

    // AJAX call to add a product to the cart
    $('.btn-add-cart').click(function() {
        var btn = $(this);
        var form = $(this).siblings('.form-add-cart');
        var action = form.attr('action');
        $.post(action, form.serialize() )
            .done(function(res) {
                res = JSON.parse(res);
                if (res.status == 1) {
                    var in_cart = $('#in-cart').text();
                    $('#in-cart').text(parseInt(in_cart) + 1);

                    btn.html('Checkout <i class="fa fa-arrow-right" aria-hidden="true"></i>');
                    btn.attr("href", "/cart");
                    btn.off('click');
                }
                else
                    console.log(res.errors);
            }).fail(function() {
                console.log("AJAX request to " + action + "failed.");
            });
    });
});