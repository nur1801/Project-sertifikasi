@csrf

<div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-semibold">Foto Barang</label>
        
        <div class="position-relative">
            <input type="file" name="photo" id="photo-input" class="form-control" accept="image/*" style="display: none;">
            
            <div id="photo-dropzone" class="rounded-3 p-4 text-center" style="border: 2px dashed #dee2e6; cursor: pointer; transition: all 0.3s; background-color: #fafbfc;">
                <svg class="text-secondary mb-2" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                </svg>
                <p class="mb-2 fw-semibold text-dark">Klik untuk memilih foto, atau unggah file ke sini</p>
                <p class="mb-0 text-secondary small">Format: JPG, PNG, WEBP — Ukuran 2 MB</p>
                <button type="button" class="btn btn-sm btn-outline-primary mt-3">Pilih Foto</button>
            </div>

            <div id="photo-preview-container" class="mt-3" style="display: none;">
                <img id="photo-preview" alt="Preview" class="rounded border object-fit-cover" style="width: 180px; height: 180px;">
                <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="change-photo-btn">Ubah Foto</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Nama Barang</label>
        <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Kategori</label>
        <select name="category_id" class="form-select">
            <option value="">- Pilih kategori -</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $item->category_id ?? null) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Satuan</label>
        <input type="text" name="unit" value="{{ old('unit', $item->unit ?? '') }}" class="form-control" placeholder="pcs / pack / box" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Stok</label>
        <input type="number" name="stock" value="{{ old('stock', $item->stock ?? 0) }}" class="form-control" min="0" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Stok Minimum</label>
        <input type="number" name="min_stock" value="{{ old('min_stock', $item->min_stock ?? 0) }}" class="form-control" min="0" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Harga Jual (Rp)</label>
        <input type="number" name="selling_price" value="{{ old('selling_price', $item->selling_price ?? 0) }}" class="form-control" min="0" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Harga Beli (Rp)</label>
        <input type="number" name="purchase_price" value="{{ old('purchase_price', $item->purchase_price ?? 0) }}" class="form-control" min="0" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Berat / Ukuran</label>
        <input type="text" name="weight" value="{{ old('weight', $item->weight ?? '') }}" class="form-control" placeholder="500 gram / 1 kg">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Lokasi Simpan</label>
        <input type="text" name="location" value="{{ old('location', $item->location ?? '') }}" class="form-control" placeholder="Freezer A1">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Deskripsi</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', $item->description ?? '') }}</textarea>
    </div>
</div>

@once
    @push('scripts')
        <script>
            (function(){
                const input = document.getElementById('photo-input');
                const dropzone = document.getElementById('photo-dropzone');
                const previewContainer = document.getElementById('photo-preview-container');
                const preview = document.getElementById('photo-preview');
                const changePhotoBtn = document.getElementById('change-photo-btn');
                
                if (!input || !dropzone) return;

                // Initialize - check if there's existing photo
                function initializePreview() {
                    @if (isset($item) && $item->photo)
                        preview.src = "{{ asset('storage/' . $item->photo) }}";
                        dropzone.style.display = 'none';
                        previewContainer.style.display = 'block';
                    @endif
                }

                // Handle file selection
                function handleFiles(files) {
                    const file = files && files[0];
                    if (file) {
                        const objectUrl = URL.createObjectURL(file);
                        preview.src = objectUrl;
                        dropzone.style.display = 'none';
                        previewContainer.style.display = 'block';
                        preview.onload = () => URL.revokeObjectURL(objectUrl);
                    }
                }

                // Click handlers
                dropzone.addEventListener('click', () => input.click());
                changePhotoBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    input.click();
                });
                input.addEventListener('change', (e) => handleFiles(e.target.files));

                // Drag and drop
                dropzone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropzone.style.borderColor = '#0284c7';
                    dropzone.style.backgroundColor = '#eff6ff';
                });
                dropzone.addEventListener('dragleave', () => {
                    dropzone.style.borderColor = '#dee2e6';
                    dropzone.style.backgroundColor = '#fafbfc';
                });
                dropzone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropzone.style.borderColor = '#dee2e6';
                    dropzone.style.backgroundColor = '#fafbfc';
                    handleFiles(e.dataTransfer.files);
                    input.files = e.dataTransfer.files;
                });

                initializePreview();
            })();
        </script>
    @endpush
@endonce