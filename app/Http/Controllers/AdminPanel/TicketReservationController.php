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


    public function index(Request $request)
    {
        $ticketReservations = $this->ticketReservationRepository->all();

        return view('adminPanel.ticket_reservations.index')
            ->with('ticketReservations', $ticketReservations);
    }


    public function show($id)
    {
        $ticketReservation = $this->ticketReservationRepository->find($id);

        if (empty($ticketReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/ticketReservations.singular')]));

            return redirect(route('adminPanel.ticketReservations.index'));
        }

        return view('adminPanel.ticket_reservations.show')->with('ticketReservation', $ticketReservation);
    }


}
