@extends('.admin.layouts.master')

@section('content')




    <section class="content-header">
        <h1 class="pull-left">Books :</h1>

        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="/admin/create/book">Add
                New Book</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                <table class="table table-responsive" id="clients-table">
                    <thead>
                    <tr>
                        <th>Book</th>
                        <th>Serial</th>
                        <th>Category</th>
                        <th>Author Name</th>
                        <th>Status</th>
                        <th>Publication Date</th>
                        <th>Create_Date</th>
                        <th>Update_Date</th>
                        <th>Tools</th>

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

                            <td>{!! $book->created_at->diffForHumans() !!}</td>
                            <td>{!! $book->updated_at->diffForHumans() !!}</td>


                            <td>

                                <a href="/admin/{{$book->id}}/editBook" class='btn btn-default btn-xs'><i
                                            class="glyphicon glyphicon-edit"></i></a>


                                @if($book->status == 'available')

                                    <a href="/admin/{{$book->id}}/unavailableBook" class='btn btn-danger btn-xs'><i
                                                class="glyphicon glyphicon-remove"></i></a>


                                @elseif($book->status == 'unavailable')
                                    <a href="/admin/{{$book->id}}/availableBook" class='btn btn-success btn-xs'>Book Returned<i
                                                class="glyphicon glyphicon-ok"></i></a>

                                @endif

                                <a href="/admin/{{$book->id}}/destroyBook" class='btn btn-danger btn-xs' type="submit"
                                   name="Delete" value="Delete" onclick="return confirm('Are you sure?')"><i
                                            class="glyphicon glyphicon-trash"></i></a>


                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>


        <div class="text-center">

        </div>
    </div>



@endsection