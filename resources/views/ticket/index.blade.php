@extends('userlayout.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <body>
            @include('userlayout.navbar')
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Ticket List</h1>

                    <!-- Tombol Create -->
                    <div class="mb-3">
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Buat Tiket
                        </a>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Tickets
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Pesan</th>
                                        <th>Label</th>
                                        <th>Kategori</th>
                                        <th>Prioritas</th>
                                        <th>Lampiran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ticket as $ticket)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ticket->title }}</td>
                                            <td>{{ $ticket->message }}</td>
                                            <td>
                                                @foreach (json_decode($ticket->labels) as $label)
                                                    <span class="badge bg-primary">{{ $label }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach (json_decode($ticket->categories) as $category)
                                                    <span class="badge bg-secondary">{{ $category }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($ticket->priority === 'high')
                                                    <span class="badge bg-danger">High</span>
                                                @elseif ($ticket->priority === 'medium')
                                                    <span class="badge bg-warning">Medium</span>
                                                @else
                                                    <span class="badge bg-success">Low</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($ticket->attachment)
                                                    <a href="{{ url($ticket->attachment) }}" target="_blank">Lihat Lampiran</a>
                                                @else
                                                    Tidak Ada
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus tiket ini?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </body>

        @include('userlayout.footer')

    </div>
@endsection
