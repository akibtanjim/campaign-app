<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CampaignController extends Controller
{
    /**
     * Campaign List Page
     *
     * @return View
     */
    public function index()
    {
        return view('campaign.list');
    }

    /**
     * Campaign Create Page
     *
     * @return View
     */
    public function create()
    {
       return view('campaign.create');
    }

    /**
     * Campaign Edit Page
     *
     * @param  int $id
     * @return View
     */
    public function edit(int $id)
    {
        return view('campaign.update', compact('id'));
    }
}