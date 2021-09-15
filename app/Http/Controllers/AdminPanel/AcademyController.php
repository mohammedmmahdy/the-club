<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\AcademyRepository;
use App\Http\Requests\AdminPanel\CreateAcademyRequest;
use App\Http\Requests\AdminPanel\UpdateAcademyRequest;
use App\Models\Academy;
use App\Models\AcademyPhoto;
use App\Models\AcademySchedule;

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

        return view('adminPanel.academies.index')
            ->with('academies', $academies);
    }

    /**
     * Show the form for creating a new Academy.
     *
     * @return Response
     */
    public function create()
    {
        $data['branches'] = Branch::get()->pluck('name', 'id');
        $data['days'] = ['SAT','SUN','MON','TUE','WED','THU','FRI'];

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

        foreach ($request->item as $key => $item) {
            $academy->schedules()->create($item);
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
        $data['days'] = ['SAT','SUN','MON','TUE','WED','THU','FRI'];

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

}
