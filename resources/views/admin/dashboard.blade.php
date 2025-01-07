@extends('admin.layouts.app') <!-- Menggunakan layout userlayout -->

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    @include('components.navbar')
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <p>Selamat datang di dashboard admin.</p>
</div>
</div>
@endsection
