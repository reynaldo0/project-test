@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Ticket</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-plus me-1"></i> Form Tambah Ticket
            </div>
            <div class="card-body">
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Judul Ticket:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div class="form-group mt-3">
                        <label for="message">Pesan:</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Labels -->
                    <div class="form-group mt-3">
                        <label for="labels">Label:</label>
                        <div id="label-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="labels[]" placeholder="Masukkan label">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger remove-label">X</button>
                                </div>
                            </div>
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
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="categories[]"
                                    placeholder="Masukkan kategori">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger remove-category">X</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="add-category">Tambah Kategori</button>
                        @error('categories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div class="form-group mt-3">
                        <label for="priority">Prioritas:</label>
                        <select class="form-control @error('priority') is-invalid @enderror" id="priority" name="priority">
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Attachment -->
                    <div class="form-group mt-3">
                        <label for="attachment">Lampiran:</label>
                        <input type="file" class="form-control @error('attachment') is-invalid @enderror" id="attachment"
                            name="attachment">
                        @error('attachment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                </form>
            </div>
        </div>
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
