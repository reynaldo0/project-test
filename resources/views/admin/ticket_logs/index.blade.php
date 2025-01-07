@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <body>
            @include('components.navbar')
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Ticket Logs</h1>

                </div>
            </main>
        </body>
        <!-- Tabel Log Ticket -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Daftar Ticket</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul Ticket</th>
                            <th>Dibuat Oleh</th>
                            <th>Tanggal Dibuat</th>
                            <th>Assign To</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ticket->title }}</td>
                                <td>{{ $ticket->user->name ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('tickets.assign', $ticket->id) }}">
                                        @csrf
                                        <select name="agent_id" class="form-select form-select-sm"
                                            onchange="this.form.submit()">
                                            <option value="" selected>Pilih Agen</option>
                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->id }}"
                                                    {{ $ticket->agent_id == $agent->id ? 'selected' : '' }}>
                                                    {{ $agent->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary view-details-btn" data-bs-toggle="modal"
                                        data-bs-target="#ticketDetailsModal" data-ticket-id="{{ $ticket->id }}">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('components.footer')
    </div>

    <!-- Modal untuk Melihat Detail Ticket -->
    <div class="modal fade" id="ticketDetailsModal" tabindex="-1" aria-labelledby="ticketDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticketDetailsModalLabel">Detail Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="ticketDetails">
                        <!-- Konten detail tiket akan diisi dengan JavaScript -->
                        <p>Memuat detail tiket...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- JavaScript untuk Menangani Modal Detail Ticket -->
    <script>
        document.querySelectorAll('.view-details-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const ticketId = button.getAttribute('data-ticket-id');
                const ticketDetailsContainer = document.getElementById('ticketDetails');

                // Tampilkan loading sementara
                ticketDetailsContainer.innerHTML = '<p>Memuat detail tiket...</p>';

                // Fetch data detail tiket menggunakan AJAX
                fetch(`/tickets/${ticketId}/details`)
                    .then(response => response.json())
                    .then(data => {
                        // Isi modal dengan data tiket
                        ticketDetailsContainer.innerHTML = `
                    <h5>Judul Ticket: ${data.title}</h5>
                    <p><strong>Dibuat Oleh:</strong> ${data.user.name}</p>
                    <p><strong>Tanggal Dibuat:</strong> ${data.created_at}</p>
                    <p><strong>Status:</strong> ${data.status}</p>
                    <p><strong>Ditugaskan Kepada:</strong> ${data.assigned_to ? data.assigned_to.name : 'Belum Ditugaskan'}</p>
                    <form action="/tickets/${data.id}/assign" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="assigned_to">Assign ke Agen</label>
                            <select name="assigned_to" id="assigned_to" class="form-control">
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}" 
                                        ${data.assigned_to && data.assigned_to.id === agent.id ? 'selected' : ''}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Tugaskan</button>
                    </form>
                `;
                    })
                    .catch(error => {
                        ticketDetailsContainer.innerHTML = '<p>Gagal memuat detail tiket.</p>';
                        console.error(error);
                    });
            });
        });
    </script>
@endsection
