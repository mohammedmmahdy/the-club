<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateOfferRequest;
use App\Http\Requests\AdminPanel\UpdateOfferRequest;
use App\Repositories\AdminPanel\OfferRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\OfferCategory;
use Illuminate\Http\Request;
use Flash;
use Response;

class OfferController extends AppBaseController
{
    /** @var  OfferRepository */
    private $offerRepository;

    public function __construct(OfferRepository $offerRepo)
    {
        $this->offerRepository = $offerRepo;
    }

    /**
     * Display a listing of the Offer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $offers = $this->offerRepository->all();

        return view('adminPanel.offers.index')
            ->with('offers', $offers);
    }

    /**
     * Show the form for creating a new Offer.
     *
     * @return Response
     */
    public function create()
    {
        $offerCategories = OfferCategory::get()->pluck('name', 'id');

        return view('adminPanel.offers.create', compact('offerCategories'));
    }

    /**
     * Store a newly created Offer in storage.
     *
     * @param CreateOfferRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferRequest $request)
    {
        $input = $request->all();

        $offer = $this->offerRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/offers.singular')]));

        return redirect(route('adminPanel.offers.index'));
    }

    /**
     * Display the specified Offer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offers.singular')]));

            return redirect(route('adminPanel.offers.index'));
        }

        return view('adminPanel.offers.show')->with('offer', $offer);
    }

    /**
     * Show the form for editing the specified Offer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offers.singular')]));

            return redirect(route('adminPanel.offers.index'));
        }

        $offerCategories = OfferCategory::get()->pluck('name', 'id');

        return view('adminPanel.offers.edit', compact('offerCategories', 'offer'));
    }

    /**
     * Update the specified Offer in storage.
     *
     * @param int $id
     * @param UpdateOfferRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferRequest $request)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offers.singular')]));

            return redirect(route('adminPanel.offers.index'));
        }

        $offer = $this->offerRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/offers.singular')]));

        return redirect(route('adminPanel.offers.index'));
    }

    /**
     * Remove the specified Offer from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/offers.singular')]));

            return redirect(route('adminPanel.offers.index'));
        }

        $this->offerRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/offers.singular')]));

        return redirect(route('adminPanel.offers.index'));
    }
}
