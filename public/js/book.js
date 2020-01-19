$(document).ready(function () {

    $.ajax({
        url: "books/offset/0/limit/6/column/title/asc/true",
        type: "GET",
        dataType: "json",
        success: function (result) {

            if ($.isArray(result)) {

                $.each(result, function (index, value) {

                    var row = $("<div />").addClass("row");

                    var column = $("<div />").addClass("col");

                    var columnPublisherName = column.clone();
                    columnPublisherName.html(value.publisher);
                    row.append(columnPublisherName);


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


                    var columnCatalogPrice = column.clone();
                    columnCatalogPrice.html(Math.floor(value.catalogPrice));
                    row.append(columnCatalogPrice);

                    var columnSpecialPrice = column.clone();
                    if (value.specialPrice < value.catalogPrice) {

                        columnSpecialPrice.html(value.specialPrice);
                    }
                    row.append(columnSpecialPrice);


                    var columnLinks = column.clone();
                    columnLinks.append($("<a>", {
                            text: 'Add to the cart',
                            href: "#",
                            click: function () {
                                $.ajax({
                                    url: "addCart",
                                    type: "POST",
                                    data: {
                                        "bookId": value.id
                                    },
                                    success: function (msg) {
                                        $(".msg").html(msg.msg);
                                        getCart();
                                    }
                                })
                            }
                        })
                    );
                    columnLinks.append($("<br />"));

                    row.append(columnLinks);


                    $("#table").append(row);
                });
            }
        }
    })
})
