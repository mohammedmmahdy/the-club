<?php

namespace App\Http\Controllers\AdminPanel;

use Route;
use Flash;
use Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\RolesRepository;
use App\Http\Requests\AdminPanel\CreateRolesRequest;
use App\Http\Requests\AdminPanel\UpdateRolesRequest;


class RolesController extends AppBaseController
{
    /** @var  RolesRepository */
    private $rolesRepository;

    public function __construct(RolesRepository $rolesRepo)
    {
        $this->rolesRepository = $rolesRepo;
    }

    /**
     * Display a listing of the Roles.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = $this->rolesRepository->paginate(10);

        return view('adminPanel.roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Roles.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('page')->get();
        return view('adminPanel.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created Roles in storage.
     *
     * @param CreateRolesRequest $request
     *
     * @return Response
     */
    public function store(CreateRolesRequest $request)
    {

        $role = Role::create(['name' => request('name')]);

        $role->syncPermissions(request('permissions'));
        
        Flash::success(__('messages.saved', ['model' => __('models/roles.singular')]));

        return redirect(route('adminPanel.roles.index'));
    }

    /**
     * Display the specified Roles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roles = $this->rolesRepository->find($id);

        if (empty($roles)) {
            Flash::error(__('messages.cannot', ['model' => __('models/roles.singular')]));

            return redirect(route('adminPanel.roles.index'));
        }

        return view('adminPanel.roles.show')->with('roles', $roles);
    }

    /**
     * Show the form for editing the specified Roles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roles = Role::findOrFail($id);
        $permissions = Permission::orderBy('page')->get();
        if (empty($roles)) {
            Flash::error(__('messages.cannot', ['model' => __('models/roles.singular')]));

            return redirect(route('adminPanel.roles.index'));
        }

        return view('adminPanel.roles.edit', compact('roles', 'permissions'));
    }

    /**
     * Update the specified Roles in storage.
     *
     * @param int $id
     * @param UpdateRolesRequest $request
     *
     * @return Response
     */
    public function update(Role $role, UpdateRolesRequest $request)
    {
        
        $role->update(['name' => request('name')]);
        $role->syncPermissions(request('permissions'));

        if (empty($role)) {
            Flash::error(__('messages.cannot', ['model' => __('models/roles.singular')]));

            return redirect(route('adminPanel.roles.index'));
        }
        

        Flash::success(__('messages.updated', ['model' => __('models/roles.singular')]));

        return redirect(route('adminPanel.roles.index'));
    }

    /**
     * Remove the specified Roles from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Role $role)
    {
        if (empty($role) || $role->id == 1) {
            Flash::error(__('messages.cannot', ['model' => __('models/roles.singular')]));

            return redirect(route('adminPanel.roles.index'));
        }

        $role->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/roles.singular')]));

        return redirect(route('adminPanel.roles.index'));
    }

    public function updatePermissions(Request $request)
    {

        $collection = Route::getRoutes();

        $routes = [];
        $permissions = [];

        foreach ($collection as $route) {
            if ($route->getPrefix() == 'en/adminPanel') {
                $routeName = $route->getName();
                if ($routeName && !in_array($routeName, config('permission.excluded_routes'))) {
                    $routePartials = explode('.', $routeName);
                    // dd($routeName);
                    $page = $routePartials[1];
                    $action = $routePartials[2];

                    switch (true) {
                        case in_array($action, ['index', 'show']):
                            $permissions[$page . '_view'] = [
                                'page' => $page,
                                'action' => 'view',
                                'name' => $page . ' view'
                            ];
                            break;

                        case in_array($action, ['create', 'store']):
                            $permissions[$page . '_create'] = [
                                'page' => $page,
                                'action' => 'create',
                                'name' => $page . ' create'
                            ];
                            break;

                        case in_array($action, ['edit', 'update']):
                            $permissions[$page . '_edit'] = [
                                'page' => $page,
                                'action' => 'edit',
                                'name' => $page . ' edit'
                            ];
                            break;

                        case in_array($action, ['destory']):
                            $permissions[$page . '_delete'] = [
                                'page' => $page,
                                'action' => 'delete',
                                'name' => $page . ' delete'
                            ];
                            break;

                        default:
                            $permissions[$page . '_' . $action] = [
                                'page' => $page,
                                'action' => $action,
                                'name' => $page . ' ' . $action
                            ];
                            break;
                    }

                    $routes[] = $routeName;
                }
            }
        }

        foreach ($permissions as $permission) {
            Permission::createOnlyNew($permission);
        }

        Flash::success(__('messages.updated', ['model' => __('models/roles.singular')]));

        return back();
    }
}
