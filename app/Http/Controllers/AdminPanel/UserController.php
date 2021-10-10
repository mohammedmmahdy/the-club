<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\AppBaseController;
use App\Models\User;
use Flash;

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

    public function addMemberId(User $user)
    {
        $user->update([
            'member_id' => request('member_id'),
            'status'    => 2,
        ]);

        return back();
    }
}
