<?php
namespace App\Http\Controllers;

use App\Services\UserService;
use App\User;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function user(User $user)
    {
        return $this->userService->getUser($user);
    }

    public function index()
    {
        return $this->userService->getUsers();
    }

    public function store()
    {
     	return $this->userService->addUser();
    }

    public function update(User $user)
    {
    	return $this->userService->editUser($user);
    }

    public function destroy(User $user)
    {
    	return $this->userService->deleteUser();
    }

    public function adjustPoint(User $user)
    {
        return $this->userService->adjustPoint($user);
    }

    public function editPoint(User $user)
    {
        return $this->userService->editPoint($user);
    }

    public function getPointTransactions(User $user)
    {
        return $this->userService->getPointTransactions($user);
    }

    public function getPtWithReward(User $user)
    {
        return $this->userService->getPtWithReward($user);
    }

    public function addUserWithPoint()
    {
        return $this->userService->addUserWithPoint();
    }
}
