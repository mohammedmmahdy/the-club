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



@foreach (config('langs') as $locale => $name)

<code><h4>{{$name}}</h4></code>
<!-- Text Field -->
<div class="form-group show col-sm-12">
    {!! Form::label('text',$name . ' ' . __('models/faqs.fields.text').':') !!}
    <b>{!! $faq->translateOrNew($locale)->text !!}</b>
</div>

<div class="clearfix"></div>
<br>
<hr>
<br>
@endforeach
