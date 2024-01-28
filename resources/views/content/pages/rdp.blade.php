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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('chart') }}"><button type="button" class="btn btn-primary mb-3">SSH</button></a>
        <a href="{{ route('rdp.index') }}"><button type="button" class="btn btn-primary mb-3">RDP</button></a>
        <a href="{{ route('ipfilter.index') }}"><button type="button" class="btn btn-primary mb-3">IP Filter</button></a>
      </div>
      <form action="{{ route('rdp.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="input-group mb-3">  
        <input type="file"  name="json_rdp" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
        <button type="submit" class="btn btn-secondary ">Upload</button>
      </div>
    </form>
    <a href="{{ route('getchart') }}"><button type="button" class="btn btn-primary mb-3">print</button></a>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div id="sankey_chart"></div>

      <script type="text/javascript">
            </script>
</div>
@endsection