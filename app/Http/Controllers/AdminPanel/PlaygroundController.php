<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreatePlaygroundRequest;
use App\Http\Requests\AdminPanel\UpdatePlaygroundRequest;
use App\Repositories\AdminPanel\PlaygroundRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Playground;
use App\Models\PlaygroundType;
use Illuminate\Http\Request;
use Flash;
use Response;

class PlaygroundController extends AppBaseController
{
    /** @var  PlaygroundRepository */
    private $playgroundRepository;

    public function __construct(PlaygroundRepository $playgroundRepo)
    {
        $this->playgroundRepository = $playgroundRepo;
    }

    /**
     * Display a listing of the Playground.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $playgrounds = Playground::with('playgroundType')->get();

        return view('adminPanel.playgrounds.index')
            ->with('playgrounds', $playgrounds);
    }

    /**
     * Show the form for creating a new Playground.
     *
     * @return Response
     */
    public function create()
    {
        $playgroundTypes = PlaygroundType::get()->pluck('name', 'id');
        return view('adminPanel.playgrounds.create', compact('playgroundTypes'));
    }

    /**
     * Store a newly created Playground in storage.
     *
     * @param CreatePlaygroundRequest $request
     *
     * @return Response
     */
    public function store(CreatePlaygroundRequest $request)
    {
        $input = $request->all();

        $playground = $this->playgroundRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/playgrounds.singular')]));

        return redirect(route('adminPanel.playgrounds.index'));
    }

    /**
     * Display the specified Playground.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $playground = $this->playgroundRepository->find($id);

        if (empty($playground)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgrounds.singular')]));

            return redirect(route('adminPanel.playgrounds.index'));
        }

        return view('adminPanel.playgrounds.show')->with('playground', $playground);
    }

    /**
     * Show the form for editing the specified Playground.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $playground = $this->playgroundRepository->find($id);

        if (empty($playground)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgrounds.singular')]));

            return redirect(route('adminPanel.playgrounds.index'));
        }
        $playgroundTypes = PlaygroundType::get()->pluck('name', 'id');

        return view('adminPanel.playgrounds.edit',compact('playgroundTypes', 'playground'));
    }

    /**
     * Update the specified Playground in storage.
     *
     * @param int $id
     * @param UpdatePlaygroundRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlaygroundRequest $request)
    {
        $playground = $this->playgroundRepository->find($id);

        if (empty($playground)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgrounds.singular')]));

            return redirect(route('adminPanel.playgrounds.index'));
        }

        $playground = $this->playgroundRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/playgrounds.singular')]));

        return redirect(route('adminPanel.playgrounds.index'));
    }

    /**
     * Remove the specified Playground from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $playground = $this->playgroundRepository->find($id);

        if (empty($playground)) {
            Flash::error(__('messages.not_found', ['model' => __('models/playgrounds.singular')]));

            return redirect(route('adminPanel.playgrounds.index'));
        }

        $this->playgroundRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/playgrounds.singular')]));

        return redirect(route('adminPanel.playgrounds.index'));
    }
}
