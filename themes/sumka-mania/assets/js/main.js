function gallery() {
    $('.gallery .thumbnail').click(function (e) {
        e.preventDefault();
        let src = $(this).attr('data-src'),
            $main = $('.gallery .main-photo');
        if ($main.css('background-image') !== `url("${src}")`) {
            $main.fadeOut(function () {
                $(this).attr('href', src);
                $(this).css('background-image', `url('${src}')`);
                console.log($main.css('background-image'))
                $(this).fadeIn();
            });
        }
    });
}

function scrollUp() {
    $('.scroll-up').click(function () {
        $('html,body').animate({
            scrollTop: 0
        }, {
            duration: 1250
        });
    });
}

class Qty {
    enable() {
        $(':input[name=update_cart]').removeAttr('disabled');
    }

    trigger() {
        $(':input[name=update_cart]').trigger("click");
    }

    constructor() {
        setTimeout(() => this.enable());
        $(document.body).on('updated_cart_totals', () => this.enable());
        $('body').on('change', '.qty', () => {
            this.enable();
            this.trigger();
        });
        this.watch();
    }

    watch() {
        $('body').on('click', '.qty-btn', (e) => {
            e.preventDefault();

            let $this = $(e.currentTarget);
            let $input = $this.parent().find('input');

            let current = Math.abs(parseInt($input.val()));

            if ($this.hasClass('qty-plus')) {
                $input.val(++current).trigger("change");
            } else if (current > 0) {
                $input.val(--current).trigger("change");
            }
        });
    }
}

class Woo {
    constructor() {
        $('.add-to-cart').click((e) => {
            e.preventDefault();
            let $btn = $(e.currentTarget);
            let id = $btn.attr('data-id');
            this.addToCart(id, 1, $btn);
        });
    }

    addToCart(id, qty = 1, $btn) {
        let data = {
            action: 'add_to_cart',
            id,
            qty
        };
        $btn.addClass('loading');
        $.post(AdminAjax, data, (res) => {
            res = JSON.parse(res);
            if (res.status === 'ok') {
                $('.mini-cart').replaceWith(res.cart);
                $('.notices-area').fadeOut(function () {
                    $(this).empty().append(res.notice).fadeIn();
                });
            }
        }).done(function () {
            $btn.removeClass('loading');
            $btn.addClass('added');
        });
    }
}

$(() => {
    $('[data-toggle="tooltip"]').tooltip();
    gallery();
    new Woo();
    new Qty();
    scrollUp();
    $("input[type=tel]").mask("+7 (999) 999-99-99");
});