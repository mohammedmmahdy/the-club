<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreatePlaygroundTypeRequest;
use App\Http\Requests\AdminPanel\UpdatePlaygroundTypeRequest;
use App\Repositories\AdminPanel\PlaygroundTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PlaygroundTypeController extends AppBaseController
{
    /** @var  PlaygroundTypeRepository */
    private $playgroundTypeRepository;

    public function __construct(PlaygroundTypeRepository $playgroundTypeRepo)
    {
        $this->playgroundTypeRepository = $playgroundTypeRepo;
    }

    /**
     * Display a listing of the PlaygroundType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $playgroundTypes = $this->playgroundTypeRepository->all();

        return view('adminPanel.playground_types.index')
            ->with('playgroundTypes', $playgroundTypes);
    }

    /**
     * Show the form for creating a new PlaygroundType.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.playground_types.create');
    }

    /**
     * Store a newly created PlaygroundType in storage.
     *
     * @param CreatePlaygroundTypeRequest $request
     *
     * @return Response
     */
    public function store(CreatePlaygroundTypeRequest $request)
    {
        $input = $request->all();

        $playgroundType = $this->playgroundTypeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/playgroundTypes.singular')]));

        return redirect(route('adminPanel.playgroundTypes.index'));
    }

    /**
     * Display the specified PlaygroundType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $playgroundType = $this->playgroundTypeRepository->find($id);

        if (empty($playgroundType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgroundTypes.singular')]));

            return redirect(route('adminPanel.playgroundTypes.index'));
        }

        return view('adminPanel.playground_types.show')->with('playgroundType', $playgroundType);
    }

    /**
     * Show the form for editing the specified PlaygroundType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $playgroundType = $this->playgroundTypeRepository->find($id);

        if (empty($playgroundType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgroundTypes.singular')]));

            return redirect(route('adminPanel.playgroundTypes.index'));
        }

        return view('adminPanel.playground_types.edit')->with('playgroundType', $playgroundType);
    }

    /**
     * Update the specified PlaygroundType in storage.
     *
     * @param int $id
     * @param UpdatePlaygroundTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlaygroundTypeRequest $request)
    {
        $playgroundType = $this->playgroundTypeRepository->find($id);

        if (empty($playgroundType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgroundTypes.singular')]));

            return redirect(route('adminPanel.playgroundTypes.index'));
        }

        $playgroundType = $this->playgroundTypeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/playgroundTypes.singular')]));

        return redirect(route('adminPanel.playgroundTypes.index'));
    }

    /**
     * Remove the specified PlaygroundType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $playgroundType = $this->playgroundTypeRepository->find($id);

        if (empty($playgroundType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgroundTypes.singular')]));

            return redirect(route('adminPanel.playgroundTypes.index'));
        }

        $this->playgroundTypeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/playgroundTypes.singular')]));

        return redirect(route('adminPanel.playgroundTypes.index'));
    }
}
