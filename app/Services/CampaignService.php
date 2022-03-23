<?php

namespace App\Services;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Campaign;

class CampaignService
{
    use HelperTrait;
    protected $campaign;

    /**
     * CampaignService Constructor
     *
     * @param  Campaign $campaign
     * @return void
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Get Campaigns In Descending Order From Database
     *
     * @return void
     */
    public function getCampaigns() : array
    {
        return $this->campaign->orderBy('created_at', 'desc')->get()->toArray();
    }

    /**
     * Get campaign by id
     *
     * @param  integer  $id
     * @return Campaign
     * @throws ModelNotFoundException
     */
    public function getDetails(int $id): Campaign
    {
        return $this->campaign->query()->findOrFail($id);
    }

    /**
     * Store Image & Create Campaign In DB
     *
     * @param  array $data
     * @return array
     */
    public function createCampaign(array $data) : array
    {

        return $this->campaign->query()->create($data)->toArray();
    }

    public function updateCampaign(array $data, $id) : array
    {
        $campaignDetails = $this->getDetails($id);
        foreach ($data as $index => $value) {
            $campaignDetails[$index] = $value;
        }
        $campaignDetails->save();
        return $campaignDetails->toArray();
    }
}