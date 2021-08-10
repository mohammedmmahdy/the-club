<!-- Page Id Field -->
<div class="form-group show">
    {!! Form::label('page_id', __('models/paragraphs.fields.page_id').':') !!}
    <p>{{ $paragraph->page->name }}</p>
</div>
<div class="clearfix"></div>
<br>
<hr>
<br>
@foreach (config('langs') as $locale => $name)

<code><h4>{{$name}}</h4></code>
<!-- Text Field -->
<div class="form-group show col-sm-12">
    {!! Form::label('text',$name . ' ' . __('models/paragraphs.fields.text').':') !!}
    <p>{!! $paragraph->translateOrNew($locale)->text !!}</p>
</div>

<div class="clearfix"></div>
<br>
<hr>
<br>
@endforeach
