<?php
namespace App\Repositories;

use App\Http\Requests\StoreCampaignRequest;
use App\Services\CampaignService;
use App\Interfaces\ICampaignRepositoryInterface;

class CampaignRepository implements ICampaignRepositoryInterface
{
    protected $campaignService;

    /**
     * CampaignRepository Constructer
     *
     * @param  CampaignService $campaignService
     * @return void
     */
    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

	/**
	 * Get All The Campaigns From Service
	 *
	 * @return array
	 */
	public function getAllCampaigns() : array
    {
		return $this->campaignService->getCampaigns();
	}

    /**
     * Store Campaign
     *
     * @param  StoreCampaignRequest $request
     * @return array
     */
    public function storeCampaign(StoreCampaignRequest $request) : array
    {
        return $this->campaignService->createCampaign($request);
    }
}