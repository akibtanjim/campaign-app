@extends('layout')
@section('title')
    Campaigns
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2>Campaigns</h2>
        </div>
        <div class="col-md-6">
            <a href="{{ route('campaigns.create') }}" class="btn btn btn-primary rounded-4 float-end">Create</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="campaigns"></div>
    </div>
@endsection
