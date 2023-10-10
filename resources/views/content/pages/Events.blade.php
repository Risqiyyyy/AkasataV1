@extends('layouts/contentNavbarLayout')

@section('title', 'Cases')

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
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"
      data-bs-whatever="@mdo">Create Events +</button>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Events</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="col-form-label">Title</label>
            <input type="text" class="form-control" placeholder="Events title" name="title">
            <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label class="col-form-label">Hostname</label>
                    <input type="text" class="form-control" placeholder="Hostname" name="hostname">
                  </div>
                  <div class="col">
                    <label class="col-form-label">Tags</label>
                    <input type="text" class="form-control" placeholder="Tags" name="tags">
                    </div>
                </div>
              </div>
            <div class="mb-3">
              <div class="row">
                <div class="col">
                  <label class="col-form-label">Destination Ip</label>
                  <input type="text" class="form-control" placeholder="Destination Ip" name="dst">
                </div>
                <div class="col">
                    <label class="col-form-label">Source Ip</label>
                    <input type="text" class="form-control" placeholder="Source Ip" name="src">
                  </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label class="col-form-label">uuid</label>
                    <input type="text" class="form-control" placeholder="uuid" name="uuid">
                  </div>
                  <div class="col">
                    <label class="col-form-label">Date Time</label>
                    <input type="datetime-local" class="form-control" name="date_time">
                    </div>
                </div>
              </div>
            </div>
            <label class="col-form-label">Image</label>
            <input type="file" class="form-control" name="image" aria-describedby="inputGroupFileAddon03">
            <label class="col-form-label">Deskripsi</label>
            <textarea class="form-control" rows="3" name="deskripsi"></textarea>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- detail modal --}}
  <div class="modal fade" id="detailmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Events</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
            @csrf
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- end modal --}}
  
  {{-- card --}}
  <div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($events as $e)
    <div class="col">
      <div class="card h-80">
        <img src="{{ asset('image/' . $e->image) }}" class="card-img-top" style="width: 100%;" alt="image">
        <div class="card-body">
            <h5 class="card-title">{{ $e->title }}</h5>
            <div class="dropdown d-flex justify-content-end">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);" type="button" data-bs-toggle="modal" data-bs-target="#detailmodal"
                data-bs-whatever="@mdo"><i class="bx bxs-bullseye me-1"></i> Detail</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bxs-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
            <div style="width: 18rem;">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Hostname : {{ $e->hostname }}</li>
                  <li class="list-group-item">Destination ip : {{ $e->dst }}</li>
                  <li class="list-group-item">Source ip : {{ $e->src }}</li>
                  <li class="list-group-item">Uuid : {{ $e->uuid }}</li>
                  <li class="list-group-item">Date Time : {{ $e->date_time }}</li>
                </ul>
            </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
      {{--end  --}}
</div>
<script>
  var myModal = document.getElementById('myModal')
  var myInput = document.getElementById('myInput')

  myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
  })
</script>
@endsection
