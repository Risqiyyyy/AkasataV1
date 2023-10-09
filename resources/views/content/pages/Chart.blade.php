@extends('layouts/contentNavbarLayout')

@section('title', 'Chart')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
    <div class="input-group mb-3">  
        <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">SSH Login Failed</a></li>
            <li><a class="dropdown-item" href="#">Windows Multiple Logon</a></li>
        </ul>
      </div>
      <div id="sankey_chart"></div>
</div>
@endsection