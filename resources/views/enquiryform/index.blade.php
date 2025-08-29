@extends('layouts.app')

@section('title', 'Enquiry Forms')

@section('content')
<!-- Header -->
<div class="header bg-wlis pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Enquiry Forms</h6>
        </div>
        <div class="col-lg-6 col-5 text-end">
          <a href="{{ route('dashboard') }}" class="btn btn-sm btn-neutral">
            <i class="fas fa-chevron-left"></i> Back To Dashboard
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="row mt-4">
  <div class="col">
    <div class="card" id="documentCard">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="text-primary font-weight-600 mb-0">Enquiry Forms</h3>
        <a href="{{ route('enquiryform.create') }}" class="btn btn-sm btn-primary">
          <i class="fas fa-plus"></i> Add new form
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-border table-striped" id="invoice_table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Name</th>
                <th>Hits</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($forms as $bank)
              <tr>
                <td>{{ $bank->title }}</td>
                <td>{{ $bank->name }}</td>
                <td>{{ $bank->hits }}</td>
                <td>
                  <a href="{{ route('enquiryform.display', $bank->uuid) }}" target="_blank" class="btn btn-primary btn-sm">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="{{ route('enquiryform.edit', $bank->id) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-pencil"></i>
                  </a>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="mt-3">
            {{ $forms->links() }}
          </div>
        </div>
      </div>
      <div class="card-footer text-end">
        <a href="{{ route('enquiryform.create') }}" class="btn btn-sm btn-primary">
          <i class="fas fa-plus"></i> Create new form
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div id="delete_bank" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100">Are you sure?</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST">
        @csrf
        @method("DELETE")
        <div class="modal-body">
          <input id="data_id" name="id" type="hidden">
          <p>Do you really want to delete this form? This process cannot be undone.</p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-danger" value="Delete">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('delete_bank');
    deleteModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const docId = button.getAttribute('data-id');
      const input = deleteModal.querySelector('#data_id');
      input.value = docId;
    });
  });
</script>
@endsection
