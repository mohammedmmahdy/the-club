<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateAdminRequest;
use App\Http\Requests\AdminPanel\UpdateAdminRequest;
use App\Repositories\AdminPanel\AdminRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AdminController extends AppBaseController
{
    /** @var  AdminRepository */
    private $adminRepository;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

    /**
     * Display a listing of the Admin.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $admins = $this->adminRepository->paginate(10);

        return view('adminPanel.admins.index')
            ->with('admins', $admins);
    }

    /**
     * Show the form for creating a new Admin.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.admins.create');
    }

    /**
     * Store a newly created Admin in storage.
     *
     * @param CreateAdminRequest $request
     *
     * @return Response
     */
    public function store(CreateAdminRequest $request)
    {
        $input = $request->all();
        $admin = $this->adminRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/admins.singular')]));

        return redirect(route('adminPanel.admins.index'));
    }

    /**
     * Display the specified Admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/admins.singular')]));

            return redirect(route('adminPanel.admins.index'));
        }

        return view('adminPanel.admins.show')->with('admin', $admin);
    }

    /**
     * Show the form for editing the specified Admin.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/admins.singular')]));

            return redirect(route('adminPanel.admins.index'));
        }

        return view('adminPanel.admins.edit')->with('admin', $admin);
    }

    /**
     * Update the specified Admin in storage.
     *
     * @param int $id
     * @param UpdateAdminRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdminRequest $request)
    {
        dd($request->all());
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/admins.singular')]));

            return redirect(route('adminPanel.admins.index'));
        }

        $admin = $this->adminRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/admins.singular')]));

        return redirect(route('adminPanel.admins.index'));
    }

    /**
     * Remove the specified Admin from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/admins.singular')]));

            return redirect(route('adminPanel.admins.index'));
        }

        $this->adminRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/admins.singular')]));

        return redirect(route('adminPanel.admins.index'));
    }
}
