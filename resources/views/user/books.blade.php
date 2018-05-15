@extends('.user.layouts.master')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Books :</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        {{--<div class="clearfix"></div>--}}
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">

                <table class="table table-responsive" id="clients-table">
                    <thead>
                    <tr>

                        <th>Book</th>
                        <th>Serial</th>
                        <th width="10%">Category</th>
                        <th>Author Name</th>
                        <th width="10%">Status</th>
                        <th width="12%">Publication Date</th>
                        <th width="10%">Tools</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($book as $book)
                        <tr>


                            <td>


                                @if(isset($book->book_name))

                                    <span style="color:#33cc33">{{ $book->book_name }} </span>

                                @else

                                    <span style="color:#ff0000">Unknown </span>

                                @endif


                            </td>
                            <td>{!! $book->serial !!}</td>
                            <td>{!! $book->category !!}</td>
                            <td>{!! $book->author_name !!}</td>

                            <td>

                                @if($book->status == 'available')
                                    <span style="color:#33cc33"> Available </span>
                                @elseif($book->status == 'unavailable')
                                    <span style="color:#ff0000"> Unavailable </span>
                            @endif

                            <td>{!! \Carbon\Carbon::parse($book->publication_date)->format('d-m-Y') !!}</td>


                            </td>


                            <td>


                                {{--<a href="/user/{{ Auth::user()->id }}/{{$book->id}}/showpost" class='btn btn-default btn-xs'><i--}}
                                {{--class="glyphicon glyphicon-eye-open"></i></a>--}}


                                @if($book->status == 'unavailable')
                                    <button disabled class='btn btn-default btn-xs'><i
                                                class="glyphicon glyphicon-shopping-cart"></i></button>
                                @elseif($book->status == 'available')
                                    @if(Auth::user())
                                        <a href="/user/{{ Auth::user()->id }}/{{$book->id}}/borrowBook"
                                           class='btn btn-success btn-xs'>Borrow Book <i
                                                    class="glyphicon glyphicon-shopping-cart"></i></a>
                                    @else
                                        <button title="You Need To Login First" disabled href="#" class='btn btn-success btn-xs'>Borrow Book <i
                                                    class="glyphicon glyphicon-shopping-cart"></i></button>
                                    @endif

                                @endif

                                @include('layouts.errors')

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>


        <div class="text-center">

        </div>
    </div>



@endsection