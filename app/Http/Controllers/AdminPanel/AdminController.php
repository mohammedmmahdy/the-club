<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateAdminRequest;
use App\Http\Requests\AdminPanel\UpdateAdminRequest;
use App\Repositories\AdminPanel\AdminRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Spatie\Permission\Models\Role;
use App\Models\Admin;


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
        $admins = $this->adminRepository->allQuery($request->all())->paginate(10);

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
        $roles = Role::pluck('name', 'id');
        return view('adminPanel.admins.create', compact('roles'));
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
        // return $request;
        $admin = $this->adminRepository->create($request->all());

        $admin->syncRoles([request('role')]);

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

        return view('adminPanel.admins.show', compact('admin'));
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
        // $admin = $this->adminRepository->find($id);
        $admin = Admin::where('id', $id)->with('roles')->first();

        $roles = Role::pluck('name', 'id');
        if (empty($admin)) {
            Flash::error(__('messages.not_found', ['model' => __('models/admins.singular')]));

            return redirect(route('adminPanel.admins.index'));
        }

        return view('adminPanel.admins.edit', compact('admin','roles'));
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
        $admin = $this->adminRepository->find($id);
        $admin->syncRoles([request('role')]);

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

