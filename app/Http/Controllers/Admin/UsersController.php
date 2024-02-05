<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // index() - view the Admin: Users page
    public function index()
    {
        // withTrashed() - Include the soft deleted records in a quary's result
        $all_users = $this->user->withTrashed()->latest()->paginate(5);

        return view('admin.users.index')
                ->with('all_users', $all_users);
    }

    // deactivate()
    public function deactivate($id)
    {
        $this->user->destroy($id);
        return redirect()->back();
    }

    // activate()
    public function activate($id)
    {
        // onlyTrashed() - retrieves soft deleted records only.
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        // restore() - This will “un-delete” a soft deleted record. This will set the “deleted_at” column to null.

        return redirect()->back();
    }

}
