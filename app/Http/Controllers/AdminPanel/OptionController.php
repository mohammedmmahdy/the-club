<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateOptionRequest;
use App\Http\Requests\AdminPanel\UpdateOptionRequest;
use App\Repositories\AdminPanel\OptionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OptionController extends AppBaseController
{
    /** @var  OptionRepository */
    private $optionRepository;

    public function __construct(OptionRepository $optionRepo)
    {
        $this->optionRepository = $optionRepo;
    }

    /**
     * Display a listing of the Option.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $options = $this->optionRepository->all();

        return view('adminPanel.options.index')
            ->with('options', $options);
    }

    /**
     * Show the form for creating a new Option.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.options.create');
    }

    /**
     * Store a newly created Option in storage.
     *
     * @param CreateOptionRequest $request
     *
     * @return Response
     */
    public function store(CreateOptionRequest $request)
    {
        $input = $request->all();

        $option = $this->optionRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/options.singular')]));

        return redirect(route('adminPanel.options.index'));
    }

    /**
     * Display the specified Option.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('adminPanel.options.index'));
        }

        return view('adminPanel.options.show')->with('option', $option);
    }

    /**
     * Show the form for editing the specified Option.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('adminPanel.options.index'));
        }

        return view('adminPanel.options.edit')->with('option', $option);
    }

    /**
     * Update the specified Option in storage.
     *
     * @param int $id
     * @param UpdateOptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOptionRequest $request)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('adminPanel.options.index'));
        }

        $option = $this->optionRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/options.singular')]));

        return back();
    }

    /**
     * Remove the specified Option from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error(__('messages.not_found', ['model' => __('models/options.singular')]));

            return redirect(route('adminPanel.options.index'));
        }

        $this->optionRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/options.singular')]));

        return redirect(route('adminPanel.options.index'));
    }
}
