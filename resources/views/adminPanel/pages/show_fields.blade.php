<!-- Id Field -->
<div class="form-group">
    <b>{!! Form::label('id', __('models/pages.fields.id').':') !!}</b>
    <p>{{ $page->id }}</p>
</div>

@foreach ( config('langs') as $locale => $name)
<h3>
    <center>
        <code> {{ $name }} </code>
    </center>
</h3>
<div class="form-group">
    <b>{!! Form::label('name', __('models/pages.fields.name').':') !!}</b>
    <p>{{ $page->translate($locale)->name }}</p>
</div>
<div class="form-group">
    <b>{!! Form::label('content', __('models/pages.fields.content').':') !!}</b>
    <p>{!! $page->translate($locale)->content !!}</p>
</div>
@endforeach

<!-- Active Field -->
<div class="form-group">
    <b>{!! Form::label('active', __('models/pages.fields.active').':') !!}</b>
    <p>{{ $page->active }}</p>
</div>

<!-- In Navbar Field -->
<div class="form-group">
    <b>{!! Form::label('in_navbar', __('models/pages.fields.in_navbar').':') !!}</b>
    <p>{{ $page->in_navbar }}</p>
</div>

<!-- In Footer Field -->
<div class="form-group">
    <b>{!! Form::label('in_footer', __('models/pages.fields.in_footer').':') !!}</b>
    <p>{{ $page->in_footer }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <b>{!! Form::label('created_at', __('models/pages.fields.created_at').':') !!}</b>
    <p>{{ $page->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <b>{!! Form::label('updated_at', __('models/pages.fields.updated_at').':') !!}</b>
    <p>{{ $page->updated_at }}</p>
</div>

