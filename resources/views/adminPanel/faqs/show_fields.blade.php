<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/faqs.fields.id').':') !!}
    <b>{{ $faq->id }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/faqs.fields.created_at').':') !!}
    <b>{{ $faq->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/faqs.fields.updated_at').':') !!}
    <b>{{ $faq->updated_at }}</b>
</div>

<div class="clearfix"></div>
<br>
<hr>
<br>

@foreach (config('langs') as $locale => $name)

<code><h4>{{$name}}</h4></code>
<!-- question Field -->
<div class="form-group show col-sm-12">
    {!! Form::label('question',$name . ' ' . __('models/faqs.fields.question').':') !!}
    <b>{!! $faq->translateOrNew($locale)->question !!}</b>
</div>
<!-- answer Field -->
<div class="form-group show col-sm-12">
    {!! Form::label('answer',$name . ' ' . __('models/faqs.fields.answer').':') !!}
    <b>{!! $faq->translateOrNew($locale)->answer !!}</b>
</div>

<div class="clearfix"></div>
<br>
<hr>
<br>
@endforeach
