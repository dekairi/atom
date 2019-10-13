$(document).ready(function() {
    $('.reviews-slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: '<button class="btn-sliders-reviews_left" type="button"><img src="img/left-arrow.png"></button>',
        nextArrow: '<button class="btn-sliders-reviews_right" type="button"><img src="img/right-arrow.png"></button>',
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.slider-trust').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        prevArrow: '<button class="btn-sliders-reviews_left" type="button"><img src="img/left-arrow.png"></button>',
        nextArrow: '<button class="btn-sliders-reviews_right" type="button"><img src="img/right-arrow.png"></button>',
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.btn-offer, .wave-btn, .btn-curse').on('click', function(e) {
        e.preventDefault();
        $('#exampleModal').arcticmodal();
    });

    ///плавная прокрутка к секции
    $("a.go").click(function(e) {
        e.preventDefault();
        elementClick = $(this).attr("href");
        destination = $(elementClick).offset().top;
        $("body,html").animate({ scrollTop: destination }, 800);
    });

    // menu-mobile
    $('.hamburger').on('click', function() {
        $(this).toggleClass('hamburger_active');
        $('.menu-mobs').toggleClass('menu_active');
        $('html').toggleClass('html-scroll');
    });

    $('.main-menu__link').on('click', function() {
        $('html').removeClass('html-scroll');
        $('.hamburger').removeClass('hamburger_active');
        $('.menu-mobs').removeClass('menu_active');
    });




    /*===========*/
    $('input#dr[type=checkbox]').on('click', function() { if ($(this).is(':checked')) { $('input#dr[type=text]').prop("disabled", false); } else { $('input#dr[type=text]').prop("disabled", true); } });

    $('form').on('submit', function() {
        event.preventDefault();
        var form = $(this).attr('class').split(' ')[0];
        var msg = "&form=" + form + "&" + $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'send.php',
            data: msg,
            dataType: 'json',
            success: function(data) {
                if (data.form == 'payment-smm') {
                    var cpn_month = data.cpn_month;
                    var cpn_one = data.cpn_one;
                    var idModal = $('form.payment-smm').parent().attr('id');

                    $('.cpn_month').text(cpn_month);
                    $('.cpn_one').text(cpn_one);

                    $('#' + idModal).arcticmodal('close');
                    $('#exampleModal1').arcticmodal();
                } else {
                    var formObj = $('.' + form);
                    var f_h = $(formObj).height();
                    var f_w = $(formObj).width();
                    var content = "";

                    $(formObj).height(f_h);
                    $(formObj).width(f_w);

                    content = "<div class='rezult' style='display:none;'>";
                    content += "<div class='msg_submit_wrp'>";
                    content += "<div class='msg_submit'>";
                    content += "Сообщение отправлено.</br>Спасибо Вам <strong>" + data.fio + "</strong>, мы скоро свяжемся с Вами."
                    content += "</div>";
                    content += "</div>";
                    content += "</div>";

                    $(formObj).children('.form_wrp').after(content);
                    $(formObj).children('.form_wrp').fadeOut();
                    $(formObj).children('.rezult').fadeIn();
                }
            },
            error: function(xhr, str) {
                console.log(xhr);
            }
        });
    });
});