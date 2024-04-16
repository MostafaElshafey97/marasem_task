@if(session()->has('error'))
<div class="alert w-100 mb-0 mt-2 alert-warning alert-dismissible fade show">
    <h6 class="mb-0"><i class="icon fas fa-exclamation-triangle"></i> {{ trans('admin.alert') }}!</h6>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('success'))
<div class="alert w-100 mb-0 mt-2 alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger mt-2 mb-0">
    <ul class="list-unstyled">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif