<?php

namespace App\Services;

use App\Repositories\CampaignRepository;

class CampaignService
{
    protected $campaignRepository;

    /**
     * CampaignService Constructor
     *
     * @param  CampaignRepository $campaignRepository
     * @return void
     */
    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * Get Campaigns For Repository
     *
     * @return void
     */
    public function getCampaigns() : array
    {
        return $this->campaignRepository->getAllCampaigns();
    }
}