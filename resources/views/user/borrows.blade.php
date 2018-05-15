@extends('.user.layouts.master')

@section('content')




<section class="content-header">
    <h1 class="pull-left">My Borrows : </h1>
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
                        <th width="25%">Book</th>
                        <th width="25%">Borrowed</th>
                        <th width="25%">Expires</th>
                        <th width="25%">Tools</th>


                    </tr>
                </thead>
                <tbody>

                    @foreach($borrows as $borrow)
                    <tr>
                        {{--{{dd($borrows)}}--}}


                        <td>
                            @if(isset($borrow->book->book_name))

                            <span style="color:#33cc33">{{ $borrow->book->book_name }} </span>

                            @else

                            <span style="color:#ff0000">Unknown Book</span>

                            @endif
                            {{-- {!! $comment->user->name !!} --}}


                        </td>

                        {{--<td>--}}
                            {{--@if(isset($comment->post->title))--}}
                            {{--{!! $comment->post->title !!}--}}
                            {{--@else--}}
                            {{--<span style="color:#ff0000">Unknown </span>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--@if(isset($comment->body))--}}
                            {{--{!! $comment->body !!}--}}
                            {{--@else--}}
                            {{--<td><span style="color:#ff0000">Unknown </span>--}}
                                {{--@endif--}}
                            {{--</td>--}}


                            {{--<td>--}}

                                {{--@if($comment->status == 'waiting')--}}
                                {{--<span style="color:orange"> Waiting </span>--}}
                                {{--@elseif($comment->status == 'U-updated')--}}
                                {{--<span style="color:#50c1ff"> Comment Updated And Waiting Admin Approving </span>--}}
                                {{--@elseif($comment->status == 'A-activated')--}}
                                {{--<span style="color:#33cc33"> Activated </span>--}}
                                {{--@elseif($comment->status == 'U-activated')--}}
                                {{--<span style="color:#33cc33"> Activated </span>--}}
                                {{--@elseif($comment->status == 'U-deactivated')--}}
                                {{--<span style="color:#ff0000"> Deactivated </span>--}}
                                {{--@endif--}}

                            {{--</td>--}}
                            <td>{!! $borrow->borrow_at->diffForHumans() !!}</td>
                            <td>
                                @if(date("Y-m-d H:i:s") >= $borrow->expires_at)
                                <span style="color: red"> You Are Late <i
                                    class="glyphicon glyphicon-time"></i></span>

                                    {{--<span class="label label-danger btn-xl"> You Are Late <i--}}
                                        {{--class="glyphicon glyphicon-time"></i></span>--}}
                                        @else
                                        <span style="color: green">{!! $borrow->expires_at->diffForHumans() !!}</span>
                                    </td>

                                    @endif


                                    <td>

                                        @if(date("Y-m-d H:i:s") <= $borrow->expires_at)

                                        <button disabled class='btn btn-default btn-xs'>Add One More Week <i
                                            class="glyphicon glyphicon-plus"></i></button>

                                            @else
                                            <a href="/user/{{ Auth::user()->id }}/{{$borrow->id}}/addTime"
                                             class='btn btn-success btn-xs'>Add One More Week <i
                                             class="glyphicon glyphicon-plus"></i></a>


                                             @endif


                                             <a href="/user/{{ Auth::user()->id }}/{{$borrow->id}}/returnBook"
                                                 class='btn btn-primary btn-xs'>Return Book  <i
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