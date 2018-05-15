@extends('.admin.layouts.master')

@section('content')
    <section class="content-header">
        @include('layouts.errors')

        <h1>
            Edit Book
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

                    <form method="POST" action="/admin/{{ $book->id }}/updateBook">
                        {{ csrf_field() }}


                        <div class="form-group col-sm-8">
                            {!! Form::label('book_name', 'Book Name:') !!}
                            {!! Form::text('book_name', $book->book_name, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-8">
                            {!! Form::label('serial', 'Serial:') !!}
                            {!! Form::text('serial', $book->serial, ['class' => 'form-control']) !!}
                        </div>


                        <div class="form-group col-sm-8">
                            {!! Form::label('category', 'Category:') !!}
                            {!! Form::text('category', $book->category, ['class' => 'form-control']) !!}
                        </div>


                        <div class="form-group col-sm-8">
                            {!! Form::label('author_name', 'Author Name:') !!}
                            {!! Form::text('author_name', $book->author_name, ['class' => 'form-control']) !!}
                        </div>


                        <div class="form-group col-sm-8">

                            <strong>Publication Date:</strong>

                            <input class="form-control" type="date" name="publication_date"
                                   value="{{ \Carbon\Carbon::parse($book->publication_date)->format('Y-m-d')}}">
                        </div>


                        <div class="form-group col-sm-8">

                            <strong>Create Date:</strong>

                            <input disabled class="form-control" type="date" name="created_date"
                                   value="{{ \Carbon\Carbon::parse($book->created_date)->format('Y-m-d')}}">
                        </div>


                        <div class="form-group col-sm-8">

                            <strong>Update Date:</strong>

                            <input disabled class="form-control" type="date" name="updated_at"
                                   value="{{ \Carbon\Carbon::parse($book->updated_at)->format('Y-m-d')}}">
                        </div>


                        <div class="form-check col-sm-8">

                            @if($book->status == "available")

                                <input class="form-check-input" checked id="status" name="status" type="hidden" name="check[0]"
                                       value="unavailable"/>
                                <input class="form-check-input" checked id="status" name="status" type="checkbox" name="check[0]"
                                       value="available"/>
                                <label class="form-check-label" for="status">
                                    Available
                                </label>

                            @else

                                <input class="form-check-input" id="status" name="status" type="hidden" name="check[0]"
                                       value="unavailable"/>
                                <input class="form-check-input" id="status" name="status" type="checkbox" name="check[0]"
                                       value="available"/>
                                <label class="form-check-label" for="status">
                                    Available
                                </label>

                            @endif

                        </div>

                        <div class="form-group col-sm-8">
                            <button class='btn btn-primary btn-xs'>Save</button>
                            <a href="/admin/books" class='btn btn-default btn-xs'>Cancel</a>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection