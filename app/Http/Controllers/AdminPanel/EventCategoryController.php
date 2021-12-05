<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateEventCategoryRequest;
use App\Http\Requests\AdminPanel\UpdateEventCategoryRequest;
use App\Repositories\AdminPanel\EventCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class EventCategoryController extends AppBaseController
{
    /** @var  EventCategoryRepository */
    private $eventCategoryRepository;

    public function __construct(EventCategoryRepository $eventCategoryRepo)
    {
        $this->eventCategoryRepository = $eventCategoryRepo;
    }

    /**
     * Display a listing of the EventCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $eventCategories = $this->eventCategoryRepository->paginate(10);

        return view('adminPanel.event_categories.index')
            ->with('eventCategories', $eventCategories);
    }

    /**
     * Show the form for creating a new EventCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.event_categories.create');
    }

    /**
     * Store a newly created EventCategory in storage.
     *
     * @param CreateEventCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateEventCategoryRequest $request)
    {
        $input = $request->all();

        $eventCategory = $this->eventCategoryRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/eventCategories.singular')]));

        return redirect(route('adminPanel.eventCategories.index'));
    }

    /**
     * Display the specified EventCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/eventCategories.singular')]));

            return redirect(route('adminPanel.eventCategories.index'));
        }

        return view('adminPanel.event_categories.show')->with('eventCategory', $eventCategory);
    }

    /**
     * Show the form for editing the specified EventCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/eventCategories.singular')]));

            return redirect(route('adminPanel.eventCategories.index'));
        }

        return view('adminPanel.event_categories.edit')->with('eventCategory', $eventCategory);
    }

    /**
     * Update the specified EventCategory in storage.
     *
     * @param int $id
     * @param UpdateEventCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventCategoryRequest $request)
    {
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/eventCategories.singular')]));

            return redirect(route('adminPanel.eventCategories.index'));
        }

        $eventCategory = $this->eventCategoryRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/eventCategories.singular')]));

        return redirect(route('adminPanel.eventCategories.index'));
    }

    /**
     * Remove the specified EventCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $eventCategory = $this->eventCategoryRepository->find($id);

        if (empty($eventCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/eventCategories.singular')]));

            return redirect(route('adminPanel.eventCategories.index'));
        }

        $this->eventCategoryRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/eventCategories.singular')]));

        return redirect(route('adminPanel.eventCategories.index'));
    }
}
