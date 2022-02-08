<!-- Photo Field -->
<div class="form-group show">
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ $offer->photo_original_path }}" alt="{{ $offer->title }}" class="image-thumbnail" width="300">
</div>


<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/offers.fields.id').':') !!}
    <b>{{ $offer->id }}</b>
</div>


<!-- brief Field -->
<div class="form-group">
    {!! Form::label('brief', __('models/offers.fields.brief').':') !!}
    <b>{{ $offer->brief }}</b>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/offers.fields.description').':') !!}
    <b>{!! $offer->description !!}</b>
</div>




<!-- Discount Value Field -->
<div class="form-group">
    {!! Form::label('discount_value', __('models/offers.fields.discount_value').':') !!}
    <b>{{ $offer->discount_value }}</b>
</div>


<!-- Offer Category Id Field -->
<div class="form-group">
    {!! Form::label('offer_category_id', __('models/offers.fields.offer_category_id').':') !!}
    <b>{{ $offer->category->name ?? '' }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/offers.fields.created_at').':') !!}
    <b>{{ $offer->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/offers.fields.updated_at').':') !!}
    <b>{{ $offer->updated_at }}</b>
</div>


