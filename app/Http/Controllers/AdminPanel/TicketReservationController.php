<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateTicketReservationRequest;
use App\Http\Requests\AdminPanel\UpdateTicketReservationRequest;
use App\Repositories\AdminPanel\TicketReservationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TicketReservationController extends AppBaseController
{
    /** @var  TicketReservationRepository */
    private $ticketReservationRepository;

    public function __construct(TicketReservationRepository $ticketReservationRepo)
    {
        $this->ticketReservationRepository = $ticketReservationRepo;
    }

    /**
     * Display a listing of the TicketReservation.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ticketReservations = $this->ticketReservationRepository->all();

        return view('adminPanel.ticket_reservations.index')
            ->with('ticketReservations', $ticketReservations);
    }

    /**
     * Show the form for creating a new TicketReservation.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.ticket_reservations.create');
    }

    /**
     * Store a newly created TicketReservation in storage.
     *
     * @param CreateTicketReservationRequest $request
     *
     * @return Response
     */
    public function store(CreateTicketReservationRequest $request)
    {
        $input = $request->all();

        $ticketReservation = $this->ticketReservationRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/ticketReservations.singular')]));

        return redirect(route('adminPanel.ticketReservations.index'));
    }

    /**
     * Display the specified TicketReservation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ticketReservation = $this->ticketReservationRepository->find($id);

        if (empty($ticketReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ticketReservations.singular')]));

            return redirect(route('adminPanel.ticketReservations.index'));
        }

        return view('adminPanel.ticket_reservations.show')->with('ticketReservation', $ticketReservation);
    }

    /**
     * Show the form for editing the specified TicketReservation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ticketReservation = $this->ticketReservationRepository->find($id);

        if (empty($ticketReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ticketReservations.singular')]));

            return redirect(route('adminPanel.ticketReservations.index'));
        }

        return view('adminPanel.ticket_reservations.edit')->with('ticketReservation', $ticketReservation);
    }

    /**
     * Update the specified TicketReservation in storage.
     *
     * @param int $id
     * @param UpdateTicketReservationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTicketReservationRequest $request)
    {
        $ticketReservation = $this->ticketReservationRepository->find($id);

        if (empty($ticketReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ticketReservations.singular')]));

            return redirect(route('adminPanel.ticketReservations.index'));
        }

        $ticketReservation = $this->ticketReservationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/ticketReservations.singular')]));

        return redirect(route('adminPanel.ticketReservations.index'));
    }

    /**
     * Remove the specified TicketReservation from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ticketReservation = $this->ticketReservationRepository->find($id);

        if (empty($ticketReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ticketReservations.singular')]));

            return redirect(route('adminPanel.ticketReservations.index'));
        }

        $this->ticketReservationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/ticketReservations.singular')]));

        return redirect(route('adminPanel.ticketReservations.index'));
    }
}
