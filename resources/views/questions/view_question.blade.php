@extends('app') {{-- Web site Title --}}

{{-- Content --}} @section('content')
<div>
    Question:
    <p>{!! $question->content !!}</p>

    @if	($question->answer)
        Answer:
    {!! $question->answer->content !!}
    @endif

</div>
@stop


