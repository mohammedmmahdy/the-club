<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateSliderRequest;
use App\Http\Requests\AdminPanel\UpdateSliderRequest;
use App\Repositories\AdminPanel\SliderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SliderController extends AppBaseController
{
    /** @var  SliderRepository */
    private $SliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->SliderRepository = $sliderRepo;
    }

    /**
     * Display a listing of the slider.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sliders = $this->SliderRepository->paginate(10);

        return view('adminPanel.sliders.index')
            ->with('sliders', $sliders);
    }

    /**
     * Show the form for creating a new slider.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.sliders.create');
    }

    /**
     * Store a newly created slider in storage.
     *
     * @param CreateSliderRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderRequest $request)
    {
        $input = $request->all();

        $slider = $this->SliderRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/sliders.singular')]));

        return redirect(route('adminPanel.sliders.index'));
    }

    /**
     * Display the specified slider.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slider = $this->SliderRepository->find($id);

        if (empty($slider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sliders.singular')]));

            return redirect(route('adminPanel.sliders.index'));
        }

        return view('adminPanel.sliders.show')->with('slider', $slider);
    }

    /**
     * Show the form for editing the specified slider.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slider = $this->SliderRepository->find($id);

        if (empty($slider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sliders.singular')]));

            return redirect(route('adminPanel.sliders.index'));
        }

        return view('adminPanel.sliders.edit')->with('slider', $slider);
    }

    /**
     * Update the specified slider in storage.
     *
     * @param int $id
     * @param UpdateSliderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSliderRequest $request)
    {
        $slider = $this->SliderRepository->find($id);

        if (empty($slider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sliders.singular')]));

            return redirect(route('adminPanel.sliders.index'));
        }

        $slider = $this->SliderRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/sliders.singular')]));

        return redirect(route('adminPanel.sliders.index'));
    }

    /**
     * Remove the specified slider from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slider = $this->SliderRepository->find($id);

        if (empty($slider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/sliders.singular')]));

            return redirect(route('adminPanel.sliders.index'));
        }

        $this->SliderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/sliders.singular')]));

        return redirect(route('adminPanel.sliders.index'));
    }
}
