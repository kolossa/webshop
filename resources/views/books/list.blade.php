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
            <div class="col"></div>
        </div>
    </div>


    <script src="{{ 'js/book.js' }}"></script>

@endsection

@section('sidebar')
    @include("cart")
@endsection
