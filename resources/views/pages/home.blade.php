@extends('app')
@section('title') Home :: @parent @stop
@section('content')

    <div class="page-header">
        <h3>Home Page
        @if(Auth::check())

            <div class="pull-right">
                <a href="{{{ URL::to('question/create') }}}"
                   class="btn btn-sm  btn-primary iframe"><span
                        class="glyphicon glyphicon-plus-sign"></span> {{
                    trans("admin/modal.new") }}</a>
            </div>

        @endif
        </h3>
    </div>

    @if(count($questions)>0)
        <div class="row">
            <h2>Best questions</h2>
            @foreach ($questions as $question)
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>
                                <strong><a href="{{URL::to('question/'.$question->id.'')}}">{!!
                                        $question->category->name !!}</a></strong>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <p>{!! $question->content !!}</p>

                            <p>
                                <a class="btn btn-mini btn-default"
                                   href="{{URL::to('question/'.$question->id.'')}}">Read more</a>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p></p>

                            <p>
                                <span class="glyphicon glyphicon-user"></span> by <span
                                        class="muted">{!! $question->author->name !!}</span> | <span
                                        class="glyphicon glyphicon-calendar"></span> {!! $question->created_at !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if(count($allQuestions)>0)
    <div id="allquestions" class="row">
        <h2>All questions</h2>
        <ul id="items">
        @foreach ($allQuestions as $question)
        <li class="item" style="list-style-type: none;">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        <h4>
                            <strong><a href="{{URL::to('question/'.$question->id.'')}}">{!!
                                    $question->category->name !!}</a></strong>
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <p>{!! $question->content !!}</p>

                        <p>
                            <a class="btn btn-mini btn-default"
                               href="{{URL::to('question/'.$question->id.'')}}">Read more</a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p></p>

                        <p>
                            <span class="glyphicon glyphicon-user"></span> by <span
                                class="muted">{!! $question->author->name !!}</span> | <span
                                class="glyphicon glyphicon-calendar"></span> {!! $question->created_at !!}
                        </p>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
        </ul>
        <div style="display:none">
            {!! $allQuestions->render() !!}
        </div>
    </div>
    @endif
</div>

@endsection

@section('scripts')
    @parent
<script>
    $(document).ready(function() {
        console.log( "ready!" );
        var loading_options = {
            finishedMsg: "<div class='end-msg'>Congratulations! You've reached the end of the internet</div>",
            msgText: "<div class='center'>Loading news items...</div>",
            img: "/assets/img/ajax-loader.gif"
        };

        $('#items').infinitescroll({
            loading : loading_options,
            navSelector : "#allquestions .pagination",
            nextSelector : "#allquestions .pagination li.active + li a",
            itemSelector : "#items li.item",
            dataType        : 'html',
            path: function(index) {
                return "?page=" + index;
            }
        });
    });
</script>
@endsection
@stop
