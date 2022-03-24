@extends('layout')
@section('title')
    Create Campaign
@endsection
@section('content')
    <div class="row mb-6">
        <div class="col-md-6">
            <h2>Create Campaign</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('campaigns.list') }}" class="btn btn btn-primary rounded-4 float-end"><i class="fa fa-angle-left" aria-hidden="true"></i> Campaigns</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="create-campaign"></div>
    </div>
@endsection
