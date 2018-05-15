@extends('.admin.layouts.master')

@section('content')
    <section class="content-header">
        @include('layouts.errors')

        <h1>
            Add New Book
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

                    <form method="POST" action="/admin/store/book">
                        {{ csrf_field() }}

                        <div class="form-row">

                            <div class="form-group col-md-8">
                                <label for="book_name">Name</label>
                                <input type="text" class="form-control" name="book_name" id="book_name"
                                       placeholder="Book Name">
                            </div>

                            <div class="form-group col-md-8">
                                <label for="serial">Serial</label>
                                <input type="text" class="form-control" name="serial" id="serial" placeholder="Serial">
                            </div>

                            <div class="form-group col-md-8">
                                <label for="category">Category</label>
                                <input type="text" class="form-control" name="category" id="category"
                                       placeholder="Category">
                            </div>

                            <div class="form-group col-md-8">
                                <label for="author_name">Author Name</label>
                                <input type="text" class="form-control" name="author_name" id="author_name"
                                       placeholder="Author Name">
                            </div>

                            <div class="form-group col-md-8">
                                <label for="publication_date">Publication Date</label>
                                <input type="date" class="form-control" name="publication_date" id="publication_date"
                                       placeholder="publication_date">
                            </div>


                        </div>


                        <div class="form-check col-sm-8">

                            <input class="form-check-input" id="status" name="status" type="hidden" name="check[0]"
                                   value="unavailable"/>
                            <input class="form-check-input" id="status" name="status" type="checkbox" name="check[0]"
                                   value="available"/>
                            <label class="form-check-label" for="status">
                                Available
                            </label>

                        </div>

                        <div class="form-group col-sm-8">
                            <button class='btn btn-primary btn-xs'>Save</button>
                            <a href="/admin/books" class='btn btn-default btn-xs'>Cancel</a>
                        </div>
                        {{--</div>--}}
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection