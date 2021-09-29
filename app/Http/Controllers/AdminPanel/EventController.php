<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateEventRequest;
use App\Http\Requests\AdminPanel\UpdateEventRequest;
use App\Repositories\AdminPanel\EventRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

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

        return view('adminPanel.events.index')
            ->with('events', $events);
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.events.create');
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

        return view('adminPanel.events.edit')->with('event', $event);
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
}
