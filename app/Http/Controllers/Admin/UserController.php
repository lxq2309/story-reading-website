<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreBanUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateBanUserRequest;
use App\Http\Requests\Admin\User\UpdateRoleUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\BannedUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query();
        $users = $this->filter($request, $users);
        return $this->renderUserView($users, 'Tất cả tài khoản');
    }

    public function showAdmins(Request $request)
    {
        $admins = User::getAdmins();
        $admins = $this->filter($request, $admins);
        return $this->renderUserView($admins, 'Tài khoản quản trị viên');
    }

    public function showPosters(Request $request)
    {
        $admins = User::getPosters();
        $admins = $this->filter($request, $admins);
        return $this->renderUserView($admins, 'Tài khoản người đăng bài');
    }

    public function showBanneds(Request $request)
    {
        $banneds = User::getBanneds();
        $banneds = $this->filter($request, $banneds);
        return $this->renderUserView($banneds, 'Tài khoản bị cấm');
    }

    private function renderUserView($users, $title)
    {
        return view('admin.users.index',
            ['users' => $users, 'title' => $title]);
    }


    public function filter(Request $request, $users)
    {
        $users = $users->orderByDesc("id");
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $users->where('name', 'like', '%'.$searchText.'%');
        }

        $users = $users->paginate();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function editRole(User $user)
    {
        return view('admin.users.edit-role', ['user' => $user]);
    }

    public function updateRole(UpdateRoleUserRequest $request, User $user)
    {
        $request->validated();
        $user->role = $request->role;
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'Cập nhật vai trò thành công!');
    }

    public function createBan(User $user)
    {
        return view('admin.users.create-ban', ['user' => $user]);
    }

    public function storeBan(StoreBanUserRequest $request, User $user)
    {
        $request->validated();
        $bannedUser = new BannedUser();
        $bannedUser->user_id = $user->id;
        $bannedUser->admin_id = Auth::user()->getAuthIdentifier();
        $bannedUser->reason = $request->reason;
        $bannedUser->expired_at = now()->addDays($request->ban_days);
        $bannedUser->save();
        // Bắt buộc người dùng phải đăng nhập lại
        $user->setShouldReLogin(true);
        return redirect()->route('admin.users.index')
            ->with('success', 'Cấm tài khoảnt thành công!');
    }

    public function editBan(User $user)
    {
        return view('admin.users.edit-ban', ['user' => $user]);
    }

    public function updateBan(UpdateBanUserRequest $request, User $user)
    {
        $request->validated();
        $bannedUser = $user->banned;
        $bannedUser->reason = $request->reason;
        $bannedUser->save();
        // Bắt buộc người dùng phải đăng nhập lại
        $user->setShouldReLogin(true);
        return redirect()->route('admin.users.banned')
            ->with('success', 'Sửa lý do cấm thành công!');
    }

    public function unban(User $user)
    {
        $bannedUser = $user->banned;
        $bannedUser->delete();
        // Bắt buộc người dùng phải đăng nhập lại
        $user->setShouldReLogin(true);
        return redirect()->route('admin.users.banned')
            ->with('success', 'Bỏ cấm thành công!');
    }
}
