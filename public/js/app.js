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

// e.g. 1000.0 -> $1,000.00
function formatCurrency(value) {
    return roundToTwo(value).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// e.g. $1,000.00 -> 1000.0
function parseCurrency(value) {
    return parseFloat(value.replace(/\$/g, '').replace(/,/g, ''));
}

// e.g. 1.555555 -> 1.55 BUT 9.1 -> 9.1 (may need toFixed(2))
function roundToTwo(value) {    
    return +(Math.round(value + "e+2")  + "e-2");
}