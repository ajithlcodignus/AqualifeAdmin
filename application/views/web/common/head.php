<title>Foodveno</title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="https://yesvalue.in/images/favicon/favicon.png">
<link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script src="<?= base_url() ?>js/jquery.min.js"></script>
<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/web_style.css">
<link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
<script>
    $(document).ready(function() {
        <?php if ((!empty($is_category)) || (!empty($is_search_result))) { ?>
            $('html, body').animate({
                scrollTop: $(".product_container").offset().top - 100
            });
        <?php } ?>
        $('.loading_more_product').hide();
        $(window).on('scroll', function() {

            var navHeight = parseInt($('.banner_section').height()+$('#carousel_container').height());
            ($(window).scrollTop() > navHeight) ? $('nav').addClass('goToTop'): $('nav').removeClass(
                'goToTop');
            ($(window).scrollTop() > navHeight) ? addClass(): removeClass();
            <?php if (empty($is_search_result)) { ?>
                if (parseInt($(window).scrollTop() + $(window).height() + 300) >= parseInt($(document).height())) {

                    if ($('#product_container').length) {
                        var last_id = $(".product_id:last").attr("l_i_d");
                        $('#side_menu_substi').addClass('side_menu_substi');

                        $.ajax({
                                url: "<?= (!empty($is_category)) ? base_url('load_more_category/' . $category_id) : base_url('load_more_products') ?>",
                                type: 'POST',
                                data: {
                                    last_id: last_id
                                },
                                dataType: 'json',
                                beforeSend: function() {
                                    $('.loading_more_product').show();
                                }
                            }).done(function(data) {

                                $('.loading_more_product').hide();
                                if (data.status) {
                                    $("#product_container").append(data.html);
                                }

                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {

                            });

                    }
                }

            <?php } ?>
        });



    });

    function addClass() {

        $('#side_menu_fix').addClass('side_menu_fix');
        // $('#temp_sidebar').show();
        $('#side_menu_substi').show();


    }

    function removeClass() {

        $('#side_menu_fix').removeClass('side_menu_fix');
        // $('#temp_sidebar').hide();
        $('#side_menu_substi').hide();

    }
</script>
