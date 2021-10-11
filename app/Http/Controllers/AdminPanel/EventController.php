<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\EventReservation;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\EventRepository;
use App\Http\Requests\AdminPanel\CreateEventRequest;
use App\Http\Requests\AdminPanel\UpdateEventRequest;
use App\Models\Branch;

class EventController extends AppBaseController
{
    /** @var  EventRepository */
    private $eventRepository;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
    }

    /**
     * Display a listing of the Event.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $events = $this->eventRepository->all();
        $reservations_count = $this->reservations()->reservations->count();

        return view('adminPanel.events.index',compact('reservations_count','events'));
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        $branches = Branch::get()->pluck('name','id');
        return view('adminPanel.events.create', compact('branches'));
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param CreateEventRequest $request
     *
     * @return Response
     */
    public function store(CreateEventRequest $request)
    {
        $input = $request->all();

        $event = $this->eventRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/events.singular')]));

        return redirect(route('adminPanel.events.index'));
    }

    /**
     * Display the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error(__('messages.not_found', ['model' => __('models/events.singular')]));

            return redirect(route('adminPanel.events.index'));
        }

        return view('adminPanel.events.show')->with('event', $event);
    }

    /**
     * Show the form for editing the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error(__('messages.not_found', ['model' => __('models/events.singular')]));

            return redirect(route('adminPanel.events.index'));
        }

        $branches = Branch::get()->pluck('name','id');

        return view('adminPanel.events.edit',compact('branches', 'event'));
    }

    /**
     * Update the specified Event in storage.
     *
     * @param int $id
     * @param UpdateEventRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventRequest $request)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error(__('messages.not_found', ['model' => __('models/events.singular')]));

            return redirect(route('adminPanel.events.index'));
        }

        $event = $this->eventRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/events.singular')]));

        return redirect(route('adminPanel.events.index'));
    }

    /**
     * Remove the specified Event from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error(__('messages.not_found', ['model' => __('models/events.singular')]));

            return redirect(route('adminPanel.events.index'));
        }

        $this->eventRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/events.singular')]));

        return redirect(route('adminPanel.events.index'));
    }



    public function reservations()
    {
        $reservations = EventReservation::inactive()->get();

        return view('adminPanel.events.reservations', compact('reservations'));
    }


    public function changeReservationStatus(EventReservation $reservation)
    {
        $reservation->update(['status' => request('status')]);

        return back();
    }


    public function dateFilter()
    {
        $fromDate = (new Carbon(request('event_reservation_from')))->format('y-m-d G:i:s');
        $toDate = (new Carbon(request('event_reservation_to')))->format('y-m-d G:i:s');

        $reservationsQuery = EventReservation::inactive();
        if (request()->filled('event_reservation_from') || request()->filled('event_reservation_to')) {
            $reservationsQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }
        $reservations = $reservationsQuery->get();

        return view('adminPanel.events.reservations', compact('reservations'));
    }

}
