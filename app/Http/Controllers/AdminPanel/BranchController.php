<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateBranchRequest;
use App\Http\Requests\AdminPanel\UpdateBranchRequest;
use App\Repositories\AdminPanel\BranchRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Branch;
use Illuminate\Http\Request;
use Flash;
use Response;

class BranchController extends AppBaseController
{
    /** @var  BranchRepository */
    private $branchRepository;

    public function __construct(BranchRepository $branchRepo)
    {
        $this->branchRepository = $branchRepo;
    }

    /**
     * Display a listing of the Branch.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $branches = $this->branchRepository->all();

        return view('adminPanel.branches.index')
            ->with('branches', $branches);
    }

    /**
     * Show the form for creating a new Branch.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.branches.create');
    }

    /**
     * Store a newly created Branch in storage.
     *
     * @param CreateBranchRequest $request
     *
     * @return Response
     */
    public function store(CreateBranchRequest $request)
    {
        $input = $request->all();

        $branch = $this->branchRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/branches.singular')]));

        return redirect(route('adminPanel.branches.index'));
    }

    /**
     * Display the specified Branch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            Flash::error(__('messages.not_found', ['model' => __('models/branches.singular')]));

            return redirect(route('adminPanel.branches.index'));
        }

        return view('adminPanel.branches.show')->with('branch', $branch);
    }

    /**
     * Show the form for editing the specified Branch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            Flash::error(__('messages.not_found', ['model' => __('models/branches.singular')]));

            return redirect(route('adminPanel.branches.index'));
        }

        return view('adminPanel.branches.edit')->with('branch', $branch);
    }

    /**
     * Update the specified Branch in storage.
     *
     * @param int $id
     * @param UpdateBranchRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBranchRequest $request)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            Flash::error(__('messages.not_found', ['model' => __('models/branches.singular')]));

            return redirect(route('adminPanel.branches.index'));
        }

        $branch = $this->branchRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/branches.singular')]));

        return redirect(route('adminPanel.branches.index'));
    }

    /**
     * Remove the specified Branch from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            Flash::error(__('messages.not_found', ['model' => __('models/branches.singular')]));

            return redirect(route('adminPanel.branches.index'));
        }

        $this->branchRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/branches.singular')]));

        return redirect(route('adminPanel.branches.index'));
    }
}
