<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Academy;
use App\Models\AcademyPhoto;
use Illuminate\Http\Request;
use App\Models\AcademySchedule;
use App\Models\AcademySubscription;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\AcademyRepository;
use App\Http\Requests\AdminPanel\CreateAcademyRequest;
use App\Http\Requests\AdminPanel\UpdateAcademyRequest;

class AcademyController extends AppBaseController
{
    /** @var  AcademyRepository */
    private $academyRepository;

    public function __construct(AcademyRepository $academyRepo)
    {
        $this->academyRepository = $academyRepo;
    }

    /**
     * Display a listing of the Academy.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $academies = $this->academyRepository->all();
        $requests_count = $this->requests()->requests->count();

        return view('adminPanel.academies.index', compact('requests_count', 'academies'));
    }

    /**
     * Show the form for creating a new Academy.
     *
     * @return Response
     */
    public function create()
    {
        $data['branches'] = Branch::get()->pluck('name', 'id');
        $data['days'] = Academy::WEEK_DAYS;

        return view('adminPanel.academies.create',compact('data'));
    }

    /**
     * Store a newly created Academy in storage.
     *
     * @param CreateAcademyRequest $request
     *
     * @return Response
     */
    public function store(CreateAcademyRequest $request)
    {
        $input = $request->all();

        $academy = $this->academyRepository->create($input);


        foreach (request('photos') as $photo) {
            $academy->photos()->create([
                'photo' => $photo
            ]);
        }

        foreach ($request->time as $key => $time) {
            $academy->schedules()->create($time);
        }



        Flash::success(__('messages.saved', ['model' => __('models/academies.singular')]));

        return redirect(route('adminPanel.academies.index'));
    }

    /**
     * Display the specified Academy.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            Flash::error(__('messages.not_found', ['model' => __('models/academies.singular')]));

            return redirect(route('adminPanel.academies.index'));
        }

        return view('adminPanel.academies.show')->with('academy', $academy);
    }

    /**
     * Show the form for editing the specified Academy.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            Flash::error(__('messages.not_found', ['model' => __('models/academies.singular')]));

            return redirect(route('adminPanel.academies.index'));
        }

        $data['branches'] = Branch::get()->pluck('name', 'id');
        $data['days'] = Academy::WEEK_DAYS;

        return view('adminPanel.academies.edit',compact('academy', 'data'));
    }

    /**
     * Update the specified Academy in storage.
     *
     * @param int $id
     * @param UpdateAcademyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAcademyRequest $request)
    {
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            Flash::error(__('messages.not_found', ['model' => __('models/academies.singular')]));

            return redirect(route('adminPanel.academies.index'));
        }


        if (request('photos')) {
            foreach (request('photos') as $photo) {
                $academy->photos()->create([
                    'photo' => $photo
                ]);
            }
        }

        if (!empty($request->time)) {
            foreach ($request->time as $key => $time) {
                $academy->schedules()->updateOrCreate(['id' => $key], $time);
            }
        }

        $academy = $this->academyRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/academies.singular')]));

        return redirect(route('adminPanel.academies.index'));
    }

    /**
     * Remove the specified Academy from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            Flash::error(__('messages.not_found', ['model' => __('models/academies.singular')]));

            return redirect(route('adminPanel.academies.index'));
        }

        $this->academyRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/academies.singular')]));

        return redirect(route('adminPanel.academies.index'));
    }

    public function destroyPhoto($id)
    {
        $photo = AcademyPhoto::find($id);
        $photo->delete($id);

        return back();
    }

    public function destroyTime($id)
    {
        AcademySchedule::find($id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);

        return back();
    }

    public function requests()
    {
        $requests = AcademySubscription::inactive()->latest()->get();

        return view('adminPanel.academies.requests', compact('requests'));
    }

    public function changeRequestStatus(AcademySubscription $subscription)
    {
        $subscription->update(['status' => request('status')]);

        return back();
    }

    public function updateProgress(AcademySubscription $subscription)
    {
        $validated = request()->validate([
            'level'             => 'required|integer',
            'total_levels'      => 'required|integer',
            'session'           => 'required|integer',
            'total_sessions'    => 'required|integer',
        ]);
        $subscription->update($validated);

        return back();
    }


    public function dateFilter()
    {
        $fromDate = (new Carbon(request('academy_request_from')))->format('y-m-d G:i:s');
        $toDate = (new Carbon(request('academy_request_to')))->format('y-m-d G:i:s');

        $requestsQuery = AcademySubscription::inactive();
        if (request()->filled('academy_request_from') || request()->filled('academy_request_to')) {
            $requestsQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }
        $requests = $requestsQuery->get();

        return view('adminPanel.academies.requests', compact('requests'));
    }

}
