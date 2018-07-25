<?php
namespace App\Http\Controllers;

use App\Services\PointService;

use App\PointTransaction;
use App\User;

class PointTransactionController extends Controller
{   
    private $pointService;

    public function __construct(PointService $pointService)
    {
        $this->pointService = $pointService;
    }
	
    public function index()
    {
        return $this->pointService->getPointTransactions(); 
    }

    public function store()
    {
        return $this->pointService->addPointTransaction();
    }

    public function update(PointTransaction $point)
    {
    	return $this->pointService->editPointTransaction($point);
    }

    public function destroy(PointTransaction $point)
    {
        return $this->pointService->destroyPointTransaction($point);
    }

}
