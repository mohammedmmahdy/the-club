<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateChampRequest;
use App\Http\Requests\AdminPanel\UpdateChampRequest;
use App\Repositories\AdminPanel\ChampRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ChampController extends AppBaseController
{
    /** @var  ChampRepository */
    private $champRepository;

    public function __construct(ChampRepository $champRepo)
    {
        $this->champRepository = $champRepo;
    }

    /**
     * Display a listing of the Champ.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $champs = $this->champRepository->paginate(10);

        return view('adminPanel.champs.index')
            ->with('champs', $champs);
    }

    /**
     * Show the form for creating a new Champ.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.champs.create');
    }

    /**
     * Store a newly created Champ in storage.
     *
     * @param CreateChampRequest $request
     *
     * @return Response
     */
    public function store(CreateChampRequest $request)
    {
        $input = $request->all();

        $champ = $this->champRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/champs.singular')]));

        return redirect(route('adminPanel.champs.index'));
    }

    /**
     * Display the specified Champ.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $champ = $this->champRepository->find($id);

        if (empty($champ)) {
            Flash::error(__('messages.not_found', ['model' => __('models/champs.singular')]));

            return redirect(route('adminPanel.champs.index'));
        }

        return view('adminPanel.champs.show')->with('champ', $champ);
    }

    /**
     * Show the form for editing the specified Champ.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $champ = $this->champRepository->find($id);

        if (empty($champ)) {
            Flash::error(__('messages.not_found', ['model' => __('models/champs.singular')]));

            return redirect(route('adminPanel.champs.index'));
        }

        return view('adminPanel.champs.edit')->with('champ', $champ);
    }

    /**
     * Update the specified Champ in storage.
     *
     * @param int $id
     * @param UpdateChampRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChampRequest $request)
    {
        $champ = $this->champRepository->find($id);

        if (empty($champ)) {
            Flash::error(__('messages.not_found', ['model' => __('models/champs.singular')]));

            return redirect(route('adminPanel.champs.index'));
        }

        $champ = $this->champRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/champs.singular')]));

        return redirect(route('adminPanel.champs.index'));
    }

    /**
     * Remove the specified Champ from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $champ = $this->champRepository->find($id);

        if (empty($champ)) {
            Flash::error(__('messages.not_found', ['model' => __('models/champs.singular')]));

            return redirect(route('adminPanel.champs.index'));
        }

        $this->champRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/champs.singular')]));

        return redirect(route('adminPanel.champs.index'));
    }
}
