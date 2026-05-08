@csrf

<div class="row g-3">
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
        <label class="form-label fw-semibold">Nama Barang</label>
        <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Satuan</label>
        <input type="text" name="unit" value="{{ old('unit', $item->unit ?? '') }}" class="form-control" placeholder="pcs / pack / box" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Foto Barang</label>
        <input type="file" name="photo" class="form-control" accept="image/*">
        <div class="form-text">Format JPG, PNG, WEBP. Maksimal 2 MB.</div>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Stok</label>
        <input type="number" name="stock" value="{{ old('stock', $item->stock ?? 0) }}" class="form-control" min="0" required>
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Stok Minimum</label>
        <input type="number" name="min_stock" value="{{ old('min_stock', $item->min_stock ?? 0) }}" class="form-control" min="0" required>
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Harga Jual</label>
        <input type="number" name="selling_price" value="{{ old('selling_price', $item->selling_price ?? 0) }}" class="form-control" min="0" required>
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Harga Beli</label>
        <input type="number" name="purchase_price" value="{{ old('purchase_price', $item->purchase_price ?? 0) }}" class="form-control" min="0" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Berat / Ukuran</label>
        <input type="text" name="weight" value="{{ old('weight', $item->weight ?? '') }}" class="form-control" placeholder="500 gram / 1 kg">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Lokasi</label>
        <input type="text" name="location" value="{{ old('location', $item->location ?? '') }}" class="form-control" placeholder="Freezer A1">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Deskripsi</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', $item->description ?? '') }}</textarea>
    </div>
</div>