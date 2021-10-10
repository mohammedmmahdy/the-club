<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateMetaRequest;
use App\Http\Requests\AdminPanel\UpdateMetaRequest;
use App\Repositories\AdminPanel\MetaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Page;
use Response;
use Flash;

class MetaController extends AppBaseController
{
    /** @var  MetaRepository */
    private $metaRepository;

    public function __construct(MetaRepository $metaRepo)
    {
        $this->metaRepository = $metaRepo;
    }

    /**
     * Display a listing of the Meta.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $metas = $this->metaRepository->all();

        return view('adminPanel.metas.index')
            ->with('metas', $metas);
    }

    /**
     * Show the form for creating a new Meta.
     *
     * @return Response
     */
    public function create()
    {
        $pages = Page::get();

        return view('adminPanel.metas.create')->with('pages', $pages);
    }

    /**
     * Store a newly created Meta in storage.
     *
     * @param CreateMetaRequest $request
     *
     * @return Response
     */
    public function store(CreateMetaRequest $request)
    {
        // return $request;
        $input = $request->all();

        $meta = $this->metaRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/metas.singular')]));

        return redirect(route('adminPanel.metas.index'));
    }

    /**
     * Display the specified Meta.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $meta = $this->metaRepository->find($id);

        if (empty($meta)) {
            Flash::error(__('messages.not_found', ['model' => __('models/metas.singular')]));

            return redirect(route('adminPanel.metas.index'));
        }

        return view('adminPanel.metas.show')->with('meta', $meta);
    }

    /**
     * Show the form for editing the specified Meta.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $meta = $this->metaRepository->find($id);

        if (empty($meta)) {
            Flash::error(__('messages.not_found', ['model' => __('models/metas.singular')]));

            return redirect(route('adminPanel.metas.index'));
        }

        $pages = Page::get();

        return view('adminPanel.metas.edit')->with('meta', $meta)->with('pages', $pages);
    }

    /**
     * Update the specified Meta in storage.
     *
     * @param int $id
     * @param UpdateMetaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMetaRequest $request)
    {
        $meta = $this->metaRepository->find($id);

        if (empty($meta)) {
            Flash::error(__('messages.not_found', ['model' => __('models/metas.singular')]));

            return redirect(route('adminPanel.metas.index'));
        }

        $meta = $this->metaRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/metas.singular')]));

        return redirect(route('adminPanel.metas.index'));
    }

    /**
     * Remove the specified Meta from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $meta = $this->metaRepository->find($id);

        if (empty($meta)) {
            Flash::error(__('messages.not_found', ['model' => __('models/metas.singular')]));

            return redirect(route('adminPanel.metas.index'));
        }

        $this->metaRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/metas.singular')]));

        return redirect(route('adminPanel.metas.index'));
    }
}
