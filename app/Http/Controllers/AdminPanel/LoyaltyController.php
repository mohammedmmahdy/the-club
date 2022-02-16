<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateLoyaltyRequest;
use App\Http\Requests\AdminPanel\UpdateLoyaltyRequest;
use App\Repositories\AdminPanel\LoyaltyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class LoyaltyController extends AppBaseController
{
    /** @var  LoyaltyRepository */
    private $loyaltyRepository;

    public function __construct(LoyaltyRepository $loyaltyRepo)
    {
        $this->loyaltyRepository = $loyaltyRepo;
    }

    /**
     * Display a listing of the Loyalty.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $loyalties = $this->loyaltyRepository->paginate(10);

        return view('adminPanel.loyalties.index')
            ->with('loyalties', $loyalties);
    }

    /**
     * Show the form for creating a new Loyalty.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.loyalties.create');
    }

    /**
     * Store a newly created Loyalty in storage.
     *
     * @param CreateLoyaltyRequest $request
     *
     * @return Response
     */
    public function store(CreateLoyaltyRequest $request)
    {
        $input = $request->all();

        $loyalty = $this->loyaltyRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/loyalties.singular')]));

        return redirect(route('adminPanel.loyalties.index'));
    }

    /**
     * Display the specified Loyalty.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $loyalty = $this->loyaltyRepository->find($id);

        if (empty($loyalty)) {
            Flash::error(__('messages.not_found', ['model' => __('models/loyalties.singular')]));

            return redirect(route('adminPanel.loyalties.index'));
        }

        return view('adminPanel.loyalties.show')->with('loyalty', $loyalty);
    }

    /**
     * Show the form for editing the specified Loyalty.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $loyalty = $this->loyaltyRepository->find($id);

        if (empty($loyalty)) {
            Flash::error(__('messages.not_found', ['model' => __('models/loyalties.singular')]));

            return redirect(route('adminPanel.loyalties.index'));
        }

        return view('adminPanel.loyalties.edit')->with('loyalty', $loyalty);
    }

    /**
     * Update the specified Loyalty in storage.
     *
     * @param int $id
     * @param UpdateLoyaltyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLoyaltyRequest $request)
    {
        $loyalty = $this->loyaltyRepository->find($id);

        if (empty($loyalty)) {
            Flash::error(__('messages.not_found', ['model' => __('models/loyalties.singular')]));

            return redirect(route('adminPanel.loyalties.index'));
        }

        $loyalty = $this->loyaltyRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/loyalties.singular')]));

        return redirect(route('adminPanel.loyalties.index'));
    }

    /**
     * Remove the specified Loyalty from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $loyalty = $this->loyaltyRepository->find($id);

        if (empty($loyalty)) {
            Flash::error(__('messages.not_found', ['model' => __('models/loyalties.singular')]));

            return redirect(route('adminPanel.loyalties.index'));
        }

        $this->loyaltyRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/loyalties.singular')]));

        return redirect(route('adminPanel.loyalties.index'));
    }
}
