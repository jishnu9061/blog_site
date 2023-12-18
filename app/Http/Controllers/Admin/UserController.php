<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use Toastr;

class UserController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('user');
        $this->addBaseRoute('user');
    }

    public function index(Request $request)
    {
        $path = $this->getView('index');
        $para = [];
        $title = 'Users';

        return $this->renderView($path, $para, $title);
    }

    public function create()
    {
        $path = $this->getView('create');
        $para = [];
        $title = 'Create User';

        return $this->renderView($path, $para, $title);
    }

    public function store(UserStoreRequest $request)
    {
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country' => $request->country,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
        ]);

        Toastr::success('User Created Successfully');

        return redirect()->route($this->getRoute('index'));
    }

    public function show($id)
    {
        $this->addBreadcrumb([
            'user' => route($this->getRoute('index')),
            'View' => null,
        ]);

        $userDetails = User::where('id', $id)->first();

        if (is_null($userDetails)) {
            return abort(404);
        }

        $path = $this->getView('view');
        $para = compact('userDetails');
        $title = 'User Info';

        return $this->renderView($path, $para, $title);
    }

    public function edit(User $user)
    {
        $this->addBreadcrumb([
            'user' => route($this->getRoute('index')),
            'Edit' => null,
        ]);

        $path = $this->getView('edit');
        $para = compact('user');
        $title = 'Edit User';

        return $this->renderView($path, $para, $title);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country' => $request->country,
            'mobile' => $request->mobile,
            'status'=> $request->status,
        ]);

        Toastr::success('User Updated Successfully');

        return redirect()->route($this->getRoute('index'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return Response::json(['success' => 'User Deleted Successfully']);
    }

    public function getData()
    {
        try {
            $data = User::all();

            return response()->json($data);

        } catch (\Exception $e) {
            // Log the exception
            \Log::error($e);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function notification($id)
    {
        $this->addBreadcrumb([
            'user' => route($this->getRoute('index')),
            'notification' => null,
        ]);

        $userDetails = User::where('id', $id)->first();

        $path = $this->getView('notification');
        $para = compact('userDetails');
        $title = 'Notification';

        return $this->renderView($path, $para, $title);
    }
}
?>
