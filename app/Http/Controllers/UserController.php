<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }
    public function index(Request $request)
    {
        $users = $this->userService->listUsers($request->search);
        return view('user.list', compact('users'));
    }
    
    public function create()
    {  
        return view('user.add');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $this->userService->createUser($request->validated());
            session()->flash('success', 'User created successfully.');
            return response()->json(['redirect' => route('admin.users.index')]);
        } 
        catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function edit(int $id)
    {
        $user = $this->userService->userById($id);
        return view('user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        try {
            $user = $this->userService->userById($id);
            $this->userService->updateUser($user, $request->validated());
            session()->flash('success', 'User updated successfully.');
            return response()->json(['redirect' => route('admin.users.index')]);
        } 
        catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $user = $this->userService->userById($id);
            $this->userService->deleteUser($user);
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } 
        catch (\Throwable $e) {
            report($e);
            return redirect()->route('admin.users.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}