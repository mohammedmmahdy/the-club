<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateInformationRequest;
use App\Http\Requests\AdminPanel\UpdateInformationRequest;
use App\Repositories\AdminPanel\InformationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class InformationController extends AppBaseController
{
    /** @var  InformationRepository */
    private $informationRepository;

    public function __construct(InformationRepository $informationRepo)
    {
        $this->informationRepository = $informationRepo;
    }

    /**
     * Display a listing of the Information.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $information = $this->informationRepository->all();

        return view('adminPanel.information.index')
            ->with('information', $information);
    }

    /**
     * Show the form for creating a new Information.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.information.create');
    }

    /**
     * Store a newly created Information in storage.
     *
     * @param CreateInformationRequest $request
     *
     * @return Response
     */
    public function store(CreateInformationRequest $request)
    {
        $input = $request->all();

        $information = $this->informationRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/information.singular')]));

        return redirect(route('adminPanel.information.index'));
    }

    /**
     * Display the specified Information.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $information = $this->informationRepository->find($id);

        if (empty($information)) {
            Flash::error(__('messages.not_found', ['model' => __('models/information.singular')]));

            return redirect(route('adminPanel.information.index'));
        }

        return view('adminPanel.information.show')->with('information', $information);
    }

    /**
     * Show the form for editing the specified Information.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $information = $this->informationRepository->find($id);

        if (empty($information)) {
            Flash::error(__('messages.not_found', ['model' => __('models/information.singular')]));

            return redirect(route('adminPanel.information.index'));
        }

        return view('adminPanel.information.edit')->with('information', $information);
    }

    /**
     * Update the specified Information in storage.
     *
     * @param int $id
     * @param UpdateInformationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInformationRequest $request)
    {
        $information = $this->informationRepository->find($id);

        if (empty($information)) {
            Flash::error(__('messages.not_found', ['model' => __('models/information.singular')]));

            return redirect(route('adminPanel.information.index'));
        }

        $information = $this->informationRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/information.singular')]));

        return redirect(route('adminPanel.information.index'));
    }

    /**
     * Remove the specified Information from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $information = $this->informationRepository->find($id);

        if (empty($information)) {
            Flash::error(__('messages.not_found', ['model' => __('models/information.singular')]));

            return redirect(route('adminPanel.information.index'));
        }

        $this->informationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/information.singular')]));

        return redirect(route('adminPanel.information.index'));
    }
}
