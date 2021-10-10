{!! Form::open(['route' => ['adminPanel.socialLinks.destroy', $id], 'method' => 'delete']) !!}
<div class='btn btn-sm-group'>
    <a href="{{ route('adminPanel.socialLinks.show', $id) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('adminPanel.socialLinks.edit', $id) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
    'type' => 'submit',
    'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger',
    'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
