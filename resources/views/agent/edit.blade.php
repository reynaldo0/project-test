@extends('agent.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <body>
            @include('components.navbar')
            <div class="container-fluid px-4">
                <h1 class="mt-4">Edit Ticket</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-edit me-1"></i> Form Edit Ticket
                    </div>
                    <div class="card-body">
                        <form action="{{ route('agent.update', $id->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Title -->
                            <div class="form-group">
                                <label for="title">Judul Ticket:</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $id->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div class="form-group mt-3">
                                <label for="message">Pesan:</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message">{{ old('message', $id->message) }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Labels -->
                            <div class="form-group mt-3">
                                <label for="labels">Label:</label>
                                <div id="label-container">
                                    @foreach (json_decode($id->labels, true) as $label)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="labels[]"
                                                value="{{ $label }}" placeholder="Masukkan label">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-label">X</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" id="add-label">Tambah Label</button>
                                @error('labels')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Categories -->
                            <div class="form-group mt-3">
                                <label for="categories">Kategori:</label>
                                <div id="category-container">
                                    @foreach (json_decode($id->categories, true) as $category)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="categories[]"
                                                value="{{ $category }}" placeholder="Masukkan kategori">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-category">X</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" id="add-category">Tambah
                                    Kategori</button>
                                @error('categories')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Priority -->
                            <div class="form-group mt-3">
                                <label for="priority">Prioritas:</label>
                                <select class="form-control @error('priority') is-invalid @enderror" id="priority"
                                    name="priority">
                                    <option value="low" {{ old('priority', $id->priority) == 'low' ? 'selected' : '' }}>
                                        Low</option>
                                    <option value="medium"
                                        {{ old('priority', $id->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high"
                                        {{ old('priority', $id->priority) == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Attachment -->
                            <div class="form-group mt-3">
                                <label for="attachment">Lampiran:</label>
                                <input type="file" class="form-control @error('attachment') is-invalid @enderror"
                                    id="attachment" name="attachment">
                                <small class="text-muted">Lampiran saat ini: {{ $id->attachment }}</small>
                                @error('attachment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </div>


    <!-- JavaScript to manage dynamic fields -->
    <script>
        document.getElementById('add-label').addEventListener('click', function() {
            let container = document.getElementById('label-container');
            let newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-2');
            newInput.innerHTML = `
                <input type="text" class="form-control" name="labels[]" placeholder="Masukkan label">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-label">X</button>
                </div>
            `;
            container.appendChild(newInput);
        });

        document.getElementById('add-category').addEventListener('click', function() {
            let container = document.getElementById('category-container');
            let newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-2');
            newInput.innerHTML = `
                <input type="text" class="form-control" name="categories[]" placeholder="Masukkan kategori">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-category">X</button>
                </div>
            `;
            container.appendChild(newInput);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-label')) {
                e.target.closest('.input-group').remove();
            }
            if (e.target && e.target.classList.contains('remove-category')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endsection
