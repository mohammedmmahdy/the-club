<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/ticketReservations.fields.user_id')</th>
        <th>@lang('models/ticketReservations.fields.first_name')</th>
        <th>@lang('models/ticketReservations.fields.last_name')</th>
        <th>@lang('models/ticketReservations.fields.phone')</th>
        <th>@lang('models/ticketReservations.fields.date')</th>
        <th>@lang('models/ticketReservations.fields.number_of_people')</th>
        <th>@lang('models/ticketReservations.fields.price')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ticketReservations as $ticketReservation)
            <tr>
                <td>{{ $ticketReservation->user_id }}</td>
            <td>{{ $ticketReservation->first_name }}</td>
            <td>{{ $ticketReservation->last_name }}</td>
            <td>{{ $ticketReservation->phone }}</td>
            <td>{{ $ticketReservation->date }}</td>
            <td>{{ $ticketReservation->number_of_people }}</td>
            <td>{{ $ticketReservation->price }}</td>
                <td nowrap>
                    <div class='btn-group'>
                    @can('ticketReservations view')
                        <a href="{{ route('adminPanel.ticketReservations.show', [$ticketReservation->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
