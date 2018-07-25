<?php
namespace App\Http\Controllers;

use App\Services\RewardService;

use App\Reward;

class RewardController extends Controller
{
	private $rewardService;

	public function __construct(RewardService $rewardService)
	{
		$this->rewardService = $rewardService;
	}

	public function reward(Reward $reward)
    {
    	return $this->rewardService->getReward($reward); 
    }

    public function index()
    {
    	return $this->rewardService->getRewards();
    }

    public function store()
    {
    	return $this->rewardService->addReward();
    }
    
    public function update(Reward $reward)
    {
    	return $this->rewardService->editReward($reward);
    }

    public function delete(Reward $reward)
    {
    	return $this->rewardService->deleteReward($reward);
    }
}
