@extends('ticket.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <body>
            @include('components.navbar')
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Ticket List</h1>

                    <!-- Row untuk Box Jumlah Tiket dan Tombol Buat Tiket -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="card d-flex flex-column justify-content-between" style="height: 150px;">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Tiket</h5>
                                    <h2>{{ $ticketCount }}</h2>
                                </div>
                                <!-- Tombol Buat Tiket di bagian bawah kanan -->
                                <div class="card-footer text-end">
                                    <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Buat Tiket
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </body>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection