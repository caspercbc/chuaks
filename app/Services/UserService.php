<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\PointRepository;

use App\User;

class UserService
{
	private $userRepository;
	private $pointRepository;

	public function __construct(UserRepository $userRepository, PointRepository $pointRepository) 
	{
		$this->userRepository = $userRepository;
		$this->pointRepository = $pointRepository;
	}

	public function getUser(User $user)
	{
		return $this->userRepository->getUser($user);
	}

	public function getUsers()
	{
		return $this->userRepository->getUsers();
	}

	public function addUser()
	{
		return $this->userRepository->addUser();
	}

	public function editUser(User $user)
	{
		$changePassword = true;
		if( empty($user->password) ){
			$changePassword = false;
		}

		return $this->userRepository->editUser($user, $changePassword);
	}

	public function deleteUser(User $user)
	{
		return $this->userRepository->deleteUser($user);
	}



	// Add user with point
	public function addUserWithPoint()
	{
		return $this->userRepository->addUserWithPoint();
	}

	// Points
	public function adjustPoint(User $user)
	{
		return $this->pointRepository->adjustUserPoint($user);
	}

	public function editPoint(User $user)
	{
		return $this->pointRepository->editUserPoint($user);
	}

	public function getPointTransactions(User $user)
	{
		return $this->pointRepository->getUserPointTransactions($user);
	}

	public function getPtWithReward(User $user)
	{
		return $this->pointRepository->getUserPtWithReward($user);
	}
}
