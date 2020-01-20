function getCart() {

    $.ajax({
        url: "cart-catalog-price",
        type: "GET",
        success: function (result) {
            $(".cart > .catalog-div >.catalog-price").html(result);
        }
    });

    $.ajax({
        url: "cart-special-price",
        type: "GET",
        success: function (result) {
            $(".cart > .special-div > .special-price").html(result);
        }
    });

    $.ajax({
        url: "cart-content",
        type: "GET",
        dataType: "json",
        success: function (result) {

            $(".cart-list > .item").html("");

            if ($.isArray(result)) {

                $.each(result, function (index, value) {

                    var row = $("<div />").addClass("row item").attr("id", "book_" + value.id);

                    var column = $("<div />").addClass("col");

                    var columnAuthors = column.clone();
                    var authorNames = [];
                    $.each(value.authors, function (i, v) {
                        authorNames.push(v);
                    });
                    columnAuthors.html(authorNames.join(", "));
                    row.append(columnAuthors);


                    var columnTitle = column.clone();
                    columnTitle.html(value.title);
                    row.append(columnTitle);


                    var columnLinks = column.clone();
                    columnLinks.append($("<a>", {
                            text: 'Remove from cart',
                            href: "#",
                            click: function () {
                                $.ajax({
                                    url: "removeFromCart",
                                    type: "POST",
                                    data: {
                                        "bookId": value.id
                                    },
                                    success: function (msg) {
                                        $(".msg").html(msg.msg);
                                        $("#book_" + value.id).remove();
                                        getCart();
                                    }
                                })
                            }
                        })
                    );
                    columnLinks.append($("<br />"));

                    row.append(columnLinks);


                    $(".cart-list").append(row);
                });
            }
        }
    });
};

$(document).ready(function () {

    getCart();

    $(".cart > .empty").click(function () {
        $.ajax({
            url: "emptyCart",
            type: "POST",
            success: function (msg) {
                $(".msg").html(msg.msg);
                getCart();
            }
        })
    });
})
