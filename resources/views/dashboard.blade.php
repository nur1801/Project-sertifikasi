<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Frozeria Stok — Sistem Manajemen Stok Makanan Beku</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --primary: #1a5fb4;
    --primary-light: #e8f0fe;
    --primary-dark: #0d3e82;
    --danger: #c0392b;
    --danger-light: #fdecea;
    --warning: #d68910;
    --warning-light: #fef9e7;
    --success: #1e8449;
    --success-light: #eafaf1;
    --gray-50: #f8f9fa;
    --gray-100: #f1f3f4;
    --gray-200: #e8eaed;
    --gray-300: #dadce0;
    --gray-400: #bdc1c6;
    --gray-500: #9aa0a6;
    --gray-600: #80868b;
    --gray-700: #5f6368;
    --gray-800: #3c4043;
    --gray-900: #202124;
    --font: 'Segoe UI', system-ui, -apple-system, sans-serif;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.08);
    --shadow: 0 2px 8px rgba(0,0,0,0.12);
    --shadow-lg: 0 4px 16px rgba(0,0,0,0.15);
    --radius: 6px;
    --radius-lg: 10px;
  }
  body { font-family: var(--font); background: var(--gray-50); color: var(--gray-900); font-size: 14px; }

  .navbar { background: #1a1a2e; color: white; display: flex; align-items: center; gap: 0; padding: 0; box-shadow: var(--shadow); position: sticky; top: 0; z-index: 100; }
  .nav-brand { font-weight: 700; font-size: 15px; padding: 0 16px; color: white; letter-spacing: 0.3px; display: flex; align-items: center; gap: 6px; height: 48px; }
  .nav-brand span { color: #74b9ff; }
  .nav-link { color: rgba(255,255,255,0.75); padding: 0 14px; height: 48px; display: flex; align-items: center; font-size: 13px; cursor: pointer; border-bottom: 3px solid transparent; transition: all 0.2s; }
  .nav-link:hover { color: white; background: rgba(255,255,255,0.08); }
  .nav-link.active { color: white; border-bottom-color: #74b9ff; background: rgba(116,185,255,0.1); }
  .btn-tambah { background: #0984e3; color: white; border: none; padding: 7px 14px; border-radius: var(--radius); cursor: pointer; font-size: 13px; font-weight: 600; transition: background 0.2s; }
  .btn-tambah:hover { background: #0773c5; }

  .page { display: none; padding: 24px; max-width: 1200px; margin: 0 auto; }
  .page.active { display: block; }

  .card { background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); }
  .card-header { padding: 16px 20px; border-bottom: 1px solid var(--gray-200); font-weight: 600; font-size: 15px; color: var(--gray-800); display: flex; align-items: center; justify-content: space-between; }

  .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
  .stat-card { background: white; border-radius: var(--radius-lg); padding: 18px 20px; box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); }
  .stat-label { font-size: 12px; color: var(--gray-600); margin-bottom: 6px; }
  .stat-value { font-size: 28px; font-weight: 700; color: var(--gray-900); }
  .stat-card.warning .stat-value { color: var(--warning); }
  .stat-card.danger .stat-value { color: var(--danger); }

  .toolbar { display: flex; align-items: center; gap: 10px; padding: 14px 16px; border-bottom: 1px solid var(--gray-200); flex-wrap: nowrap; }
  .search-wrap { flex: 1 1 auto; min-width: 0; display: flex; align-items: center; border: 1px solid var(--gray-300); border-radius: var(--radius); overflow: hidden; background: white; }
  .search-wrap input { border: none; outline: none; padding: 7px 12px; flex: 1; font-size: 13px; color: var(--gray-900); }
  .search-wrap button { background: var(--primary); color: white; border: none; padding: 7px 14px; cursor: pointer; font-size: 13px; }
  .search-wrap button:hover { background: var(--primary-dark); }
  select.filter-cat { flex: 0 0 180px; border: 1px solid var(--gray-300); border-radius: var(--radius); padding: 7px 10px; font-size: 13px; color: var(--gray-800); outline: none; background: white; }
  .toolbar .btn-tambah { white-space: nowrap; }

  .table-wrap { overflow-x: auto; }
  table { width: 100%; border-collapse: collapse; }
  th { background: var(--gray-50); padding: 10px 14px; text-align: left; font-size: 12px; font-weight: 600; color: var(--gray-600); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--gray-200); }
  td { padding: 11px 14px; border-bottom: 1px solid var(--gray-100); color: var(--gray-800); vertical-align: middle; }
  tr:last-child td { border-bottom: none; }
  tr:hover td { background: var(--gray-50); }
  .badge { display: inline-block; padding: 2px 10px; border-radius: 99px; font-size: 11px; font-weight: 600; }
  .badge-primary { background: var(--primary-light); color: var(--primary-dark); }
  .badge-warning { background: var(--warning-light); color: #7d4f00; }
  .badge-danger { background: var(--danger-light); color: #8c1c13; }

  .btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 11px; border-radius: var(--radius); font-size: 12px; font-weight: 600; cursor: pointer; border: 1px solid transparent; transition: all 0.15s; }
  .btn-primary { background: var(--primary); color: white; border-color: var(--primary); }
  .btn-primary:hover { background: var(--primary-dark); }
  .btn-outline { background: white; color: var(--gray-700); border-color: var(--gray-300); }
  .btn-outline:hover { background: var(--gray-50); border-color: var(--gray-400); }
  .btn-danger { background: var(--danger); color: white; border-color: var(--danger); }
  .btn-danger:hover { background: #a93226; }
  .btn-danger-outline { background: white; color: var(--danger); border-color: #f1948a; }
  .btn-danger-outline:hover { background: var(--danger-light); }
  .btn-success { background: var(--success); color: white; border-color: var(--success); }
  .btn-success:hover { background: #166a3c; }
  .btn-group { display: flex; gap: 5px; }

  .table-footer { padding: 10px 16px; border-top: 1px solid var(--gray-200); display: flex; align-items: center; justify-content: space-between; font-size: 12px; color: var(--gray-600); }
  .pagination { display: flex; gap: 4px; }
  .page-btn { padding: 4px 10px; border: 1px solid var(--gray-300); border-radius: var(--radius); cursor: pointer; background: white; font-size: 12px; color: var(--gray-700); }
  .page-btn:hover { background: var(--gray-50); }
  .page-btn.active { background: var(--primary); color: white; border-color: var(--primary); }
  .page-btn:disabled { opacity: 0.4; cursor: default; }

  .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 200; align-items: center; justify-content: center; }
  .modal-overlay.open { display: flex; }
  .modal { background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); max-width: 460px; width: 90%; padding: 28px; }
  .modal-icon { width: 48px; height: 48px; border-radius: 50%; background: #fff3cd; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; }
  .modal-icon svg { width: 24px; height: 24px; color: #d68910; }
  .modal h3 { font-size: 17px; font-weight: 700; margin-bottom: 8px; color: var(--gray-900); }
  .modal p { font-size: 14px; color: var(--gray-600); line-height: 1.6; margin-bottom: 24px; }
  .modal-btns { display: flex; justify-content: flex-end; gap: 8px; }

  .form-page { max-width: 760px; }
  .form-back { display: inline-flex; align-items: center; gap: 6px; color: var(--primary); font-size: 13px; cursor: pointer; margin-bottom: 16px; font-weight: 500; }
  .form-back:hover { text-decoration: underline; }
  .form-title { font-size: 18px; font-weight: 700; color: var(--gray-900); margin-bottom: 20px; }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 14px; }
  .form-group { margin-bottom: 14px; }
  .form-group label { display: block; font-size: 12px; font-weight: 600; color: var(--gray-700); margin-bottom: 5px; }
  .form-group label .req { color: var(--danger); }
  .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px 12px; border: 1px solid var(--gray-300); border-radius: var(--radius); font-size: 13px; color: var(--gray-900); outline: none; transition: border-color 0.2s; font-family: var(--font); }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,95,180,0.12); }
  .form-group textarea { resize: vertical; min-height: 80px; }
  .upload-area { border: 2px dashed var(--gray-300); border-radius: var(--radius-lg); padding: 32px; text-align: center; cursor: pointer; transition: all 0.2s; background: var(--gray-50); margin-bottom: 20px; }
  .upload-area:hover { border-color: var(--primary); background: var(--primary-light); }
  .upload-area svg { width: 36px; height: 36px; color: var(--gray-400); margin-bottom: 10px; }
  .upload-area p { font-size: 13px; color: var(--gray-600); margin-bottom: 4px; }
  .upload-area .note { font-size: 11px; color: var(--gray-400); margin-bottom: 12px; }
  .upload-preview { width: 120px; height: 120px; object-fit: cover; border-radius: var(--radius); margin: 0 auto 10px; display: block; }
  .form-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 8px; padding-top: 16px; border-top: 1px solid var(--gray-200); }

  .detail-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 20px; }
  .detail-back { display: inline-flex; align-items: center; gap: 6px; color: var(--primary); font-size: 13px; cursor: pointer; font-weight: 500; margin-bottom: 8px; }
  .detail-back:hover { text-decoration: underline; }
  .detail-info { display: flex; gap: 20px; background: white; border-radius: var(--radius-lg); border: 1px solid var(--gray-200); padding: 20px; margin-bottom: 16px; }
  .detail-img { width: 120px; height: 120px; flex-shrink: 0; border-radius: var(--radius); border: 1px solid var(--gray-200); display: flex; align-items: center; justify-content: center; background: var(--gray-100); overflow: hidden; }
  .detail-img img { width: 100%; height: 100%; object-fit: cover; }
  .detail-img svg { width: 40px; height: 40px; color: var(--gray-400); }
  .detail-meta { flex: 1; }
  .detail-name { font-size: 20px; font-weight: 700; color: var(--gray-900); margin-bottom: 8px; }
  .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 12px; }
  .detail-field { border: 1px solid var(--gray-200); border-radius: var(--radius); padding: 10px 14px; }
  .detail-field-label { font-size: 11px; color: var(--gray-500); margin-bottom: 3px; }
  .detail-field-value { font-size: 15px; font-weight: 600; color: var(--gray-900); }
  .detail-desc { background: white; border: 1px solid var(--gray-200); border-radius: var(--radius-lg); padding: 16px 20px; }
  .detail-desc-label { font-size: 11px; color: var(--gray-500); margin-bottom: 6px; }
  .detail-desc-text { font-size: 13px; color: var(--gray-800); line-height: 1.7; }

  .page-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
  .page-top h2 { font-size: 18px; font-weight: 700; color: var(--gray-900); }

  .bantuan-section { background: white; border: 1px solid var(--gray-200); border-radius: var(--radius-lg); padding: 20px; margin-bottom: 16px; }
  .bantuan-title { font-size: 14px; font-weight: 700; color: var(--gray-800); margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid var(--gray-200); }
  .bantuan-steps { list-style: none; }
  .bantuan-steps li { display: flex; gap: 12px; padding: 8px 0; border-bottom: 1px solid var(--gray-100); font-size: 13px; color: var(--gray-700); line-height: 1.5; }
  .bantuan-steps li:last-child { border-bottom: none; }
  .step-num { width: 22px; height: 22px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0; margin-top: 1px; }
  .bantuan-note { background: var(--primary-light); border: 1px solid #b3d1f7; border-radius: var(--radius); padding: 12px 16px; font-size: 13px; color: var(--primary-dark); display: flex; gap: 10px; align-items: flex-start; }
  .developer-card { background: white; border: 1px solid var(--gray-200); border-radius: var(--radius-lg); padding: 20px; margin-top: 20px; }
  .developer-card h3 { font-size: 14px; font-weight: 700; margin-bottom: 12px; color: var(--gray-800); padding-bottom: 10px; border-bottom: 1px solid var(--gray-200); }
  .dev-row { display: flex; gap: 8px; padding: 6px 0; font-size: 13px; }
  .dev-label { width: 120px; color: var(--gray-500); flex-shrink: 0; }
  .dev-value { color: var(--gray-800); font-weight: 500; }

  .stok-menipis { color: var(--warning); font-weight: 600; }
  .stok-habis { color: var(--danger); font-weight: 600; }

  .empty { text-align: center; padding: 40px; color: var(--gray-500); }
  .empty svg { width: 48px; height: 48px; margin-bottom: 12px; opacity: 0.4; }

  @media (max-width: 900px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } .detail-info { flex-direction: column; } .detail-grid { grid-template-columns: 1fr; } .form-row { grid-template-columns: 1fr; } }
  @media (max-width: 640px) { .navbar { flex-wrap: wrap; } .toolbar { flex-wrap: wrap; } .search-wrap { flex: 1 1 100%; } .filter-cat, .toolbar .btn-tambah { width: 100%; flex: 1 1 100%; } .stat-grid { grid-template-columns: 1fr; } }
</style>
</head>
<body>

<nav class="navbar">
  <div class="nav-brand"><span>Frozeria</span> Stok</div>
  <a class="nav-link active" onclick="showPage('dashboard')">Dashboard</a>
  <a class="nav-link" onclick="showPage('kategori')">Kategori</a>
  <a class="nav-link" onclick="showPage('bantuan')">Bantuan</a>
</nav>

<div id="page-dashboard" class="page active">
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-label">Total barang</div>
      <div class="stat-value" id="stat-total">0</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Total kategori</div>
      <div class="stat-value" id="stat-kategori">0</div>
    </div>
    <div class="stat-card warning">
      <div class="stat-label">Stok menipis</div>
      <div class="stat-value" id="stat-menipis">0</div>
    </div>
    <div class="stat-card danger">
      <div class="stat-label">Stok habis</div>
      <div class="stat-value" id="stat-habis">0</div>
    </div>
  </div>

  <div class="card">
    <div class="toolbar">
      <div class="search-wrap">
        <input type="text" id="search-input" placeholder="Cari nama barang..." onkeydown="if(event.key==='Enter') doSearch()">
        <button onclick="doSearch()">Cari</button>
      </div>
      <select class="filter-cat" id="filter-cat" onchange="doSearch()">
        <option value="">Semua kategori</option>
      </select>
      <button class="btn-tambah" onclick="showTambahBarang()">+ Tambah Barang</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Nama barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Harga jual</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="barang-tbody"></tbody>
      </table>
    </div>
    <div class="table-footer">
      <span id="info-count">Menampilkan 0 barang</span>
      <div class="pagination" id="pagination"></div>
    </div>
  </div>
</div>

<div id="page-detail" class="page">
  <span class="detail-back" onclick="showPage('dashboard')">&#8592; Kembali</span>
  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
    <h2 style="font-size:17px; font-weight:700;">Detail Barang</h2>
    <div class="btn-group">
      <button class="btn btn-outline" onclick="editBarangFromDetail()">Edit Barang</button>
      <button class="btn btn-danger-outline" onclick="hapusFromDetail()">Hapus</button>
    </div>
  </div>
  <div class="detail-info">
    <div class="detail-img" id="detail-img-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
    </div>
    <div class="detail-meta">
      <div class="detail-name" id="detail-name">-</div>
      <span class="badge badge-primary" id="detail-cat">-</span>
      <div class="detail-grid">
        <div class="detail-field"><div class="detail-field-label">Jumlah stok</div><div class="detail-field-value" id="d-stok">-</div></div>
        <div class="detail-field"><div class="detail-field-label">Stok minimum</div><div class="detail-field-value" id="d-stok-min">-</div></div>
        <div class="detail-field"><div class="detail-field-label">Harga jual</div><div class="detail-field-value" id="d-harga-jual">-</div></div>
        <div class="detail-field"><div class="detail-field-label">Harga beli</div><div class="detail-field-value" id="d-harga-beli">-</div></div>
        <div class="detail-field"><div class="detail-field-label">Berat / ukuran</div><div class="detail-field-value" id="d-berat">-</div></div>
        <div class="detail-field"><div class="detail-field-label">Lokasi simpan</div><div class="detail-field-value" id="d-lokasi">-</div></div>
      </div>
    </div>
  </div>
  <div class="detail-desc">
    <div class="detail-desc-label">Deskripsi</div>
    <div class="detail-desc-text" id="d-deskripsi">-</div>
  </div>
</div>

<div id="page-form-barang" class="page form-page">
  <div class="form-back" onclick="showPage('dashboard')">&#8592; Kembali</div>
  <div class="form-title" id="form-barang-title">Tambah Barang Baru</div>
  <div class="card" style="padding: 24px;">
    <div style="margin-bottom: 16px;">
      <label style="font-size:12px; font-weight:600; color:var(--gray-700); display:block; margin-bottom:8px;">Foto barang</label>
      <div class="upload-area" onclick="document.getElementById('foto-input').click()" id="upload-area">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        <p>Klik untuk memilih foto, atau seret file ke sini</p>
        <div class="note">Format: JPG, PNG — Maks. 2 MB</div>
        <button class="btn btn-outline" type="button" onclick="event.stopPropagation(); document.getElementById('foto-input').click()">Pilih Foto</button>
      </div>
      <input type="file" id="foto-input" accept="image/*" style="display:none" onchange="previewFoto(event)">
    </div>

    <input type="hidden" id="edit-id">
    <div class="form-row">
      <div class="form-group" style="grid-column:1/-1">
        <label>Nama barang <span class="req">*</span></label>
        <input type="text" id="f-nama" placeholder="Ayam nugget crispy">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Kategori <span class="req">*</span></label>
        <select id="f-kategori"></select>
      </div>
      <div class="form-group">
        <label>Satuan <span class="req">*</span></label>
        <input type="text" id="f-satuan" placeholder="pcs">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Jumlah stok <span class="req">*</span></label>
        <input type="number" id="f-stok" placeholder="0" min="0">
      </div>
      <div class="form-group">
        <label>Stok minimum</label>
        <input type="number" id="f-stok-min" placeholder="20" min="0">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Harga jual (Rp)</label>
        <input type="number" id="f-harga-jual" placeholder="35000" min="0">
      </div>
      <div class="form-group">
        <label>Harga beli (Rp)</label>
        <input type="number" id="f-harga-beli" placeholder="28000" min="0">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Berat / ukuran</label>
        <input type="text" id="f-berat" placeholder="500 gram">
      </div>
      <div class="form-group">
        <label>Lokasi simpan</label>
        <input type="text" id="f-lokasi" placeholder="Rak A-3">
      </div>
    </div>
    <div class="form-group">
      <label>Deskripsi</label>
      <textarea id="f-deskripsi" placeholder="Deskripsi produk..."></textarea>
    </div>
    <div class="form-actions">
      <button class="btn btn-outline" onclick="showPage('dashboard')">Batal</button>
      <button class="btn btn-success" onclick="simpanBarang()">Simpan Barang</button>
    </div>
  </div>
</div>

<div id="page-kategori" class="page">
  <div class="page-top">
    <h2>Daftar Kategori</h2>
  </div>
  <div class="card">
    <div class="toolbar">
      <div class="search-wrap">
        <input type="text" id="search-kat" placeholder="Cari kategori..." oninput="renderKategori()">
        <button class="btn btn-primary" onclick="showTambahKategori()">+ Tambah Kategori</button>
      </div>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Nama kategori</th>
            <th>Jumlah barang</th>
            <th>Dibuat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="kategori-tbody"></tbody>
      </table>
    </div>
    <div class="table-footer">
      <span id="info-kat">0 kategori terdaftar</span>
    </div>
  </div>
</div>

<div id="page-form-kategori" class="page form-page">
  <div class="form-back" onclick="showPage('kategori')">&#8592; Kembali</div>
  <div class="form-title" id="form-kat-title">Tambah Kategori</div>
  <div class="card" style="padding: 24px;">
    <input type="hidden" id="edit-kat-id">
    <div class="form-group">
      <label>Nama kategori <span class="req">*</span></label>
      <input type="text" id="f-kat-nama" placeholder="Ayam">
    </div>
    <div class="form-group">
      <label>Deskripsi (opsional)</label>
      <textarea id="f-kat-deskripsi" placeholder="Produk berbahan dasar ayam beku..."></textarea>
    </div>
    <div class="form-actions">
      <button class="btn btn-outline" onclick="showPage('kategori')">Batal</button>
      <button class="btn btn-success" onclick="simpanKategori()">Simpan Kategori</button>
    </div>
  </div>
</div>

<div id="page-bantuan" class="page">
  <div class="bantuan-section">
    <div class="bantuan-title">Panduan Penggunaan Sistem</div>
    <div style="font-weight:600; font-size:13px; color:var(--gray-700); margin-bottom:10px;">Cara menambah barang baru</div>
    <ul class="bantuan-steps">
      <li><span class="step-num">1</span>Buka halaman <strong>Dashboard</strong>, klik tombol <strong>+ Tambah Barang</strong> di kanan atas.</li>
      <li><span class="step-num">2</span>Unggah foto barang (opsional), lalu isi formulir: nama, kategori, satuan, jumlah stok, harga, dan lainnya.</li>
      <li><span class="step-num">3</span>Klik <strong>Simpan Barang</strong>. Barang akan muncul di daftar dashboard.</li>
    </ul>
  </div>
  <div class="bantuan-section">
    <div class="bantuan-title" style="border:none;margin:0;padding:0;">Cara update stok barang masuk</div>
    <ul class="bantuan-steps" style="margin-top:12px;">
      <li><span class="step-num">1</span>Temukan barang di dashboard menggunakan kolom pencarian atau filter kategori.</li>
      <li><span class="step-num">2</span>Klik tombol <strong>Edit</strong> pada baris barang tersebut.</li>
      <li><span class="step-num">3</span>Ubah nilai <strong>Jumlah stok</strong> sesuai kondisi saat ini, lalu klik <strong>Simpan Barang</strong>.</li>
    </ul>
  </div>
  <div class="bantuan-section">
    <div class="bantuan-title" style="border:none;margin:0;padding:0;">Cara mengelola kategori</div>
    <ul class="bantuan-steps" style="margin-top:12px;">
      <li><span class="step-num">1</span>Buka halaman <strong>Kategori</strong> dari navigasi atas.</li>
      <li><span class="step-num">2</span>Tambah, edit, atau hapus kategori sesuai kebutuhan toko.</li>
      <li><span class="step-num">3</span>Menghapus kategori tidak akan menghapus barang — barang akan menjadi tidak berkategori.</li>
    </ul>
  </div>
  <div class="bantuan-note">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0; margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
    Satuan barang diisi bebas sesuai kebutuhan — misalnya: <strong>pcs</strong>, <strong>pack</strong>, <strong>box</strong>, <strong>kg</strong>, <strong>liter</strong>, dan lain-lain.
  </div>

  <div class="developer-card">
    <h3>Informasi Developer</h3>
    <div class="dev-row"><span class="dev-label">Nama</span><span class="dev-value" id="dev-nama">Nurhidayah</span></div>
    <div class="dev-row"><span class="dev-label">NIM</span><span class="dev-value" id="dev-nim">2241760044</span></div>
    <div class="dev-row"><span class="dev-label">Kelas</span><span class="dev-value" id="dev-kelas">SIB 4E</span></div>
    <div class="dev-row"><span class="dev-label">Alamat</span><span class="dev-value" id="dev-alamat">JL. L.A Sucipto</span></div>
    <div class="dev-row"><span class="dev-label">No. Telepon</span><span class="dev-value" id="dev-telp">089662703416</span></div>
    <div class="dev-row"><span class="dev-label">Email</span><span class="dev-value" id="dev-email">nurhid180701@gmail.com</span></div>
  </div>
</div>

<div class="modal-overlay" id="modal-hapus">
  <div class="modal">
    <div class="modal-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="#d68910" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
    </div>
    <h3>Hapus barang?</h3>
    <p id="modal-msg">Data akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.</p>
    <div class="modal-btns">
      <button class="btn btn-outline" onclick="closeModal()">Batal</button>
      <button class="btn btn-danger" onclick="confirmHapus()">Ya, Hapus</button>
    </div>
  </div>
</div>

<script>
const serverBarang = @json($barang->values());
const serverKategori = @json($kategoriList->values());

let DB = {
  barang: [],
  kategori: [],
  nextBarangId: 1,
  nextKatId: 1
};

function loadDB() {
  const saved = localStorage.getItem('frozeria_db');
  if (saved) {
    DB = JSON.parse(saved);
  } else {
    DB.kategori = serverKategori.length
      ? serverKategori.map((nama, index) => ({ id: index + 1, nama, deskripsi: '', dibuat: 'Database' }))
      : [
          { id: 1, nama: 'Umum', deskripsi: 'Kategori dari database', dibuat: 'Database' }
        ];
    DB.nextKatId = DB.kategori.length + 1;
    DB.barang = serverBarang.map((item, index) => {
      const kategoriId = DB.kategori.find(k => k.nama === item.kategori)?.id || 1;
      return {
        id: item.id || (index + 1),
        nama: item.nama_barang,
        kategoriId: kategoriId,
        stok: Number(item.stok || 0),
        satuan: item.satuan || '-',
        hargaJual: Number(item.harga || 0),
        hargaBeli: Number(item.harga || 0),
        stokMin: 0,
        berat: '-',
        lokasi: '-',
        deskripsi: item.deskripsi || '',
        foto: ''
      };
    });
    DB.nextBarangId = DB.barang.length ? Math.max(...DB.barang.map(b => Number(b.id))) + 1 : 1;
    saveDB();
  }
}

function saveDB() {
  localStorage.setItem('frozeria_db', JSON.stringify(DB));
}

let currentPage = 'dashboard';
function showPage(page) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
  document.getElementById('page-' + page).classList.add('active');
  const navMap = { dashboard: 0, kategori: 1, bantuan: 2 };
  if (navMap[page] !== undefined) {
    document.querySelectorAll('.nav-link')[navMap[page]].classList.add('active');
  }
  currentPage = page;
  if (page === 'dashboard') renderDashboard();
  if (page === 'kategori') renderKategori();
  if (page === 'bantuan') renderBantuan();
}

let filteredBarang = [];
let currentPageNum = 1;
const perPage = 15;
let pendingDeleteId = null;
let pendingDeleteType = null;

function getKatNama(id) {
  const k = DB.kategori.find(k => k.id === id);
  return k ? k.nama : '—';
}

function renderDashboard() {
  const q = (document.getElementById('search-input').value || '').toLowerCase();
  const catId = document.getElementById('filter-cat').value;

  filteredBarang = DB.barang.filter(b => {
    const matchName = b.nama.toLowerCase().includes(q);
    const matchCat = !catId || b.kategoriId == catId;
    return matchName && matchCat;
  });

  document.getElementById('stat-total').textContent = DB.barang.length;
  document.getElementById('stat-kategori').textContent = DB.kategori.length;
  document.getElementById('stat-menipis').textContent = DB.barang.filter(b => b.stok > 0 && b.stok < 20).length;
  document.getElementById('stat-habis').textContent = DB.barang.filter(b => b.stok === 0).length;

  const catSel = document.getElementById('filter-cat');
  const curVal = catSel.value;
  catSel.innerHTML = '<option value="">Semua kategori</option>' + DB.kategori.map(k => `<option value="${k.id}">${k.nama}</option>`).join('');
  catSel.value = curVal;

  const totalPages = Math.ceil(filteredBarang.length / perPage) || 1;
  if (currentPageNum > totalPages) currentPageNum = totalPages;
  const start = (currentPageNum - 1) * perPage;
  const slice = filteredBarang.slice(start, start + perPage);

  const tbody = document.getElementById('barang-tbody');
  if (slice.length === 0) {
    tbody.innerHTML = '<tr><td colspan="6" class="empty" style="text-align:center; color:var(--gray-500); padding:32px;">Tidak ada data barang.</td></tr>';
  } else {
    tbody.innerHTML = slice.map(b => {
      let stokClass = '';
      if (b.stok === 0) stokClass = 'stok-habis';
      else if (b.stok < 20) stokClass = 'stok-menipis';
      return `<tr>
        <td style="font-weight:500; color:var(--primary); cursor:pointer;" onclick="showDetail(${b.id})">${b.nama}</td>
        <td><span class="badge badge-primary">${getKatNama(b.kategoriId)}</span></td>
        <td class="${stokClass}">${b.stok}</td>
        <td>${b.satuan}</td>
        <td>Rp ${Number(b.hargaJual).toLocaleString('id-ID')}</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-outline" onclick="showDetail(${b.id})">Detail</button>
            <button class="btn btn-outline" onclick="showEditBarang(${b.id})">Edit</button>
            <button class="btn btn-danger-outline" onclick="hapusBarang(${b.id})">Hapus</button>
          </div>
        </td>
      </tr>`;
    }).join('');
  }

  const end = Math.min(start + perPage, filteredBarang.length);
  document.getElementById('info-count').textContent = `Menampilkan ${filteredBarang.length === 0 ? 0 : start+1}–${end} dari ${filteredBarang.length} barang`;

  const pag = document.getElementById('pagination');
  let html = `<button class="page-btn" ${currentPageNum===1?'disabled':''} onclick="goPage(${currentPageNum-1})">&#8249; Prev</button>`;
  for (let i = 1; i <= totalPages; i++) {
    html += `<button class="page-btn ${i===currentPageNum?'active':''}" onclick="goPage(${i})">${i}</button>`;
  }
  html += `<button class="page-btn" ${currentPageNum===totalPages?'disabled':''} onclick="goPage(${currentPageNum+1})">Next &#8250;</button>`;
  pag.innerHTML = html;
}

function goPage(n) { currentPageNum = n; renderDashboard(); }
function doSearch() { currentPageNum = 1; renderDashboard(); }

let detailId = null;
function showDetail(id) {
  detailId = id;
  const b = DB.barang.find(b => b.id === id);
  if (!b) return;
  document.getElementById('detail-name').textContent = b.nama;
  document.getElementById('detail-cat').textContent = getKatNama(b.kategoriId);
  document.getElementById('d-stok').textContent = b.stok + ' ' + b.satuan;
  document.getElementById('d-stok-min').textContent = (b.stokMin || '—') + (b.stokMin ? ' ' + b.satuan : '');
  document.getElementById('d-harga-jual').textContent = 'Rp ' + Number(b.hargaJual).toLocaleString('id-ID');
  document.getElementById('d-harga-beli').textContent = 'Rp ' + Number(b.hargaBeli || 0).toLocaleString('id-ID');
  document.getElementById('d-berat').textContent = b.berat || '—';
  document.getElementById('d-lokasi').textContent = b.lokasi || '—';
  document.getElementById('d-deskripsi').textContent = b.deskripsi || '—';
  const imgWrap = document.getElementById('detail-img-wrap');
  if (b.foto) {
    imgWrap.innerHTML = `<img src="${b.foto}" alt="${b.nama}">`;
  } else {
    imgWrap.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>`;
  }
  showPage('detail');
  document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
}

function editBarangFromDetail() { showEditBarang(detailId); }
function hapusFromDetail() { hapusBarang(detailId, true); }

let currentFoto = '';

function showTambahBarang() {
  document.getElementById('form-barang-title').textContent = 'Tambah Barang Baru';
  document.getElementById('edit-id').value = '';
  document.getElementById('f-nama').value = '';
  document.getElementById('f-satuan').value = '';
  document.getElementById('f-stok').value = '';
  document.getElementById('f-stok-min').value = '';
  document.getElementById('f-harga-jual').value = '';
  document.getElementById('f-harga-beli').value = '';
  document.getElementById('f-berat').value = '';
  document.getElementById('f-lokasi').value = '';
  document.getElementById('f-deskripsi').value = '';
  currentFoto = '';
  resetUploadArea();
  populateKategoriSelect();
  showPage('form-barang');
  document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
}

function showEditBarang(id) {
  const b = DB.barang.find(b => b.id === id);
  if (!b) return;
  document.getElementById('form-barang-title').textContent = 'Edit Barang';
  document.getElementById('edit-id').value = b.id;
  document.getElementById('f-nama').value = b.nama;
  document.getElementById('f-satuan').value = b.satuan;
  document.getElementById('f-stok').value = b.stok;
  document.getElementById('f-stok-min').value = b.stokMin || '';
  document.getElementById('f-harga-jual').value = b.hargaJual || '';
  document.getElementById('f-harga-beli').value = b.hargaBeli || '';
  document.getElementById('f-berat').value = b.berat || '';
  document.getElementById('f-lokasi').value = b.lokasi || '';
  document.getElementById('f-deskripsi').value = b.deskripsi || '';
  currentFoto = b.foto || '';
  populateKategoriSelect(b.kategoriId);
  if (b.foto) {
    document.getElementById('upload-area').innerHTML = `<img src="${b.foto}" class="upload-preview"><p style="font-size:12px; color:var(--gray-500);">Foto terpilih. Klik untuk ganti.</p>`;
  } else {
    resetUploadArea();
  }
  showPage('form-barang');
  document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
}

function populateKategoriSelect(selected) {
  const sel = document.getElementById('f-kategori');
  sel.innerHTML = '<option value="">Pilih kategori</option>' + DB.kategori.map(k => `<option value="${k.id}" ${selected==k.id?'selected':''}>${k.nama}</option>`).join('');
}

function resetUploadArea() {
  document.getElementById('upload-area').innerHTML = `
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
    <p>Klik untuk memilih foto, atau seret file ke sini</p>
    <div class="note">Format: JPG, PNG — Maks. 2 MB</div>
    <button class="btn btn-outline" type="button" onclick="event.stopPropagation(); document.getElementById('foto-input').click()">Pilih Foto</button>`;
}

function previewFoto(event) {
  const file = event.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = function(e) {
    currentFoto = e.target.result;
    document.getElementById('upload-area').innerHTML = `<img src="${currentFoto}" class="upload-preview"><p style="font-size:12px; color:var(--gray-500);">Foto terpilih. Klik untuk ganti.</p>`;
  };
  reader.readAsDataURL(file);
}

function simpanBarang() {
  const nama = document.getElementById('f-nama').value.trim();
  const katId = parseInt(document.getElementById('f-kategori').value);
  const satuan = document.getElementById('f-satuan').value.trim();
  const stok = parseInt(document.getElementById('f-stok').value) || 0;
  if (!nama) { alert('Nama barang wajib diisi!'); return; }
  if (!katId) { alert('Pilih kategori!'); return; }
  if (!satuan) { alert('Satuan wajib diisi!'); return; }

  const id = document.getElementById('edit-id').value;
  const data = {
    nama, kategoriId: katId, satuan, stok,
    stokMin: parseInt(document.getElementById('f-stok-min').value) || 0,
    hargaJual: parseInt(document.getElementById('f-harga-jual').value) || 0,
    hargaBeli: parseInt(document.getElementById('f-harga-beli').value) || 0,
    berat: document.getElementById('f-berat').value.trim(),
    lokasi: document.getElementById('f-lokasi').value.trim(),
    deskripsi: document.getElementById('f-deskripsi').value.trim(),
    foto: currentFoto
  };

  if (id) {
    const idx = DB.barang.findIndex(b => b.id == id);
    if (idx !== -1) DB.barang[idx] = { ...DB.barang[idx], ...data };
  } else {
    data.id = DB.nextBarangId++;
    DB.barang.unshift(data);
  }
  saveDB();
  showPage('dashboard');
}

function hapusBarang(id, fromDetail) {
  const b = DB.barang.find(b => b.id === id);
  if (!b) return;
  pendingDeleteId = id;
  pendingDeleteType = fromDetail ? 'barang-detail' : 'barang';
  document.getElementById('modal-msg').textContent = `Data "${b.nama}" akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.`;
  document.querySelector('#modal-hapus h3').textContent = 'Hapus barang?';
  document.getElementById('modal-hapus').classList.add('open');
}

function hapusKategori(id) {
  const k = DB.kategori.find(k => k.id === id);
  if (!k) return;
  pendingDeleteId = id;
  pendingDeleteType = 'kategori';
  document.getElementById('modal-msg').textContent = `Kategori "${k.nama}" akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.`;
  document.querySelector('#modal-hapus h3').textContent = 'Hapus kategori?';
  document.getElementById('modal-hapus').classList.add('open');
}

function closeModal() {
  document.getElementById('modal-hapus').classList.remove('open');
  pendingDeleteId = null;
}

function confirmHapus() {
  if (pendingDeleteType === 'barang' || pendingDeleteType === 'barang-detail') {
    DB.barang = DB.barang.filter(b => b.id !== pendingDeleteId);
    saveDB();
    closeModal();
    if (pendingDeleteType === 'barang-detail') showPage('dashboard');
    else renderDashboard();
  } else if (pendingDeleteType === 'kategori') {
    DB.kategori = DB.kategori.filter(k => k.id !== pendingDeleteId);
    saveDB();
    closeModal();
    renderKategori();
  }
}

document.getElementById('modal-hapus').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});

function renderKategori() {
  const q = (document.getElementById('search-kat').value || '').toLowerCase();
  const list = DB.kategori.filter(k => k.nama.toLowerCase().includes(q));

  const catSel = document.getElementById('filter-cat');
  const cur = catSel.value;
  catSel.innerHTML = '<option value="">Semua kategori</option>' + DB.kategori.map(k => `<option value="${k.id}">${k.nama}</option>`).join('');
  catSel.value = cur;

  const tbody = document.getElementById('kategori-tbody');
  if (list.length === 0) {
    tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding:32px; color:var(--gray-500);">Tidak ada kategori.</td></tr>';
  } else {
    tbody.innerHTML = list.map(k => {
      const count = DB.barang.filter(b => b.kategoriId === k.id).length;
      return `<tr>
        <td style="font-weight:500;">${k.nama}</td>
        <td>${count} barang</td>
        <td>${k.dibuat || '—'}</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-outline" onclick="showEditKategori(${k.id})">Edit</button>
            <button class="btn btn-danger-outline" onclick="hapusKategori(${k.id})">Hapus</button>
          </div>
        </td>
      </tr>`;
    }).join('');
  }
  document.getElementById('info-kat').textContent = `${list.length} kategori terdaftar`;
}

function showTambahKategori() {
  document.getElementById('form-kat-title').textContent = 'Tambah Kategori';
  document.getElementById('edit-kat-id').value = '';
  document.getElementById('f-kat-nama').value = '';
  document.getElementById('f-kat-deskripsi').value = '';
  showPage('form-kategori');
  document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
  document.querySelectorAll('.nav-link')[1].classList.add('active');
}

function showEditKategori(id) {
  const k = DB.kategori.find(k => k.id === id);
  if (!k) return;
  document.getElementById('form-kat-title').textContent = 'Edit Kategori';
  document.getElementById('edit-kat-id').value = k.id;
  document.getElementById('f-kat-nama').value = k.nama;
  document.getElementById('f-kat-deskripsi').value = k.deskripsi || '';
  showPage('form-kategori');
  document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
  document.querySelectorAll('.nav-link')[1].classList.add('active');
}

function simpanKategori() {
  const nama = document.getElementById('f-kat-nama').value.trim();
  if (!nama) { alert('Nama kategori wajib diisi!'); return; }
  const id = document.getElementById('edit-kat-id').value;
  const deskripsi = document.getElementById('f-kat-deskripsi').value.trim();
  if (id) {
    const idx = DB.kategori.findIndex(k => k.id == id);
    if (idx !== -1) { DB.kategori[idx].nama = nama; DB.kategori[idx].deskripsi = deskripsi; }
  } else {
    const now = new Date();
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    DB.kategori.push({ id: DB.nextKatId++, nama, deskripsi, dibuat: `${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}` });
  }
  saveDB();
  showPage('kategori');
}

function renderBantuan() {
  const devFields = ['nama','nim','kelas','alamat','telp','email'];
  devFields.forEach(f => {
    const saved = localStorage.getItem('frozeria_dev_' + f) || '';
    document.getElementById('dev-' + f).textContent = saved || '—';
    document.getElementById('dev-input-' + f).value = saved;
  });
}


loadDB();
renderDashboard();
</script>
</body>
</html>
