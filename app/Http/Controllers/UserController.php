<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Organization;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $userService;
    
    public function __construct(UserService $userService){   
        $this->userService = $userService;
    }
    public function index(){

        $users = $this->userService->selectAllUserService();
         return view('sidebar_links.users.users', ['users' => $users]);
    }
    public function createUser(){

        $organizations = Organization::all();
        
        return view('sidebar_links.users.user-form', ['user' => [], 'organizations' => $organizations]);
    }
    public function storeUser(StoreUserRequest $storeUserRequest){
        
        $validatedStoreUserRequest = $storeUserRequest->validated();
        $validatedStoreUserRequest['password'] = Hash::make($validatedStoreUserRequest['password']);
        
        $this->userService->storeUserService($validatedStoreUserRequest);
        return redirect()->back()->with('success', 'User created successfully!');
    }
    public function editUser($id){
        
        $user = $this->userService->editUserService($id);
        return view('sidebar_links.users.user-form', ['user' => $user, 'organizations' => Organization::all()]);
    }
    public function updateUser($id, UpdateUserRequest $updateUserRequest){
        
        $validatedUpdateUserRequest = $updateUserRequest->validated();
        $this->userService->updateUserService($id, $validatedUpdateUserRequest);

        return redirect()->back()->with('success', 'User updated successfully!');
    }
    public function destroyUser($id){
    
        $this->userService->destroyUserService($id);
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
