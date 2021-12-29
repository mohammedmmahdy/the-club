<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateOfferCategoryRequest;
use App\Http\Requests\AdminPanel\UpdateOfferCategoryRequest;
use App\Repositories\AdminPanel\OfferCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OfferCategoryController extends AppBaseController
{
    /** @var  OfferCategoryRepository */
    private $offerCategoryRepository;

    public function __construct(OfferCategoryRepository $offerCategoryRepo)
    {
        $this->offerCategoryRepository = $offerCategoryRepo;
    }

    /**
     * Display a listing of the OfferCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $offerCategories = $this->offerCategoryRepository->all();

        return view('adminPanel.offer_categories.index')
            ->with('offerCategories', $offerCategories);
    }

    /**
     * Show the form for creating a new OfferCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.offer_categories.create');
    }

    /**
     * Store a newly created OfferCategory in storage.
     *
     * @param CreateOfferCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferCategoryRequest $request)
    {
        $input = $request->all();

        $offerCategory = $this->offerCategoryRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/offerCategories.singular')]));

        return redirect(route('adminPanel.offerCategories.index'));
    }

    /**
     * Display the specified OfferCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offerCategory = $this->offerCategoryRepository->find($id);

        if (empty($offerCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offerCategories.singular')]));

            return redirect(route('adminPanel.offerCategories.index'));
        }

        return view('adminPanel.offer_categories.show')->with('offerCategory', $offerCategory);
    }

    /**
     * Show the form for editing the specified OfferCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $offerCategory = $this->offerCategoryRepository->find($id);

        if (empty($offerCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offerCategories.singular')]));

            return redirect(route('adminPanel.offerCategories.index'));
        }

        return view('adminPanel.offer_categories.edit')->with('offerCategory', $offerCategory);
    }

    /**
     * Update the specified OfferCategory in storage.
     *
     * @param int $id
     * @param UpdateOfferCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferCategoryRequest $request)
    {
        $offerCategory = $this->offerCategoryRepository->find($id);

        if (empty($offerCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offerCategories.singular')]));

            return redirect(route('adminPanel.offerCategories.index'));
        }

        $offerCategory = $this->offerCategoryRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/offerCategories.singular')]));

        return redirect(route('adminPanel.offerCategories.index'));
    }

    /**
     * Remove the specified OfferCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offerCategory = $this->offerCategoryRepository->find($id);

        if (empty($offerCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offerCategories.singular')]));

            return redirect(route('adminPanel.offerCategories.index'));
        }

        $this->offerCategoryRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/offerCategories.singular')]));

        return redirect(route('adminPanel.offerCategories.index'));
    }
}
