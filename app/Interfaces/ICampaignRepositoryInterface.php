<?php
namespace App\Interfaces;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;

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
     * @param  StoreCampaignRequest $request
     * @return array
     */
    public function storeCampaign(StoreCampaignRequest $request) : array;

    /**
     * Update Campaign Item Interface Method
     *
     * @param  UpdateCampaignRequest $request
     * @return array
     */
    public function modifyCampaign(UpdateCampaignRequest $request, int $id) : array;

     /**
     * Update Campaign Item Interface Method
     *
     * @param  UpdateCampaignRequest $request
     * @return array
     */
    public function getCampaign(int $id) : array;
}