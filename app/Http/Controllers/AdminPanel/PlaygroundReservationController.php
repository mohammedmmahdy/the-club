<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreatePlaygroundReservationRequest;
use App\Http\Requests\AdminPanel\UpdatePlaygroundReservationRequest;
use App\Repositories\AdminPanel\PlaygroundReservationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PlaygroundReservationController extends AppBaseController
{
    /** @var  PlaygroundReservationRepository */
    private $playgroundReservationRepository;

    public function __construct(PlaygroundReservationRepository $playgroundReservationRepo)
    {
        $this->playgroundReservationRepository = $playgroundReservationRepo;
    }


    public function index(Request $request)
    {
        $playgroundReservations = $this->playgroundReservationRepository->all();

        return view('adminPanel.playground_reservations.index')
            ->with('playgroundReservations', $playgroundReservations);
    }

    public function show($id)
    {
        $playgroundReservation = $this->playgroundReservationRepository->find($id);

        if (empty($playgroundReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgroundReservations.singular')]));

            return redirect(route('adminPanel.playgroundReservations.index'));
        }

        return view('adminPanel.playground_reservations.show')->with('playgroundReservation', $playgroundReservation);
    }

}
