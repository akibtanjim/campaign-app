<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Traits\HelperTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignRequest;
use App\Interfaces\ICampaignRepositoryInterface;

class CampaignController extends Controller
{
    use HelperTrait;

    protected $campaignRepository;

    public function __construct(ICampaignRepositoryInterface $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->successResponseHandler($this->campaignRepository->getAllCampaigns(), 'Campaign List Fetched Successfully');
        } catch (\Exception $error) {
            Log::error($error);
            return $this->customErrorResponse('Internal Error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaignRequest $request) : JsonResponse
    {
        try {
            return $this->successResponseHandler($this->campaignRepository->storeCampaign($request), 'Campaign Created Successfully');
        } catch (\Exception $error) {
            Log::error($error);
            return $this->customErrorResponse('Internal Error', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}