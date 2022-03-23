<?php
namespace App\Repositories;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Http\Traits\HelperTrait;
use App\Services\CampaignService;
use App\Interfaces\ICampaignRepositoryInterface;
use App\Models\Campaign;

class CampaignRepository implements ICampaignRepositoryInterface
{
    use HelperTrait;
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
	 * Get Campaign By Id From Service
	 *
	 * @return array
	 */
	public function getCampaign(int $id) : array
    {
		return $this->campaignService->getDetails($id)->toArray();
	}

    /**
     * Store Campaign
     *
     * @param  StoreCampaignRequest $request
     * @return array
     */
    public function storeCampaign(StoreCampaignRequest $request) : array
    {
        $images = $this->storeImage($request->file('creative_upload'), 'campaigns');
        return $this->campaignService->createCampaign($this->processData([...$request->validated(), 'creative_upload' => $images]));
    }

    public function modifyCampaign(UpdateCampaignRequest $request, int $id) : array
    {
        $campaign = $this->campaignService->getDetails($id);
        $images = $request->file('creative_upload') ? $this->storeImage($request->file('creative_upload'), 'campaigns') : $campaign->creative_upload;
        $updatedCampaign = $this->campaignService->updateCampaign($this->processData([...$request->validated(), 'creative_upload' => $images]), $id);
        if (empty($updatedCampaign)) {
            $prevImages = $campaign->creative_upload;
            $this->deleteImage($prevImages);
        }
        return $updatedCampaign;
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