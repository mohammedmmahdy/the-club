<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/playgroundReservations.fields.playground_id')</th>
            <th>@lang('models/playgroundReservations.fields.date')</th>
            <th>@lang('models/playgroundReservations.fields.time')</th>
            <th>@lang('models/playgroundReservations.fields.number_of_hours')</th>
            {{-- <th>@lang('models/playgrounds.fields.price')</th> --}}
            <th>@lang('models/playgroundReservations.fields.number_of_people')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($playgroundReservations as $playgroundReservation)
        <tr>
            <td>{{ $playgroundReservation->playground->name ?? '' }}</td>
            {{-- <td>{{ $playgroundReservation->reservation_code }}</td> --}}
            <td>{{ $playgroundReservation->date }}</td>
            <td>{{ $playgroundReservation->time }}</td>
            <td>{{ $playgroundReservation->number_of_hours }}</td>
            {{-- <td>{{ $playgroundReservation->price }} @lang('lang.currency')</td> --}}
            <td>{{ $playgroundReservation->number_of_people }}</td>
            <td nowrap>
                <div class='btn-group'>
                    @can('playgroundReservations view')
                    <a href="{{ route('adminPanel.playgroundReservations.show', [$playgroundReservation->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
