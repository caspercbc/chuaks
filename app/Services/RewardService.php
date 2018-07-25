<?php
namespace App\Services;

use App\Repositories\RewardRepository;
use App\Reward;

class RewardService
{
	private $rewardRepository;

	public function __construct(RewardRepository $rewardRepository)
	{
		$this->rewardRepository = $rewardRepository;
	}

	public function getReward(Reward $reward)
	{
		return $this->rewardRepository->getReward($user);
	}

	public function getRewards()
	{
		return $this->rewardRepository->getRewards();
	}

	public function addReward()
	{
		return $this->rewardRepository->addReward();
	}

	public function editReward(Reward $reward)
	{
		return $this->rewardRepository->editReward($reward);
	}

	public function deleteReward(Reward $reward)
	{
		return $this->rewardRepository->deleteReward($reward);
	}
}