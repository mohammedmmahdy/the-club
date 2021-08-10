<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateAppFeatureRequest;
use App\Http\Requests\AdminPanel\UpdateAppFeatureRequest;
use App\Repositories\AdminPanel\AppFeatureRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AppFeatureController extends AppBaseController
{
    /** @var  AppFeatureRepository */
    private $appFeatureRepository;

    public function __construct(AppFeatureRepository $appFeatureRepo)
    {
        $this->appFeatureRepository = $appFeatureRepo;
    }

    /**
     * Display a listing of the AppFeature.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $appFeatures = $this->appFeatureRepository->all();

        return view('adminPanel.app_features.index')
            ->with('appFeatures', $appFeatures);
    }

    /**
     * Show the form for creating a new AppFeature.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.app_features.create');
    }

    /**
     * Store a newly created AppFeature in storage.
     *
     * @param CreateAppFeatureRequest $request
     *
     * @return Response
     */
    public function store(CreateAppFeatureRequest $request)
    {
        $input = $request->all();

        $appFeature = $this->appFeatureRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/appFeatures.singular')]));

        return redirect(route('adminPanel.appFeatures.index'));
    }

    /**
     * Display the specified AppFeature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appFeature = $this->appFeatureRepository->find($id);

        if (empty($appFeature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/appFeatures.singular')]));

            return redirect(route('adminPanel.appFeatures.index'));
        }

        return view('adminPanel.app_features.show')->with('appFeature', $appFeature);
    }

    /**
     * Show the form for editing the specified AppFeature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appFeature = $this->appFeatureRepository->find($id);

        if (empty($appFeature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/appFeatures.singular')]));

            return redirect(route('adminPanel.appFeatures.index'));
        }

        return view('adminPanel.app_features.edit')->with('appFeature', $appFeature);
    }

    /**
     * Update the specified AppFeature in storage.
     *
     * @param int $id
     * @param UpdateAppFeatureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAppFeatureRequest $request)
    {
        $appFeature = $this->appFeatureRepository->find($id);

        if (empty($appFeature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/appFeatures.singular')]));

            return redirect(route('adminPanel.appFeatures.index'));
        }

        $appFeature = $this->appFeatureRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/appFeatures.singular')]));

        return redirect(route('adminPanel.appFeatures.index'));
    }

    /**
     * Remove the specified AppFeature from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appFeature = $this->appFeatureRepository->find($id);

        if (empty($appFeature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/appFeatures.singular')]));

            return redirect(route('adminPanel.appFeatures.index'));
        }

        $this->appFeatureRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/appFeatures.singular')]));

        return redirect(route('adminPanel.appFeatures.index'));
    }
}
