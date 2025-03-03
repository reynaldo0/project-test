@extends('ticket.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <body>
            @include('components.navbar')
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Ticket List</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i> Data Tickets
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
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
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
                                                    <a href="#" class="view-image" data-bs-toggle="modal"
                                                        data-bs-target="#imageModal"
                                                        data-image="{{ asset('uploads/' . $ticket->attachment) }}">Lihat
                                                        Lampiran</a>
                                                @else
                                                    Tidak Ada
                                                @endif
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

        @include('components.footer')

    </div>

    <!-- Modal for Viewing Image -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Lampiran Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Lampiran" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Handle the Image Modal -->
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('imageModal'), {
            keyboard: false
        });

        document.querySelectorAll('.view-image').forEach(function(element) {
            element.addEventListener('click', function(e) {
                var imageUrl = e.target.getAttribute('data-image');
                document.getElementById('modalImage').src = imageUrl;
                myModal.show();
            });
        });
    </script>
@endsection