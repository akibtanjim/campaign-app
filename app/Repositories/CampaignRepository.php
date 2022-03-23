<?php
namespace App\Repositories;

use App\Models\Campaign;

class CampaignRepository
{
    protected $campaign;

    /**
     * CampaignRepository Constructer
     *
     * @param  Campaign  $campaign
     * @return void
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

	/**
	 * Get All The Campaigns In Descending Order From Database
	 *
	 * @return array
	 */
	public function getAllCampaigns() : array
    {
		return Campaign::orderBy('created_at', 'desc')->get()->toArray();
	}

}