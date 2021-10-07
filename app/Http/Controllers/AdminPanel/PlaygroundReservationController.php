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

    /**
     * Display a listing of the PlaygroundReservation.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $playgroundReservations = $this->playgroundReservationRepository->all();

        return view('adminPanel.playground_reservations.index')
            ->with('playgroundReservations', $playgroundReservations);
    }

    /**
     * Show the form for creating a new PlaygroundReservation.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.playground_reservations.create');
    }

    /**
     * Store a newly created PlaygroundReservation in storage.
     *
     * @param CreatePlaygroundReservationRequest $request
     *
     * @return Response
     */
    public function store(CreatePlaygroundReservationRequest $request)
    {
        $input = $request->all();

        $playgroundReservation = $this->playgroundReservationRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/playgroundReservations.singular')]));

        return redirect(route('adminPanel.playgroundReservations.index'));
    }

    /**
     * Display the specified PlaygroundReservation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $playgroundReservation = $this->playgroundReservationRepository->find($id);

        if (empty($playgroundReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgroundReservations.singular')]));

            return redirect(route('adminPanel.playgroundReservations.index'));
        }

        return view('adminPanel.playground_reservations.show')->with('playgroundReservation', $playgroundReservation);
    }

    /**
     * Show the form for editing the specified PlaygroundReservation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $playgroundReservation = $this->playgroundReservationRepository->find($id);

        if (empty($playgroundReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgroundReservations.singular')]));

            return redirect(route('adminPanel.playgroundReservations.index'));
        }

        return view('adminPanel.playground_reservations.edit')->with('playgroundReservation', $playgroundReservation);
    }

    /**
     * Update the specified PlaygroundReservation in storage.
     *
     * @param int $id
     * @param UpdatePlaygroundReservationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlaygroundReservationRequest $request)
    {
        $playgroundReservation = $this->playgroundReservationRepository->find($id);

        if (empty($playgroundReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgroundReservations.singular')]));

            return redirect(route('adminPanel.playgroundReservations.index'));
        }

        $playgroundReservation = $this->playgroundReservationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/playgroundReservations.singular')]));

        return redirect(route('adminPanel.playgroundReservations.index'));
    }

    /**
     * Remove the specified PlaygroundReservation from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $playgroundReservation = $this->playgroundReservationRepository->find($id);

        if (empty($playgroundReservation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgroundReservations.singular')]));

            return redirect(route('adminPanel.playgroundReservations.index'));
        }

        $this->playgroundReservationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/playgroundReservations.singular')]));

        return redirect(route('adminPanel.playgroundReservations.index'));
    }
}
