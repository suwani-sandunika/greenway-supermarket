function signUp() {
    const firstName = document.getElementById("fname").value;
    const lastName = document.getElementById("lname").value;
    const mobile = document.getElementById("mobile").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("pass").value;
    const confirmPassword = document.getElementById("cpass").value;

    let data = {
        "fname": firstName,
        "lname": lastName,
        "mobile": mobile,
        "email": email,
        "pass": password,
        "cpass": confirmPassword
    };

    const form = new FormData();
    form.append("data", JSON.stringify(data));

    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4 && req.status === 200) {
            let result = JSON.parse(req.responseText);

            if (result['status'] === 1) {
                window.location = "index.php";
            } else {
                document.getElementById("sign-up-btn").classList.remove("active");
                document.getElementById("fNameErr").innerHTML = result['fNameErr'];
                document.getElementById("lNameErr").innerHTML = result['lNameErr'];
                document.getElementById("emailErr").innerHTML = result['emailErr'];
                document.getElementById("mobileErr").innerHTML = result['mobileErr'];
                document.getElementById("passErr").innerHTML = result['passErr'];
                document.getElementById("cPassErr").innerHTML = result['cPassErr'];
            }
        }
    }
    req.open('post', 'process/user-registration-process.php', true);
    req.send(form);
}

function signIn() {
    const email = document.getElementById("email").value;
    const pass = document.getElementById("pass").value;
    const remember = document.getElementById("remember").checked;

    const form = new FormData();
    form.append("email", email);
    form.append("pass", pass);
    form.append("remember", remember);

    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                window.location = "index.php";
            } else {
                document.getElementById("login-btn").classList.remove("active")
                document.getElementById("formErr").innerHTML = txt;
            }
        }
    };
    req.open('post', 'process/user-sign-in-process.php', true);
    req.send(form);
}

function forgotPassword() {
    const email = document.getElementById("email");

    const form = new FormData();
    form.append("email", email.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText == "Message has been sent") {
                window.location = "log-in.php";
            } else {
                document.getElementById("formErr").innerHTML = req.responseText;
            }
        }
    }
    req.open("post", "process/send-forgot-pwd-email-process.php", true);
    req.send(form);
}

function resetFpPassword(vcode) {
    const npass = document.getElementById("npass");
    const cpass = document.getElementById("cpass");

    const form = new FormData();
    form.append("npass", npass.value);
    form.append("cpass", cpass.value);
    form.append("vcode", vcode);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText === "success") {
                window.location = "log-in.php";
            } else {
                document.getElementById("formErr").innerHTML = req.responseText;
            }
        }
    }
    req.open("post", "process/reset-fp-pwd-process.php", true);
    req.send(form);
}

function setRating(no) {
    let stars = document.querySelectorAll(".rating-star");
    for (let i = 0; i < stars.length; i++) {
        if (i + 1 <= no) {
            stars[i].classList.add("theme-color");
            stars[i].classList.add("star-selected");
        } else {
            stars[i].classList.remove("theme-color");
            stars[i].classList.remove("star-selected");
        }
    }
}

function addNewReview(productId) {
    const name = document.getElementById("name");
    const email = document.getElementById("email");
    const comment = document.getElementById("comment");
    const ratings = document.querySelectorAll(".star-selected").length;
    const data = {
        "name": name.value, "email": email.value, "comment": comment.value, "ratings": ratings, "pId": productId
    };

    const form = new FormData();
    form.append("data", JSON.stringify(data));

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText === "success") {
                window.location.reload();
            } else {
                document.getElementById("rating-err").innerHTML = req.responseText;
            }
        }
    };
    req.open("post", 'process/add-new-review-process.php', true);
    req.send(form);
}

(function ($) {
    $(".addToWishlist").on("click", function () {
        const id = this.id;

        $.ajax({
            type: "get", url: "process/add-to-wishlist-process.php?pid=" + id, success: function (data) {
                if (data === "success") {

                    $.ajax({
                        type: "get", url: "process/load-header-wishlist-process.php", success: function (data) {
                            $("#header-wishlist-container").html(data);
                        }
                    })

                    $.notify({
                        icon: "fa fa-check", title: "Success!", message: "Item Successfully added in wishlist",
                    }, {
                        element: "body",
                        position: null,
                        type: "info",
                        allow_dismiss: true,
                        newest_on_top: false,
                        showProgressbar: true,
                        placement: {
                            from: "top", align: "right",
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 1031,
                        delay: 5000,
                        animate: {
                            enter: "animated fadeInDown", exit: "animated fadeOutUp",
                        },
                        icon_type: "class",
                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + '<span data-notify="title">{1}</span> ' + '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + '<a href="{3}" target="{4}" data-notify="url"></a>' + "</div>",
                    });
                } else if (data === "exists") {
                    $.notify({
                        icon: "fas fa-exclamation-triangle",
                        title: "Warning!",
                        message: "Item already in your wishlist",
                    }, {
                        element: "body",
                        position: null,
                        type: "warning",
                        allow_dismiss: true,
                        newest_on_top: false,
                        showProgressbar: true,
                        placement: {
                            from: "top", align: "right",
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 1031,
                        delay: 5000,
                        animate: {
                            enter: "animated fadeInDown", exit: "animated fadeOutUp",
                        },
                        icon_type: "class",
                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + '<span data-notify="title">{1}</span> ' + '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + '<a href="{3}" target="{4}" data-notify="url"></a>' + "</div>",
                    });
                } else if (data === "login") {
                    $.notify({
                        icon: "fas fa-exclamation-triangle", title: "Warning!", message: "Please login first",
                    }, {
                        element: "body",
                        position: null,
                        type: "danger   ",
                        allow_dismiss: true,
                        newest_on_top: false,
                        showProgressbar: true,
                        placement: {
                            from: "top", align: "right",
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 1031,
                        delay: 5000,
                        animate: {
                            enter: "animated fadeInDown", exit: "animated fadeOutUp",
                        },
                        icon_type: "class",
                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + '<span data-notify="title">{1}</span> ' + '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + '<a href="{3}" target="{4}" data-notify="url"></a>' + "</div>",
                    });
                }
            }
        })
    });

    $(".addToCart").on("click", function () {
        const id = this.id;

        $.ajax({
            type: "get", url: "process/add-to-cart-process.php?pid=" + id, success: function (data) {
                $.ajax({
                    type: "get", url: "process/load-header-cart-process.php", success: function (data) {
                        $("#header-cart-container").html(data);
                    }
                })

                $.notify({
                    icon: "fa fa-check", message: data,
                }, {
                    element: "body",
                    position: null,
                    type: "success",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top", align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 5000,
                    animate: {
                        enter: "animated fadeInDown", exit: "animated fadeOutUp",
                    },
                    icon_type: "class",
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                });
            }
        })

    });


})(jQuery);


function removeFromWishlist(wishlistId) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText === "success") {

                jQuery.notify({
                    icon: "fa fa-check", message: "Product removed from wishlist successfully",
                }, {
                    element: "body",
                    position: null,
                    type: "success",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top", align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 5000,
                    animate: {
                        enter: "animated fadeInDown", exit: "animated fadeOutUp",
                    },
                    icon_type: "class",
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                });

                setTimeout(() => {
                    window.location.reload();
                }, 5000)
            } else {
                jQuery.notify({
                    icon: "fa fa-check", message: req.responseText,
                }, {
                    element: "body",
                    position: null,
                    type: "danger",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top", align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 5000,
                    animate: {
                        enter: "animated fadeInDown", exit: "animated fadeOutUp",
                    },
                    icon_type: "class",
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                });
            }

        }
    }
    req.open('get', 'process/remove-from-wishlist-process.php?wid=' + wishlistId, true);
    req.send();
}

// function resetUserPassword() {
//     const currentPwd = document.getElementById("currentpwd");
//     const newPwd = document.getElementById("newpwd");
//     const confirmPwd = document.getElementById("confirmpwd");
//
//     const data = {
//         "current": currentPwd.value, "new": newPwd.value, "confirm": confirmPwd.value
//     }
//
//     const form = new FormData();
//     form.append("data", JSON.stringify(data));
//
//     const req = new XMLHttpRequest();
//     req.onreadystatechange = () => {
//         if (req.readyState === 4 && req.status === 200) {
//             if (req.responseText === "success") {
//                 jQuery.notify({
//                     icon: "fa fa-check", message: "User password reset successful",
//                 }, {
//                     element: "body",
//                     position: null,
//                     type: "success",
//                     allow_dismiss: true,
//                     newest_on_top: false,
//                     showProgressbar: true,
//                     placement: {
//                         from: "top", align: "right",
//                     },
//                     offset: 20,
//                     spacing: 10,
//                     z_index: 1031,
//                     delay: 3000,
//                     animate: {
//                         enter: "animated fadeInDown", exit: "animated fadeOutUp",
//                     },
//                     icon_type: "class",
//                     template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
//                         '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
//                 });
//                 setTimeout(() => {
//                     window.location.reload();
//                 }, 3100)
//             } else {
//                 // document.querySelector("#formerr").innerHTML = req.responseText;
//                 jQuery.notify({
//                     icon: "fa fa-check", message: req.responseText,
//                 }, {
//                     element: "body",
//                     position: null,
//                     type: "danger",
//                     allow_dismiss: true,
//                     newest_on_top: false,
//                     showProgressbar: true,
//                     placement: {
//                         from: "top", align: "right",
//                     },
//                     offset: 20,
//                     spacing: 10,
//                     z_index: 1031,
//                     delay: 1500,
//                     animate: {
//                         enter: "animated fadeInDown", exit: "animated fadeOutUp",
//                     },
//                     icon_type: "class",
//                     template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
//                         '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
//                 });
//             }
//             console.log(req.responseText);
//         }
//     }
//     req.open('post', 'process/reset-user-pwd-process.php', true);
//     req.send(form);
// }

function updateUserProfile() {
    const fname = document.getElementById("u-fname");
    const lname = document.getElementById("u-lname");
    const mobile = document.getElementById("u-mobile");
    const email = document.getElementById("u-email");

    const data = {
        "fname": fname.value, "lname": lname.value, "mobile": mobile.value, "email": email.value
    };

    const form = new FormData();
    form.append("data", JSON.stringify(data));

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText === "success") {
                jQuery.notify({
                    icon: "fa fa-check", message: "User profile updated successfully!",
                }, {
                    element: "body",
                    position: null,
                    type: "success",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top", align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 3000,
                    animate: {
                        enter: "animated fadeInDown", exit: "animated fadeOutUp",
                    },
                    icon_type: "class",
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                });
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                document.getElementById("u-formerr").innerHTML = req.responseText;
            }
        }
    }
    req.open('post', 'process/update-user-process.php', true);
    req.send(form);
}

function incrementProductQty(pid) {
    const qty = document.getElementById("prodQty");

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let data = JSON.parse(req.responseText);
            document.getElementById("prodQty").value = data.qty;
            if (data.error) {
                jQuery.notify({
                    icon: "fa fa-check", message: data.error,
                }, {
                    element: "body",
                    position: null,
                    type: "danger",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top", align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 1000,
                    animate: {
                        enter: "animated fadeInDown", exit: "animated fadeOutUp",
                    },
                    icon_type: "class",
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                });
            }
        }
    }
    req.open("get", "process/increment-product-qty-process.php?pid=" + pid + "&qty=" + qty.value, true);
    req.send();
}

function decrementProductQty(pid) {
    const qty = document.getElementById("prodQty");

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let data = JSON.parse(req.responseText);
            document.getElementById("prodQty").value = data.qty;
            if (data.error) {
                jQuery.notify({
                    icon: "fa fa-check", message: data.error,
                }, {
                    element: "body",
                    position: null,
                    type: "danger",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top", align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 1000,
                    animate: {
                        enter: "animated fadeInDown", exit: "animated fadeOutUp",
                    },
                    icon_type: "class",
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                });
            }
        }
    }
    req.open("get", "process/decrement-product-qty-process.php?pid=" + pid + "&qty=" + qty.value, true);
    req.send();
}

function changeProductQty(pid) {
    const qty = document.getElementById("prodQty").value;

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let data = JSON.parse(req.responseText);
            document.getElementById("prodQty").value = data.qty;
            if (data.error) {
                jQuery.notify({
                    icon: "fa fa-check", message: data.error,
                }, {
                    element: "body",
                    position: null,
                    type: "danger",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top", align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 2000,
                    animate: {
                        enter: "animated fadeInDown", exit: "animated fadeOutUp",
                    },
                    icon_type: "class",
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                });
            }
        }
    }
    req.open("get", "process/change-product-qty-process.php?pid=" + pid + "&qty=" + qty, true);
    req.send();
}

function addToCart(pid) {
    const qty = document.getElementById("prodQty").value;

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            jQuery.notify({
                icon: "fa fa-check", message: req.responseText,
            }, {
                element: "body",
                position: null,
                type: "primary",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: true,
                placement: {
                    from: "top", align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 2000,
                animate: {
                    enter: "animated fadeInDown", exit: "animated fadeOutUp",
                },
                icon_type: "class",
                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
            });

            const req2 = new XMLHttpRequest();
            req2.onreadystatechange = () => {
                if (req2.readyState === 4 && req2.status === 200) {
                    document.getElementById("header-cart-container").innerHTML = req2.responseText;
                }
            }
            req2.open("get", "process/load-header-cart-process.php", true)
            req2.send();

            document.getElementById("prodQty").value = 1;
        }
    };
    req.open("get", "process/add-to-cart-process.php?pid=" + pid + "&qty=" + qty, true);
    req.send();
}

function updateCartProductQty(pid) {
    const qty = document.getElementById("productQty" + pid);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let data = JSON.parse(req.responseText);
            document.getElementById("productQty" + pid).value = data.qty;
            if (data.error) {
                jQuery.notify({
                    icon: "fa fa-check", message: data.error,
                }, {
                    element: "body",
                    position: null,
                    type: "danger",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top", align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 1000,
                    animate: {
                        enter: "animated fadeInDown", exit: "animated fadeOutUp",
                    },
                    icon_type: "class",
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                });
            }

            setTimeout(() => {
                window.location.reload();
            }, 1500)
        }
    }
    req.open("get", "process/update-cart-product-qty-process.php?pid=" + pid + "&qty=" + qty.value, true);
    req.send();
}

function deleteItemFromCart(pid) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText === "success") {
                window.location.reload();
            } else {
                jQuery.notify({
                    icon: "fa fa-check", message: req.responseText,
                }, {
                    element: "body",
                    position: null,
                    type: "danger",
                    allow_dismiss: true,
                    newest_on_top: false,
                    showProgressbar: true,
                    placement: {
                        from: "top", align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1031,
                    delay: 2000,
                    animate: {
                        enter: "animated fadeInDown", exit: "animated fadeOutUp",
                    },
                    icon_type: "class",
                    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                        '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                });
            }
        }
    }

    req.open("get", "process/delete-item-from-cart-process.php?pid=" + pid, true)
    req.send();
}

function clearCart() {
    let c = confirm("Are you sure you want to clear your cart?");
    if (c) {
        const req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                if (req.responseText === "success") {
                    jQuery.notify({
                        icon: "fa fa-check", message: "Removing products from the cart",
                    }, {
                        element: "body",
                        position: null,
                        type: "success",
                        allow_dismiss: true,
                        newest_on_top: false,
                        showProgressbar: true,
                        placement: {
                            from: "top", align: "right",
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 1031,
                        delay: 2000,
                        animate: {
                            enter: "animated fadeInDown", exit: "animated fadeOutUp",
                        },
                        icon_type: "class",
                        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' + '<span data-notify="icon"></span> ' + // '<span data-notify="title">{1}</span> ' +
                            '<span data-notify="message">{2}</span>' + '<div class="progress" data-notify="progressbar">' + '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' + "</div>" + "</div>",
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000)
                }
            }
        }
        req.open("get", "process/clear-cart-process.php", true);
        req.send();
    }
}

function updateAddress() {
    const line1 = document.getElementById("line1");
    const line2 = document.getElementById("line2");
    const city = document.getElementById("city");

    const data = {
        "line1": line1.value, "line2": line2.value, "city": city.value
    }

    const form = new FormData();
    form.append("data", JSON.stringify(data));

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText === "success") {
                window.location.reload();
            } else {
                document.getElementById("u-formerr").innerHTML = req.responseText;
            }
        }
    }
    req.open("post", "process/update-user-address.php", true);
    req.send(form);
}

function filterProducts(page, search) {
    let brandIds = [];
    document.querySelectorAll(".brandInput").forEach(brand => {
        if (brand.checked) {
            brandIds.push(brand.value);
        }
    });

    let categoryIds = [];
    document.querySelectorAll(".categoryInput").forEach(category => {
        if (category.checked) {
            categoryIds.push(category.value);
        }
    });

    let price = document.getElementById("priceSlider").value.split(";")

    const data = {
        "brands": brandIds, "categories": categoryIds, "price": price, "page": page, "search": search
    }

    const form = new FormData();
    form.append("data", JSON.stringify(data));

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState == 4 && req.status == 200) {
            document.getElementById("productsSection").innerHTML = req.responseText;
        }
    }
    req.open("post", "process/filter-products-process.php", true);
    req.send(form);
}

function deleteUserAccount() {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText === "success") {
                window.location = "index.php";
            } else {
                alert(req.responseText);
            }
        }
    }
    req.open('get', 'process/delete-user-account-process.php', true);
    req.send();
}

function loadInvoiceProducts(invoiceId) {
    const formData = new FormData();
    formData.append("invoiceId", invoiceId);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById("invoiceProducts").innerHTML = req.responseText;
            // bootstrap.Modal.getInstance(document.getElementById("invoiceProductsModal")).show();
            new bootstrap.Modal(document.getElementById("invoiceProductsModal")).show();
        }
    }
    req.open('post', 'process/load-invoice-products-process.php', true);
    req.send(formData);
}

