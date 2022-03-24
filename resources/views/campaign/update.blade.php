@extends('layout')
@section('title')
    Update Campaign
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2>Update Campaign</h2>
        </div>
        <div class="col-md-6">
            <a href="{{ route('campaigns.list') }}" class="btn btn btn-primary rounded-4 float-end"><i class="fa fa-angle-left" aria-hidden="true"></i> Campaigns</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" data-id="{{ $id }}" id="update-campaign"></div>
    </div>
@endsection
