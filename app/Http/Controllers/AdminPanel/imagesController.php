<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateimagesRequest;
use App\Http\Requests\AdminPanel\UpdateimagesRequest;
use App\Repositories\AdminPanel\imagesRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Images;
use App\Models\Page;
use Illuminate\Http\Request;
use Flash;
use Response;

class imagesController extends AppBaseController
{
    /** @var  imagesRepository */
    private $imagesRepository;

    public function __construct(imagesRepository $imagesRepo)
    {
        $this->imagesRepository = $imagesRepo;
    }

    /**
     * Display a listing of the images.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Page $page)
    {
        $images = images::where('page_id', $page->id)->get();

        return view('adminPanel.images.index', compact('page', 'images'));
    }

    /**
     * Show the form for creating a new images.
     *
     * @return Response
     */
    public function create(Page $page)
    {
        return view('adminPanel.images.create', compact('page'));
    }

    /**
     * Store a newly created images in storage.
     *
     * @param CreateimagesRequest $request
     *
     * @return Response
     */
    public function store(CreateimagesRequest $request, Page $page)
    {
        $input = $request->all();
        $input['page_id'] = $page->id;

        $images = $this->imagesRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/images.singular')]));

        return redirect(route('adminPanel.pages.images.index', $page->id));
    }

    /**
     * Display the specified images.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $images = $this->imagesRepository->find($id);

        if (empty($images)) {
            Flash::error(__('messages.not_found', ['model' => __('models/images.singular')]));

            return redirect(route('adminPanel.images.index'));
        }

        return view('adminPanel.images.show')->with('images', $images);
    }

    /**
     * Show the form for editing the specified images.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $images = $this->imagesRepository->find($id);

        if (empty($images)) {
            Flash::error(__('messages.not_found', ['model' => __('models/images.singular')]));

            return redirect(route('adminPanel.images.index'));
        }

        return view('adminPanel.images.edit')->with('images', $images);
    }

    /**
     * Update the specified images in storage.
     *
     * @param int $id
     * @param UpdateimagesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateimagesRequest $request)
    {
        $images = $this->imagesRepository->find($id);

        if (empty($images)) {
            Flash::error(__('messages.not_found', ['model' => __('models/images.singular')]));

            return back();
        }

        $images = $this->imagesRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/images.singular')]));

        return redirect(route('adminPanel.pages.images.index', $images->page_id));
    }

    /**
     * Remove the specified images from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $images = $this->imagesRepository->find($id);

        if (empty($images)) {
            Flash::error(__('messages.not_found', ['model' => __('models/images.singular')]));

            return back();
        }

        $this->imagesRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/images.singular')]));

        return redirect(route('adminPanel.pages.images.index', $images->page_id));
    }
}
