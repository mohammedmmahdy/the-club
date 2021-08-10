<!-- Name Field -->
@if (isset($socialLink))

<div class="form-group col-sm-6">
    {!! Form::label('name', $socialLink->name .':') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>

@else

{{-- <div class="form-group col-sm-6">
        {!! Form::label('name', __('models/socialLinks.fields.name').':') !!}
        {!! Form::select('name', config('optionsSelect.social'), null, ['class' => 'form-control']) !!}
    </div> --}}

{{-- <div class="form-group col-sm-6">
        {!! Form::label('icon', 'Icon') !!}
        <button name="icon" class="btn btn-secondary ml-2 px-4" data-icon="fab fa-jsfiddle" role="iconpicker"></button>
    </div> --}}


<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/socialLinks.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', __('models/socialLinks.fields.link').':') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>

@endif

<br>
<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', __('models/socialLinks.fields.status').':') !!}
    <label class="radio-inline">
        {!! Form::radio('status', '1', 'active') !!} @lang('lang.active')
    </label>

    <label class="radio-inline">
        {!! Form::radio('status', '0', null) !!} @lang('lang.inactive')
    </label>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
    <a href="{{ route('adminPanel.socialLinks.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>

{{--
<script>
    // Default options
$('#icon-picker').iconpicker();

// Custom options
$('#icon-picker').iconpicker({
    align: 'center', // Only in div tag
    arrowClass: 'btn btn-sm-danger',
    arrowPrevIconClass: 'fas fa-angle-left',
    arrowNextIconClass: 'fas fa-angle-right',
    cols: 10,
    footer: true,
    header: true,
    icon: 'fas fa-bomb',
    iconset: 'fontawesome5',
    labelHeader: '{0} of {1} pages',
    labelFooter: '{0} - {1} of {2} icons',
    placement: 'bottom', // Only in button tag
    rows: 5,
    search: true,
    searchText: 'Search',
    selectedClass: 'btn btn-sm-success',
    unselectedClass: ''
});


$('.search-control').on('change', function(e) {
    console.log($('.search-control').val());
});

</script> --}}
