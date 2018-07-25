<?php
namespace App\Services;

use App\Repositories\PointRepository;
use App\PointTransaction;

class PointService
{
	private $pointRepository;

	public function __construct(PointRepository $pointRepository) 
	{
		$this->pointRepository = $pointRepository;
	}

	public function getPointTransactions()
	{
		return $this->pointRepository->getPointTransactions();
	}

	public function addPointTransaction()
	{
		return $this->pointRepository->addPointTransaction();
	}

	public function editPointTransaction(PointTransaction $point)
	{
		return $this->pointRepository->editPointTransaction($point);
	}

	public function destroyPointTransaction(PointTransaction $point)
	{
		return $this->pointRepository->destroyPointTransaction($point);
	}

}
