@extends('admin.layouts.modal') {{-- Content --}} @section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->
{{-- Edit Blog Form --}}
<form class="form-horizontal" enctype="multipart/form-data"
	method="post"
	action="{{ URL::to('admin/question/'.$question->id.'/edit') }}"
	autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<!-- ./ csrf token -->
	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<div class="tab-pane active" id="tab-general">
				<div
					class="form-group {{{ $errors->has('question_category_id') ? 'error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="question_category_id">{{
							trans("admin/question.category") }}</label> <select
							style="width: 100%" name="question_category_id" id="question_category_id"
							class="form-control"> @foreach($questioncategories as $item)
							<option value="{{$item->id}}"
								@if(!empty($questioncategory))
                                        @if($item->id==$questioncategory)
								selected="selected" @endif @endif >{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div
					class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
					<div class="col-md-12">
						<label class="control-label" for="content">{{
							trans("admin/question.content") }}</label>
						<textarea class="form-control full-width wysihtml5" name="content"
							value="content" rows="10">{{{ Input::old('content', isset($question) ? $question->content : null) }}}</textarea>
						{!! $errors->first('content', '<label class="control-label">:message</label>')
						!!}
					</div>
				</div>

                <input type="hidden" name="is_displayed" value="0" />

                @if	($question->is_displayed)
                    <input id="is_displayed" name="is_displayed" type="checkbox" checked="checked" value="1"/>
                @else
                    <input id="is_displayed" name="is_displayed" type="checkbox" value="1"/>
                @endif

                <label for="is_displayed">{{trans("admin/question.is_displayed") }}</label>

				<!-- ./ general tab -->
			</div>
			<!-- ./ tabs content -->

			<!-- Form Actions -->

			<div class="form-group">
				<div class="col-md-12">
					<button type="reset" class="btn btn-sm btn-warning close_popup">
						<span class="glyphicon glyphicon-ban-circle"></span> {{
						trans("admin/modal.cancel") }}
					</button>
					<button type="reset" class="btn btn-sm btn-default">
						<span class="glyphicon glyphicon-remove-circle"></span> {{
						trans("admin/modal.reset") }}
					</button>
					<button type="submit" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-ok-circle"></span>
						  {{ trans("admin/modal.edit") }}
					</button>
				</div>
			</div>
			<!-- ./ form actions -->

</form>
@stop
