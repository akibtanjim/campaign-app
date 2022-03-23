<?php

namespace App\Services;

use App\Http\Requests\StoreCampaignRequest;
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
     * Store Image & Create Campaign In DB
     *
     * @param  StoreCampaignRequest $request
     * @return array
     */
    public function createCampaign(StoreCampaignRequest $request) : array
    {
        $images = $this->storeImage($request->file('creative_upload'), 'campaigns');
        return $this->campaign->query()->create($this->processData([...$request->validated(), 'creative_upload' => $images]))->toArray();
    }

    /**
     * Processed Data For Create & Update Campaign
     *
     * @param  array $data
     * @return array
     */
    private function processData(array $data): array
    {
        return [
            'name' => $data['name'],
            'from_date' => $data['from_date'],
            'to_date' => $data['to_date'],
            'total_budget' => $data['total_budget'],
            'daily_budget' => $data['daily_budget'],
            'creative_upload' => $data['creative_upload']
        ];
    }
}