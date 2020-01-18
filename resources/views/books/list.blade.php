@extends('layouts.app')

@section('content')
    <h2>Book list</h2>

    <div id="table">
        <div class="row">
            <div class="col">
                Publisher
            </div>
            <div class="col">
                Author(s)
            </div>
            <div class="col">
                Title
            </div>
            <div class="col">
                Catalog Price
            </div>
            <div class="col">
                Special Price
            </div>
        </div>
    </div>

    <script>
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
                            var authorNames = new Array();
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


                            $("#table").append(row);
                            console.log(value);
                        });
                    }
                }
            })
        })
    </script>

@endsection
