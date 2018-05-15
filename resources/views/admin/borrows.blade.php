@extends('.admin.layouts.master')

@section('content')




    <section class="content-header">
        <h1 class="pull-left">Borrows : </h1>

        <h1 class="pull-right">
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
                        <th>User</th>
                        <th>Book</th>
                        <th>Borrowed</th>
                        <th>Expires</th>
                        <th>Create_Date</th>
                        <th>Update_Date</th>
                        <th>Tools</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($borrows as $borrow)
                        <tr>

                            <td>
                                @if(isset($borrow->user->name))

                                    <span style="color:#33cc33">{{ $borrow->user->name }} </span>

                                @else

                                    <span style="color:#ff0000">Unknown User</span>

                                @endif

                            </td>

                            <td>
                                @if(isset($borrow->book->book_name))
                                    {!! $borrow->book->book_name !!}
                                @else
                                    <span style="color:#ff0000">Unknown </span>
                                @endif
                            </td>
                            <td>
                                @if(isset($borrow->borrow_at))
                                    {!! $borrow->borrow_at->diffForHumans() !!}
                                @else
                                    <span style="color:#ff0000">Unknown </span>
                                @endif
                            </td>

                            <td>

                                @if(isset($borrow->expires_at))
                                    {!! $borrow->expires_at->diffForHumans() !!}
                                @else
                                    <span style="color:#ff0000">Unknown </span>
                                @endif

                            </td>

                            <td>{!! $borrow->created_at->diffForHumans() !!}</td>
                            <td>{!! $borrow->updated_at->diffForHumans() !!}</td>


                            <td>
                                {{--<a href="/admin/{{$comment->id}}/editcomment" class='btn btn-default btn-xs'><i--}}
                                            {{--class="glyphicon glyphicon-edit"></i></a>--}}

                                @if(isset($comment->post_id))
                                    <a href="/admin/{{$comment->post_id}}/showcomments"
                                       class='btn btn-default btn-xs'><i
                                                class="glyphicon glyphicon-eye-open"></i></a>
                                @endif


                                <a href="/admin/{{$borrow->id}}/destroyBorrow" class='btn btn-success btn-xs'
                                   type="submit"
                                   name="Delete" value="Delete" onclick="return confirm('Are you sure?')">Book Returned <i
                                            class="glyphicon glyphicon-ok"></i></a>


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