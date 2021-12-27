<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateOnboardingRequest;
use App\Http\Requests\AdminPanel\UpdateOnboardingRequest;
use App\Repositories\AdminPanel\OnboardingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OnboardingController extends AppBaseController
{
    /** @var  OnboardingRepository */
    private $onboardingRepository;

    public function __construct(OnboardingRepository $onboardingRepo)
    {
        $this->onboardingRepository = $onboardingRepo;
    }

    /**
     * Display a listing of the Onboarding.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $onboardings = $this->onboardingRepository->all();

        return view('adminPanel.onboardings.index')
            ->with('onboardings', $onboardings);
    }

    /**
     * Show the form for creating a new Onboarding.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.onboardings.create');
    }

    /**
     * Store a newly created Onboarding in storage.
     *
     * @param CreateOnboardingRequest $request
     *
     * @return Response
     */
    public function store(CreateOnboardingRequest $request)
    {
        $input = $request->all();

        $onboarding = $this->onboardingRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/onboardings.singular')]));

        return redirect(route('adminPanel.onboardings.index'));
    }

    /**
     * Display the specified Onboarding.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $onboarding = $this->onboardingRepository->find($id);

        if (empty($onboarding)) {
            Flash::error(__('messages.not_found', ['model' => __('models/onboardings.singular')]));

            return redirect(route('adminPanel.onboardings.index'));
        }

        return view('adminPanel.onboardings.show')->with('onboarding', $onboarding);
    }

    /**
     * Show the form for editing the specified Onboarding.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $onboarding = $this->onboardingRepository->find($id);

        if (empty($onboarding)) {
            Flash::error(__('messages.not_found', ['model' => __('models/onboardings.singular')]));

            return redirect(route('adminPanel.onboardings.index'));
        }

        return view('adminPanel.onboardings.edit')->with('onboarding', $onboarding);
    }

    /**
     * Update the specified Onboarding in storage.
     *
     * @param int $id
     * @param UpdateOnboardingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOnboardingRequest $request)
    {
        $onboarding = $this->onboardingRepository->find($id);

        if (empty($onboarding)) {
            Flash::error(__('messages.not_found', ['model' => __('models/onboardings.singular')]));

            return redirect(route('adminPanel.onboardings.index'));
        }

        $onboarding = $this->onboardingRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/onboardings.singular')]));

        return redirect(route('adminPanel.onboardings.index'));
    }

    /**
     * Remove the specified Onboarding from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $onboarding = $this->onboardingRepository->find($id);

        if (empty($onboarding)) {
            Flash::error(__('messages.not_found', ['model' => __('models/onboardings.singular')]));

            return redirect(route('adminPanel.onboardings.index'));
        }

        $this->onboardingRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/onboardings.singular')]));

        return redirect(route('adminPanel.onboardings.index'));
    }
}
