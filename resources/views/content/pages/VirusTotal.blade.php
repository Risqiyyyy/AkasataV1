@extends('layouts/contentNavbarLayout')

@section('title', 'VirusTotal')

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
  {{-- modal --}}
  <div class="d-grid gap-2 d-md-block">
    <h2>Virus Total</h2>
  </div>
  {{-- end modal --}}

  <div class="card">
    <form action="{{ route('vtotal.iphash') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="input-group">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
          aria-expanded="false">
          Select Type
        </button>
        <ul class="dropdown-menu">
          <li><button type="submit" class="dropdown-item" name="type" value="ip">IP</button></li>
          <li><button type="submit" class="dropdown-item" name="type" value="hash">Hash</button></li>
        </ul>
        <input type="text" class="form-control" name="input" aria-label="Text input with segmented dropdown button">
      </div>
    </form>
  </div>
  @if(isset($result))
  @if(isset($result['error']))
  <div class="alert alert-danger" role="alert">
    {{ $result['error'] }}
  </div>
  @elseif(isset($result['data']))
  <pre>{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
  @else
  
  @endif
  @else
  @endif
</div>
</div>
@endsection
