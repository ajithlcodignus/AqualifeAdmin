<!-- jQuery -->


<!-- jquery-validation -->
<script src="<?php echo base_url(); ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    jQuery(document).ready(function() {
        $.validator.addMethod('mobileValidation', function(value, element) {
            return this.optional(element) || /[0-9]{10}/.test(value) && /^.{1,10}$/.test(value);
        }, "Please enter a valid phone number");

        $('#signupForm').validate({
            rules: {
                sign_up_name: {
                    required: true,
                    maxlength: 12,
                    minlength: 3
                },
                sign_up_emailId: {
                    required: true,
                    email: true
                },
                sign_up_mobile: {
                    required: true,
                    mobileValidation: '#sign_up_mobile',
                },
                sign_up_password: {
                    required: true,
                    maxlength: 15,
                    minlength: 5
                },
            },
            messages: {
                name: {
                    required: "Name field is required.",
                    maxlength: "Please enter a valid name",
                    minlength: "Please enter a valid name(Min Length)"
                },
                sign_up_emailId: {
                    required: "Email field is required.",
                    email: "Please enter a valid email address"
                },
                sign_up_mobile: {
                    required: "Mobile field is required.",
                },
                sign_up_password: {
                    required: "Password field is required.",
                    maxlength: "Enter a valid password(Max Length)",
                    minlength: "Enter a valid password(Min Length)"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {

                var mobile = $('#sign_up_mobile').val();
                var emailId = $('#sign_up_emailId').val();
                var password = $('#sign_up_password').val();
                var name = $('#sign_up_name').val();
                $.ajax({
                    url: "<?= base_url('register') ?>",
                    type: 'POST',
                    data: {
                        mobile: mobile,
                        password: password,
                        emailId: emailId,
                        name: name,
                    },
                    dataType: 'json',
                    success: function(data) {

                        var decodedData = jQuery.parseJSON(JSON.stringify(data));
                        if (decodedData['status'] == 0) {
                            $('#signUpError').text(data.error);

                        } else {
                            location.reload(true);
                        }

                    },

                });

                return false; // required to block normal submit since you used ajax
            }
        });





        $('#loginForm').validate({
            rules: {
                mobile: {
                    required: true,
                    mobileValidation: '#mobile',
                },
                password: {
                    required: true,
                    maxlength: 15,
                    minlength: 5
                },
            },

            messages: {
                mobile: {
                    required: "Mobile field is required.",
                },
                password: {
                    required: "Password field is required.",
                    maxlength: "Enter a valid password(Max Length)",
                    minlength: "Enter a valid password(Min Length)"
                },
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            errorLabelContainer: "#loginError",
            submitHandler: function(form) {
                var mobile = $('#mobile').val();
                var password = $('#password').val();
                $.post("<?= base_url('get_login'); ?>", {
                    mobile: mobile,
                    password: password,
                }, function(data) {

                    if (data.length > 0) {

                        if (data != 1) {

                            $('#loginError').text(data);

                        } else {
                            location.reload(true);
                        }
                    }
                })

                return false; // required to block normal submit since you used ajax
            }
        });


        $('#loginForm1').validate({
            rules: {
                mobile1: {
                    required: true,
                    mobileValidation: '#mobile1',
                },
                password1: {
                    required: true,
                    maxlength: 15,
                    minlength: 5
                },
            },

            messages: {
                mobile1: {
                    required: "Mobile field is required.",
                },
                password1: {
                    required: "Password field is required.",
                    maxlength: "Enter a valid password(Max Legth)",
                    minlength: "Enter a valid password(Min Legth)"
                },
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },

            submitHandler: function(form) {
                var mobile = $('#mobile1').val();
                var password = $('#password1').val();
                $.post("<?= base_url('get_login'); ?>", {
                    mobile: mobile,
                    password: password,
                }, function(data) {
                    if (data.length > 0) {

                        if (data != 1) {

                            $('#loginError').text(data);

                        } else {
                            location.reload(true);
                        }
                    }
                })

                return false; // required to block normal submit since you used ajax
            }
        });



        $('#profileUpdateForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 12,
                    minlength: 3
                },
                emailId: {
                    required: true,
                    email: true
                },
            },

            messages: {
                name: {
                    required: "Name field is required.",
                    maxlength: "Please enter a vaild name",
                    minlength: "Please enter a vaild name(Min Legth)"
                },
                emailId: {
                    required: "Email field is required.",
                    email: "Please enter a vaild email address"
                },
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });



        $('#passwordChangeForm').validate({
            rules: {
                currentPassword: {
                    required: true,
                },
                newPassword: {
                    required: true,
                    maxlength: 15,
                    minlength: 5
                },
                confirmPassword: {
                    required: true,
                    equalTo: "#newPassword"
                },
            },

            messages: {
                currentPassword: {
                    required: "Password field is required."
                },
                newPassword: {
                    required: "Password field is required.",
                    maxlength: "Enter a valid password(Max Legth)",
                    minlength: "Enter a valid password(Min Legth)"
                },
                confirmPassword: {
                    required: "Password field is required.",
                    equalTo: " Enter Confirm Password Same as Password"
                },
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },

            submitHandler: function(form) {
                var password = $('#currentPassword').val();
                var newPassword = $('#newPassword').val();
                if (password == newPassword) {
                    $('#errorMessage').show()

                    $('#errorMessage').text('Cann\'t use existing password');
                } else {

                    $('#errorMessage').hide();
                    $.post("<?= base_url('update_password'); ?>", {
                        currentPassword: password,
                        newPassword: newPassword,
                    }, function(data) {
                        if (data.length > 0) {
                            $('#errorMessage').show()
                            $('#errorMessage').text(data);
                        } else {
                            location.reload(true);
                        }
                    });
                }

                return false; // required to block normal submit since you used ajax
            }
        });


        $('#addAddressForm').validate({
            rules: {
                houseName: {
                    required: true
                },
                fullAddress: {
                    required: true
                },

                pinCode: {
                    required: true,
                    number: true,
                    maxlength: 6
                },
            },

            messages: {
                houseName: {
                    required: "House Name /Door No field is required."
                },
                fullAddress: {
                    required: "Address field is required."
                },
                landmark: {
                    required: "Landmark field is required."
                },
                pinCode: {
                    required: "PIN code field is required.",
                    number: "Please enter a valid PIN code.",
                    maxlength: "Enter a valid PIN code(Max Legth 6)."
                },
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                var latitude;
                var longitude;
                var fullAddress = $('#fullAddress').val();
                var houseName = $('#houseName').val();
                var pinCode = $('#pinCode').val();
                var landmark = $('#landmark').val();

                // if ("geolocation" in navigator) { //check geolocation available 
                // navigator.geolocation.getCurrentPosition(function(position) {
                // latitude = position.coords.latitude;
                // longitude = position.coords.longitude;
                //  latitude=1.0;
                //  longitude=1.0; });
                latitude = 1.0;
                longitude = 1.0;

                $.ajax({
                    url: "<?= base_url('add_address') ?>",
                    type: 'POST',
                    data: {
                        fullAddress: fullAddress,
                        houseName: houseName,
                        pinCode: pinCode,
                        landmark: landmark,
                        latitude: latitude,
                        longitude: longitude,
                    },
                    dataType: 'json',
                    success: function(data) {

                        var decodedData = jQuery.parseJSON(JSON.stringify(data));
                        if (decodedData['status'] == 0) {
                            $('#signUpError').text(data.error);

                        } else {
                            location.reload(true);
                        }

                    },

                });

                // } else {

                // }
            }
        });

        $('#editAddressForm').validate({
            rules: {
                editHouseName: {
                    required: true
                },
                editFullAddress: {
                    required: true
                },

                editPinCode: {
                    required: true,
                    number: true,
                    maxlength: 6
                },
            },

            messages: {
                editHouseName: {
                    required: "House Name /Door No field is required."
                },
                editFullAddress: {
                    required: "Address field is required."
                },
                editLandmark: {
                    required: "Landmark field is required."
                },
                editPinCode: {
                    required: "PIN code field is required.",
                    number: "Please enter a valid PIN code.",
                    maxlength: "Enter a valid PIN code(Max Legth 6)."
                },
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                var latitude;
                var longitude;
                var fullAddress = $('#editFullAddress').val();
                var houseName = $('#editHouseName').val();
                var pinCode = $('#editPinCode').val();
                var landmark = $('#editLandmark').val();

                // if ("geolocation" in navigator) { //check geolocation available 
                // navigator.geolocation.getCurrentPosition(function(position) {
                // latitude = position.coords.latitude;
                // longitude = position.coords.longitude;
                //  latitude=1.0;
                //  longitude=1.0; });
                latitude = 2.5;
                longitude = 3.6;

                $.ajax({
                    url: "<?= base_url('edit_address') ?>",
                    type: 'POST',
                    data: {
                        fullAddress: fullAddress,
                        houseName: houseName,
                        pinCode: pinCode,
                        landmark: landmark,
                        latitude: latitude,
                        longitude: longitude,
                    },
                    dataType: 'json',
                    success: function(data) {

                        var decodedData = jQuery.parseJSON(JSON.stringify(data));
                        if (decodedData['status'] == 0) {
                            $('#signUpError').text(data.error);

                        } else {
                            location.reload(true);
                        }

                    },

                });

                // } else {

                // }
            }
        });


        $('#editProfileForm').validate({
            rules: {
                proName: {
                    required: true
                },
                proEmail: {
                    required: true
                },


            },

            messages: {
                proName: {
                    required: " Name field is required."
                },
                proEmail: {
                    required: "Email field is required."
                },

            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {

                var proName = $('#proName').val();
                var proEmail = $('#proEmail').val();

                $.ajax({
                    url: "<?= base_url('edit_profile') ?>",
                    type: 'POST',
                    data: {
                        name: proName,
                        emailId: proEmail,

                    },
                    dataType: 'json',
                    success: function(data) {

                        var decodedData = jQuery.parseJSON(JSON.stringify(data));
                        if (decodedData['status'] == 0) {
                            $('#signUpError').text(data.error);

                        } else {
                            location.reload(true);
                        }

                    },

                });

            }
        });




        $(document).on('click', '.delete_address', function() {

            $.ajax({
                url: "<?= base_url('delete_address') ?>",
                type: 'POST',

                dataType: 'json',
                success: function(data) {

                    var decodedData = jQuery.parseJSON(JSON.stringify(data));
                    // alert(decodedData['status']);
                    if (decodedData['status'] == 0) {
                        $('.error_message').html("<div class='alert alert-warning mt-5'>" +
                            decodedData['demo_error_string'] + '</div>');
                        $('html, body').animate({
                            scrollTop: $("#address_container").offset().top - 100
                        });

                    } else {
                        alert('Address Delete success fully');
                        location.reload(true);
                    }

                },

            });
        });


        $(document).on('click', '.place_order', function() {

            $.ajax({
                url: "<?= base_url('place_order') ?>",
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    var decodedData = jQuery.parseJSON(JSON.stringify(data));
                    if (decodedData['status'] == 0) {
                        $('.error_message').html("<div class='alert alert-warning mt-5'>" +
                            decodedData['demo_error_string'] + '</div>');
                        $('html, body').animate({
                            scrollTop: $("#address_container").offset().top - 100
                        });
                    } else {
                        location.reload(true);
                    }
                },

            });
        });

        $(document).on('click', '.cancel_order', function() {
            $.ajax({
                url: "<?= base_url('cancel_order') ?>",
                type: 'POST',
                dataType: 'json',
                success: function(data) {


                    $('#message_container').removeClass('alert-success');
                    if (data.status == 1) {
                        $('#message_container').addClass('alert-warning');
                        $('#cancel_order').attr('disabled', 'true');
                    } else if (data.status == 0) {
                        $('#message_container').addClass('alert-danger');
                    }
                    $('#message_container').html(data.demo_error_string);

                    $('html, body').animate({
                        scrollTop: $("#message_container").offset().top - 100
                    });

                },

            });
        });

        $(document).on('focusout', '#search_item', function() {
            // $('#search_suggestion').hide();
            // $('#search_item').val('');
        });

        $(document).on('keyup', '#search_item', function() {
            var keyword = $('#search_item').val();
            $('#search_suggestion').html('<li class="list-group-item contsearch"><span>Searching...</span></li>');

            $.ajax({
                url: "<?= base_url('search_product') ?>",
                type: 'POST',
                data: {
                    keyword: keyword
                },
                dataType: 'json',
                success: function(data) {

                    var decodedData = jQuery.parseJSON(JSON.stringify(data));
                    if (decodedData['status'] == 1) {

                        $('#search_suggestion').show();
                        $('#search_suggestion').html(decodedData['html']);
                    } else {
                        $('#search_suggestion').hide();
                    }
                }
            });


        });
        $(document).on('click', '#search_button', function() {
            var keyword = $('#search_item').val();
            if (keyword.length >= 1) {
                $('#search_suggestion').html('<li class="list-group-item contsearch"><span>Loading...</span></li>');
                $('#search_suggestion').show();
                $.ajax({
                    url: "<?= base_url('search_results') ?>",
                    type: 'POST',
                    data: {
                        keyword: keyword
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#search_suggestion').hide();
                        var decodedData = jQuery.parseJSON(JSON.stringify(data));
                        if (decodedData['status'] == 1) {
                            $('#product_container').removeAttr('id');
                            $('.product_container').html(decodedData['html']);
                            $('#searchModal').modal('toggle');
                            $('html, body').animate({
                                scrollTop: $(".product_container").offset().top - 200
                            });
                        } else {

                        }
                    }
                });
            }

        });


        $(document).on('click', '.search_back_button', function() {
            $('#search_suggestion').empty();
            $('#search_item').val('');
            $('#searchModal').modal('toggle');

        });
        $(document).on('click', '.banner_search_item', function() {
            $('#searchModal').modal('toggle');
        });
        $(document).on('click', '.banner_search_button', function() {
            $('#searchModal').modal('toggle');

        });
        $(document).on('click', '.navbar-toggler', function(e) {
            $("nav").toggleClass("nav_color_white");
            $('.top_search_botton').toggle();
            e.stopImmediatePropagation();

            return false;
        });



    });


    /* 

    ============= carousel starts ===============

    */

    $(document).ready(function() {


        if ($('.bbb_viewed_slider').length) {
            var viewedSlider = $('.bbb_viewed_slider');

            viewedSlider.owlCarousel({
                loop: true,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 3000,
                nav: false,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    575: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    991: {
                        items: 3
                    },
                    1199: {
                        items: 3
                    },
                    1400: {
                        items: 4
                    }
                }
            });

            if ($('.bbb_viewed_prev').length) {
                var prev = $('.carousel_prev');
                prev.on('click', function() {
                    viewedSlider.trigger('prev.owl.carousel');
                });
            }

            if ($('.bbb_viewed_next').length) {
                var next = $('.carousel_next');
                next.on('click', function() {
                    viewedSlider.trigger('next.owl.carousel');
                });
            }
        }


    });

    /* 

============= carousel end ===============

*/
</script>