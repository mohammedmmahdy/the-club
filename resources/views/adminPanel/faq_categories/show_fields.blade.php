<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/faqCategories.fields.id').':') !!}
    <b>{{ $faqCategory->id }}</b>
</div>


@foreach (config('langs') as $locale => $name)

<code><h4>{{$name}}</h4></code>
<!-- name Field -->
<div class="form-group show col-sm-12">
    {!! Form::label('name',$name . ' ' . __('models/faqCategories.fields.name').':') !!}
    <b>{!! $faqCategory->translateOrNew($locale)->name !!}</b>
</div>

<div class="clearfix"></div>
<br>
<hr>
<br>
@endforeach
