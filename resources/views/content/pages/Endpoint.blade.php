@extends('layouts/contentNavbarLayout')

@section('title', 'Endpoint')

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
      data-bs-whatever="@mdo">Add Endpoint +</button>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Case</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('endpoint.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <div class="row">
                <div class="col">
                  <label class="col-form-label">Hostname</label>
                  <input type="text" class="form-control" placeholder="Hostname" name="hostname" required>
                </div>
                <div class="col">
                  <label class="col-form-label">Regional</label>
                  <input type="text" class="form-control" name="regional" required>
                </div>
              </div>
            </div>
            {{-- <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label class="col-form-label">Object type</label>
                    <input type="text" class="form-control" placeholder="Object type" name="object_type" required>
                  </div>
                  <div class="col">
                    <label class="col-form-label">OS type</label>
                    <input type="text" class="form-control" name="os_type" required>
                  </div>
                </div>
              </div> --}}
            <label class="col-form-label">IP</label>
            <input type="text" class="form-control" name="ip" required>
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
  <!-- Search -->
  <form action="{{ route('endpoint.index') }}" method="get">
    <div class="navbar-nav align-items-center mb-3">
      <div class="nav-item d-flex align-items-center">
        <button><i class="bx bx-search fs-4 lh-0"></i></button>
        <input type="text" class="form-control border-0 shadow-none" name="search" placeholder="Search..."
          aria-label="Search...">
      </div>
    </div>
  </form>
  <!-- /Search -->
  <div class="container">
    <div class="card mb-3">
      <div class="table-responsive text-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>Hostname</th>
              <th>Regional</th>
              <th>IP</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($endpoint as $e)
            <tr>
              <td>{{ $e->hostname }}</td>
              <td>{{ $e->regional }}</td>
              <td>{{ $e->ip }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                      class="bx bx-dots-vertical-rounded"></i></button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bxs-bullseye me-1"></i> Detail</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bxs-edit-alt me-1"></i> Edit</a>
                    <form action="{{ route('endpoint.delete', $e->id) }}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <hr>
        <div class="pagination-center px-3">{{ $endpoint->links('pagination::bootstrap-5') }}</div>
      </div>
    </div>
  </div>


</div>
<script>
  var myModal = document.getElementById('myModal')
  var myInput = document.getElementById('myInput')

  myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
  })

</script>
@endsection
