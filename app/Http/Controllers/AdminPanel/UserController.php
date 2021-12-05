<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\AppBaseController;

class UserController extends AppBaseController
{

    public function index()
    {
        $users = User::all();

        return view('adminPanel.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));

            return redirect(route('adminPanel.users.index'));
        }

        return view('adminPanel.users.show', compact('user'));
    }

    // public function addMemberId(User $user)
    // {
    //     $user->update([
    //         'member_id' => request('member_id'),
    //         'status'    => 2,
    //     ]);

    //     return back();
    // }




    public function dateFilter()
    {
        $fromDate = (new Carbon(request('users_from')))->format('y-m-d G:i:s');
        $toDate = (new Carbon(request('users_to')))->format('y-m-d G:i:s');

        $usersQuery = User::query();
        if (request()->filled('users_from') || request()->filled('users_to')) {
            $usersQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }
        $users = $usersQuery->get();

        return view('adminPanel.users.index', compact('users'));
    }

}
