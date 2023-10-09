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
      data-bs-whatever="@mdo">Create Case +</button>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Case</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
            @csrf
            <div class="mb-3">
              <div class="row">
                <div class="col">
                  <label class="col-form-label">Title</label>
                  <input type="text" class="form-control" placeholder="Case Title" name="title" required>
                </div>
                <div class="col">
                  <label class="col-form-label">Date</label>
                  <input type="date" class="form-control" name="date" required>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col">
                  <label class="col-form-label">Saverity</label>
                  <div class="mb-3">
                    <input type='button' value='Low' class="btn btn-outline-secondary btn-sm mx-1">
                    <input type='button' value='Medium' class="btn btn-outline-info btn-sm mx-1">
                    <input type='button' value='High' class="btn btn-outline-warning btn-sm mx-1">
                    <input type='button' value='Critical' class="btn btn-outline-danger btn-sm mx-1">
                  </div>
                </div>
                <div class="col">
                  <label class="col-form-label">PAP</label>
                  <div class="mb-3">
                    <input type='button' value='Clear' class="btn btn-outline-secondary btn-sm mx-1">
                    <input type='button' value='Green' class="btn btn-outline-success btn-sm mx-1">
                    <input type='button' value='Amber' class="btn btn-outline-warning btn-sm mx-1">
                    <input type='button' value='Red' class="btn btn-outline-danger btn-sm mx-1">
                  </div>
                </div>
              </div>
            </div>
            <label class="col-form-label">TLP</label>
            <div class="mb-3">
              <input type='button' value='Clear' class="btn btn-outline-secondary btn-sm mx-1">
              <input type='button' value='Green' class="btn btn-outline-success btn-sm mx-1">
              <input type='button' value='Amber' class="btn btn-outline-warning btn-sm mx-1">
              <input type='button' value='Amber Strict' class="btn btn-outline-warning btn-sm mx-1">
              <input type='button' value='Red' class="btn btn-outline-danger btn-sm mx-1">
            </div>
            <label class="col-form-label">Tags</label>
            <input type="text" class="form-control" placeholder="Tags" name="tags">
            <label class="col-form-label">Deskripsi</label>
            <textarea class="form-control" rows="3"></textarea>
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

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Tilte</th>
            <th>Date</th>
            <th>Saverity</th>
            <th>PAP</th>
            <th>TLP</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <tr>
            <td>APT Network Traffic Detection (inbound request)</td>
            <td>20/10/23</td>
            <td><span class="badge bg-label-danger me-1">Critical</span></td>
            <td><span class="badge bg-label-danger me-1">Red</span></td>
            <td><span class="badge bg-label-danger me-1">Red</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bxs-bullseye me-1"></i> Detail</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-x me-1"></i> close case</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bxs-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>React Project</strong></td>
            <td>Barry Hunter</td>
            <td>
              <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                  <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                  <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                  <img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle">
                </li>
              </ul>
            </td>
            <td><span class="badge bg-label-success me-1">Completed</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><i class="fab fa-vuejs fa-lg text-success me-3"></i> <strong>VueJs Project</strong></td>
            <td>Trevor Baker</td>
            <td>
              <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                  <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                  <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                  <img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle">
                </li>
              </ul>
            </td>
            <td><span class="badge bg-label-info me-1">Scheduled</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>Bootstrap Project</strong></td>
            <td>Jerry Milton</td>
            <td>
              <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Lilian Fuller">
                  <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                  <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle">
                </li>
                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="Christina Parker">
                  <img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle">
                </li>
              </ul>
            </td>
            <td><span class="badge bg-label-warning me-1">Pending</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
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
