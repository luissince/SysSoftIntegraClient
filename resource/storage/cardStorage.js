function CardStorage() {

    $("#txtSearch").keypress(function (event) {
        if (event.keyCode == 13) {
            if ($("#txtSearch").val().trim().length != 0) {
                window.location.href = "./catalogo.php?search=" + $("#txtSearch").val().trim();
            }
            event.preventDefault();
        }
    });

    $("#btnSearch").click(function () {
        if ($("#txtSearch").val().trim().length != 0) {
            window.location.href = "./catalogo.php?search=" + $("#txtSearch").val().trim();
        }
    });

    $("#btnSearch").keypress(function (event) {
        if (event.which == 13) {
            if ($("#txtSearch").val().trim().length != 0) {
                window.location.href = "./catalogo.php?search=" + $("#txtSearch").val().trim();
            }
            event.preventDefault();
        }
    });

    $(document).on("click", function (event) {
        let list = $(".cart-content");
        if ($("#btnCartAction").parent().children().hasClass("cart-active")) {
            if (!list.is(event.target) && list.has(event.target).length === 0) {
                $("#btnCartAction").parent().children().removeClass("cart-active");
                event.stopPropagation();
            }
        }
    });

    $("#btnCartAction").click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        if ($("#btnCartAction").parent().children().hasClass("cart-active")) {
            $("#btnCartAction").parent().children().removeClass("cart-active");
        } else {
            $("#btnCartAction").parent().children().addClass("cart-active");
        }
    });

    tools.keyEnter($("#btnCartAction"), function (event) {
        event.preventDefault();
        event.stopPropagation();
        if ($("#btnCartAction").parent().children().hasClass("cart-active")) {
            $("#btnCartAction").parent().children().removeClass("cart-active");
        } else {
            $("#btnCartAction").parent().children().addClass("cart-active");
        }
    });

    $("#btnDetalleCart").click(function () {
        window.open("./detalle.php", "_self");
    });

    tools.keyEnter($("#btnDetalleCart"), function (event) {
        window.open("./detalle.php", "_self");
    });

    $("#btnFinalizarCart").click(function () {
        window.open("./pago.php", "_self");
    });

    tools.keyEnter($("#btnFinalizarCart"), function (event) {
        window.open("./pago.php", "_self");
    });

    this.add = function (item) {
        let carrito = getCarrito();
        if (validateDuplicate(carrito, item.idSuministro)) {
            for (let value of carrito) {
                if (value.idSuministro == item.idSuministro) {
                    let suministro = value;
                    suministro.cantidad = parseInt(suministro.cantidad) + item.cantidad;
                    localStorage.setItem("carrito", JSON.stringify(carrito));
                    break;
                }
            }
        } else {
            carrito.push(item);
            localStorage.setItem("carrito", JSON.stringify(carrito));
        }
    }

    this.getList = function () {
        return getCarrito();
    }

    this.empty = function () {
        localStorage.removeItem('carrito');
    }

    this.renderCard = function () {
        render();
    }

    function render() {
        let carrito = getCarrito();
        let importe = 0;
        $("#card-add").empty();
        for (let value of carrito) {
            importe += value.cantidad * value.precio;
            $("#card-add").append(`
            <li class="cart-list">
                <div class="cart-image">
                    <img src="${value.image}">
                </div>
                <div class="cart-detail">
                    <p class="mb-1">
                    ${tools.limitar_cadena(value.nombre, 35, '...')}
                    </p>
                    <div class="cart-total">
                        <strong>${value.cantidad} x ${tools.formatMoney(value.precio)}</strong>
                        <span>
                            S/ ${tools.formatMoney(value.cantidad * value.precio)}
                        </span>
                    </div>
                    <button onClick="removeCard('${value.idSuministro}')" class="button-red"><i class="fa fa-trash"></i></button>
                </div>
            </li>`);
        }

        $("#cart-total").html("S/ " + tools.formatMoney(importe));
        $("#count-cart").html(carrito.length);
    }

    removeCard = function (idSuministro) {
        event.preventDefault();
        event.stopPropagation();
        let carrito = getCarrito();
        for (let i = 0; i < carrito.length; i++) {
            if (carrito[i].idSuministro == idSuministro) {
                carrito.splice(i, 1);
                i--;
                localStorage.setItem("carrito", JSON.stringify(carrito));
                break;
            }
        }
        render();
    }

    function getCarrito() {
        return localStorage.getItem("carrito") == null ? [] : JSON.parse(localStorage.getItem("carrito"));
    }

    function validateDuplicate(list, idSuministro) {
        let ret = false;
        for (let i = 0; i < list.length; i++) {
            if (list[i].idSuministro == idSuministro) {
                ret = true;
                break;
            }
        }
        return ret;
    }

}