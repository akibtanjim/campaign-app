<?php
namespace App\Interfaces;

use App\Http\Requests\StoreCampaignRequest;

interface ICampaignRepositoryInterface{

	/**
	 * Campaign List Items Interface Method
	 *
	 * @return array
	 */
	public function getAllCampaigns() : array;

    /**
     * Campaign Create Item Interface Method
     *
     * @param  mixed $request
     * @return array
     */
    public function storeCampaign(StoreCampaignRequest $request) : array;
}