<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> — Sistem Manajemen Perpustakaan</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --bg: #F7F4EE;
    --surface: #FFFFFF;
    --surface2: #F0EDE5;
    --ink: #1C1A16;
    --ink2: #5C5850;
    --ink3: #9C9890;
    --accent: #2D5A3D;
    --accent-light: #EAF3E0;
    --accent-mid: #4A8B5C;
    --danger: #8B2020;
    --danger-light: #FCEAEA;
    --warn: #7A4F00;
    --warn-light: #FEF3DC;
    --info: #1A3D6B;
    --info-light: #E6EFFE;
    --border: rgba(28,26,22,0.12);
    --border-soft: rgba(28,26,22,0.07);
    --radius: 8px;
    --radius-lg: 14px;
    --sidebar: 240px;
    --shadow: 0 1px 3px rgba(28,26,22,0.08), 0 1px 2px rgba(28,26,22,0.05);
  }

  body {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    color: var(--ink);
    min-height: 100vh;
    display: flex;
    font-size: 14px;
    line-height: 1.6;
  }

  /* SIDEBAR */
  .sidebar {
    width: var(--sidebar);
    min-height: 100vh;
    background: var(--accent);
    display: flex;
    flex-direction: column;
    position: fixed;
    left: 0; top: 0; bottom: 0;
    z-index: 100;
  }

  .sidebar-logo {
    padding: 24px 20px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.12);
  }

  .sidebar-logo .logo-text {
    font-family: 'Lora', serif;
    font-size: 22px;
    font-weight: 600;
    color: #fff;
    letter-spacing: -0.3px;
    display: block;
  }

  .sidebar-logo .logo-sub {
    font-size: 11px;
    color: rgba(255,255,255,0.55);
    letter-spacing: 0.8px;
    text-transform: uppercase;
    margin-top: 2px;
  }

  .sidebar-nav {
    flex: 1;
    padding: 16px 12px;
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .nav-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
    padding: 12px 8px 6px;
  }

  .nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: var(--radius);
    cursor: pointer;
    color: rgba(255,255,255,0.75);
    font-size: 13.5px;
    font-weight: 400;
    transition: all 0.15s;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
  }

  .nav-item i { font-size: 17px; flex-shrink: 0; }

  .nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }

  .nav-item.active {
    background: rgba(255,255,255,0.18);
    color: #fff;
    font-weight: 500;
  }

  .sidebar-footer {
    padding: 16px 12px;
    border-top: 1px solid rgba(255,255,255,0.12);
  }

  .user-pill {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 10px;
    border-radius: var(--radius);
  }

  .user-avatar {
    width: 32px; height: 32px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600; color: #fff;
    flex-shrink: 0;
  }

  .user-info .name { font-size: 13px; color: #fff; font-weight: 500; }
  .user-info .role { font-size: 11px; color: rgba(255,255,255,0.5); }

  /* MAIN */
  .main {
    margin-left: var(--sidebar);
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .topbar {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    padding: 0 28px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 50;
  }

  .topbar-title {
    font-family: 'Lora', serif;
    font-size: 18px;
    font-weight: 500;
    color: var(--ink);
  }

  .topbar-actions { display: flex; align-items: center; gap: 12px; }

  .date-badge {
    font-size: 12px;
    color: var(--ink2);
    background: var(--surface2);
    padding: 4px 10px;
    border-radius: 20px;
    border: 1px solid var(--border);
  }

  .content { padding: 28px; flex: 1; }

  /* PAGE SECTIONS */
  .page { display: none; }
  .page.active { display: block; }

  /* CARDS */
  .card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
  }

  .card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border-soft);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .card-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .card-title i { color: var(--accent); font-size: 17px; }

  .card-body { padding: 20px; }

  /* STATS */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
  }

  .stat-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    padding: 18px 20px;
    box-shadow: var(--shadow);
  }

  .stat-icon {
    width: 38px; height: 38px;
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 12px;
    font-size: 18px;
  }

  .stat-icon.green { background: var(--accent-light); color: var(--accent); }
  .stat-icon.blue { background: var(--info-light); color: var(--info); }
  .stat-icon.amber { background: var(--warn-light); color: var(--warn); }
  .stat-icon.red { background: var(--danger-light); color: var(--danger); }

  .stat-value {
    font-size: 26px;
    font-weight: 600;
    color: var(--ink);
    font-family: 'Lora', serif;
    line-height: 1.1;
  }

  .stat-label {
    font-size: 12px;
    color: var(--ink3);
    margin-top: 3px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .stat-trend {
    font-size: 11.5px;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 3px;
  }

  .stat-trend.up { color: var(--accent); }
  .stat-trend.down { color: var(--danger); }

  /* TABLE */
  .table-wrap { overflow-x: auto; }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
  }

  thead th {
    text-align: left;
    padding: 10px 14px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.7px;
    color: var(--ink3);
    background: var(--surface2);
    border-bottom: 1px solid var(--border);
  }

  thead th:first-child { border-radius: var(--radius) 0 0 0; }
  thead th:last-child { border-radius: 0 var(--radius) 0 0; }

  tbody tr {
    border-bottom: 1px solid var(--border-soft);
    transition: background 0.1s;
  }

  tbody tr:hover { background: var(--bg); }
  tbody tr:last-child { border-bottom: none; }

  tbody td {
    padding: 11px 14px;
    color: var(--ink);
    vertical-align: middle;
  }

  .cell-muted { color: var(--ink2); font-size: 12.5px; }

  /* BADGES */
  .badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 8px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
  }

  .badge-green { background: var(--accent-light); color: var(--accent); }
  .badge-red { background: var(--danger-light); color: var(--danger); }
  .badge-amber { background: var(--warn-light); color: var(--warn); }
  .badge-blue { background: var(--info-light); color: var(--info); }
  .badge-gray { background: var(--surface2); color: var(--ink2); }

  /* BUTTONS */
  .btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: var(--radius);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    border: 1px solid transparent;
    transition: all 0.15s;
    font-family: 'Inter', sans-serif;
    line-height: 1;
  }

  .btn-primary {
    background: var(--accent);
    color: #fff;
    border-color: var(--accent);
  }

  .btn-primary:hover { background: #234a30; }

  .btn-outline {
    background: transparent;
    color: var(--ink);
    border-color: var(--border);
  }

  .btn-outline:hover { background: var(--surface2); }

  .btn-danger {
    background: var(--danger-light);
    color: var(--danger);
    border-color: transparent;
  }

  .btn-danger:hover { background: #f5d0d0; }

  .btn-sm { padding: 5px 10px; font-size: 12px; }

  /* FORMS */
  .form-group { margin-bottom: 16px; }

  .form-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--ink2);
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .form-control {
    width: 100%;
    padding: 9px 12px;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 13.5px;
    font-family: 'Inter', sans-serif;
    background: var(--surface);
    color: var(--ink);
    transition: border-color 0.15s, box-shadow 0.15s;
    outline: none;
  }

  .form-control:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(45,90,61,0.1);
  }

  select.form-control { cursor: pointer; }

  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }

  /* SEARCH BAR */
  .search-bar {
    position: relative;
  }

  .search-bar i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--ink3);
    font-size: 16px;
    pointer-events: none;
  }

  .search-bar input {
    padding-left: 34px;
  }

  /* MODAL */
  .modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(28,26,22,0.45);
    z-index: 200;
    align-items: center;
    justify-content: center;
  }

  .modal-overlay.open { display: flex; }

  .modal {
    background: var(--surface);
    border-radius: var(--radius-lg);
    width: 520px;
    max-width: 95vw;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(28,26,22,0.18);
  }

  .modal-header {
    padding: 18px 22px 14px;
    border-bottom: 1px solid var(--border-soft);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .modal-title {
    font-family: 'Lora', serif;
    font-size: 17px;
    font-weight: 500;
    color: var(--ink);
  }

  .modal-body { padding: 20px 22px; }

  .modal-footer {
    padding: 14px 22px;
    border-top: 1px solid var(--border-soft);
    display: flex;
    gap: 10px;
    justify-content: flex-end;
  }

  .btn-icon {
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    border-radius: var(--radius);
    border: 1px solid var(--border);
    background: transparent;
    color: var(--ink2);
    cursor: pointer;
    transition: all 0.15s;
    font-size: 16px;
  }

  .btn-icon:hover { background: var(--surface2); color: var(--ink); }

  /* BOOK COVERS */
  .book-cover {
    width: 36px; height: 48px;
    border-radius: 3px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
  }

  /* ALERT */
  .alert {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 14px;
    border-radius: var(--radius);
    margin-bottom: 16px;
    font-size: 13px;
  }

  .alert-warning { background: var(--warn-light); color: var(--warn); border: 1px solid rgba(122,79,0,0.2); }
  .alert-success { background: var(--accent-light); color: var(--accent); border: 1px solid rgba(45,90,61,0.2); }
  .alert-danger { background: var(--danger-light); color: var(--danger); border: 1px solid rgba(139,32,32,0.2); }

  /* CHART bars */
  .chart-bar-wrap { display: flex; flex-direction: column; gap: 8px; }

  .chart-row {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
  }

  .chart-label { width: 80px; color: var(--ink2); font-size: 11.5px; flex-shrink: 0; }

  .chart-track {
    flex: 1;
    height: 8px;
    background: var(--surface2);
    border-radius: 4px;
    overflow: hidden;
  }

  .chart-fill {
    height: 100%;
    border-radius: 4px;
    background: var(--accent);
    transition: width 0.6s ease;
  }

  .chart-fill.amber { background: #D4851A; }
  .chart-fill.blue { background: #2468C0; }
  .chart-fill.red { background: #B53030; }

  .chart-val { width: 32px; text-align: right; font-weight: 600; color: var(--ink); font-size: 12px; }

  /* GRID LAYOUT */
  .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
  .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }

  /* TOAST */
  .toast-container {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 999;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .toast {
    background: var(--ink);
    color: #fff;
    padding: 11px 16px;
    border-radius: var(--radius);
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
    animation: slideUp 0.25s ease;
    box-shadow: var(--shadow);
  }

  .toast.success { background: var(--accent); }
  .toast.danger { background: var(--danger); }

  @keyframes slideUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* EMPTY STATE */
  .empty-state {
    text-align: center;
    padding: 48px 20px;
    color: var(--ink3);
  }

  .empty-state i { font-size: 40px; display: block; margin-bottom: 12px; }
  .empty-state p { font-size: 13.5px; }

  /* PAGINATION */
  .pagination {
    display: flex;
    align-items: center;
    gap: 4px;
    justify-content: flex-end;
    padding: 14px 20px;
    border-top: 1px solid var(--border-soft);
  }

  .page-btn {
    padding: 5px 10px;
    border-radius: var(--radius);
    border: 1px solid var(--border);
    background: transparent;
    color: var(--ink2);
    font-size: 12px;
    cursor: pointer;
    transition: all 0.1s;
  }

  .page-btn.active, .page-btn:hover { background: var(--accent); color: #fff; border-color: var(--accent); }

  /* RECENT ACTIVITY */
  .activity-list { display: flex; flex-direction: column; }

  .activity-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--border-soft);
  }

  .activity-item:last-child { border-bottom: none; }

  .activity-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    margin-top: 5px;
    flex-shrink: 0;
  }

  .dot-green { background: var(--accent); }
  .dot-amber { background: #D4851A; }
  .dot-red { background: var(--danger); }
  .dot-blue { background: #2468C0; }

  .activity-text { font-size: 13px; color: var(--ink); line-height: 1.45; }
  .activity-time { font-size: 11.5px; color: var(--ink3); margin-top: 2px; }

  /* PROGRESS RING */
  .progress-ring { position: relative; display: inline-flex; }
  .progress-ring svg { transform: rotate(-90deg); }
  .progress-ring-label {
    position: absolute;
    inset: 0;
    display: flex; align-items: center; justify-content: center;
    flex-direction: column;
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
  }

  .progress-ring-label span { font-size: 11px; color: var(--ink3); font-weight: 400; }

  /* RETURN CONFIRM */
  .return-confirm {
    background: var(--accent-light);
    border: 1px solid rgba(45,90,61,0.2);
    border-radius: var(--radius);
    padding: 14px;
    margin-bottom: 14px;
  }

  .book-detail-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--border-soft);
  }

  .book-detail-row:last-child { border-bottom: none; }

  .book-detail-label { font-size: 11.5px; color: var(--ink3); width: 100px; flex-shrink: 0; }
  .book-detail-val { font-size: 13.5px; color: var(--ink); font-weight: 500; }

  /* RESPONSIVE */
  @media (max-width: 900px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .grid-2 { grid-template-columns: 1fr; }
  }

  @media (max-width: 640px) {
    .sidebar { transform: translateX(-100%); }
    .main { margin-left: 0; }
  }

  .section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
  }

  .section-title {
    font-family: 'Lora', serif;
    font-size: 16px;
    font-weight: 500;
    color: var(--ink);
  }

  .filter-row {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 16px;
  }

  .filter-row .form-control { width: auto; flex: 1; min-width: 160px; }

  .overdue-row { background: #fff8f8 !important; }

  .input-group {
    position: relative;
  }

  .input-group-text {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--ink3);
    font-size: 12px;
    pointer-events: none;
  }
</style>
</head>
<body>

<!-- SIDEBAR -->
<nav class="sidebar">
  <div class="sidebar-logo">
    <span class="logo-text">Perpustakaan28</span>
    <span class="logo-sub">Manajemen Perpustakaan</span>
  </div>

  <div class="sidebar-nav">
    <span class="nav-label">Menu Utama</span>
    <button class="nav-item active" onclick="showPage('dashboard', this)">
      <i class="ti ti-layout-dashboard" aria-hidden="true"></i>
      Dashboard
    </button>
    <button class="nav-item" onclick="showPage('katalog', this)">
      <i class="ti ti-books" aria-hidden="true"></i>
      Katalog & Stok Buku
    </button>
    <button class="nav-item" onclick="showPage('transaksi', this)">
      <i class="ti ti-arrows-exchange" aria-hidden="true"></i>
      Transaksi Pinjaman
    </button>
    <button class="nav-item" onclick="showPage('pengembalian', this)">
      <i class="ti ti-rotate-clockwise" aria-hidden="true"></i>
      Pengembalian Buku
    </button>
    <span class="nav-label">Laporan</span>
    <button class="nav-item" onclick="showPage('riwayat', this)">
      <i class="ti ti-history" aria-hidden="true"></i>
      Riwayat Pinjaman
    </button>
  </div>

  <div class="sidebar-footer">
    <div class="user-pill">
      <div class="user-avatar">AP</div>
      <div class="user-info">
        <div class="name">Admin Pustaka</div>
        <div class="role">Pustakawan</div>
      </div>
    </div>
  </div>
</nav>

<!-- MAIN CONTENT -->
<div class="main">
  <header class="topbar">
    <div class="topbar-title" id="page-title">Dashboard</div>
    <div class="topbar-actions">
      <span class="date-badge" id="current-date"></span>
      <button class="btn-icon" title="Notifikasi" onclick="showToast('2 buku akan jatuh tempo hari ini', 'warning')">
        <i class="ti ti-bell" aria-hidden="true"></i>
      </button>
    </div>
  </header>

  <div class="content">

    <!-- ===== DASHBOARD ===== -->
    <div class="page active" id="page-dashboard">

      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon green"><i class="ti ti-books" aria-hidden="true"></i></div>
          <div class="stat-value" id="stat-total-buku">248</div>
          <div class="stat-label">Total Judul Buku</div>
          <div class="stat-trend up"><i class="ti ti-trending-up" aria-hidden="true"></i> +5 bulan ini</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon blue"><i class="ti ti-arrows-exchange" aria-hidden="true"></i></div>
          <div class="stat-value" id="stat-aktif">23</div>
          <div class="stat-label">Pinjaman Aktif</div>
          <div class="stat-trend up"><i class="ti ti-trending-up" aria-hidden="true"></i> +3 minggu ini</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon amber"><i class="ti ti-alert-triangle" aria-hidden="true"></i></div>
          <div class="stat-value" id="stat-terlambat">4</div>
          <div class="stat-label">Terlambat Kembali</div>
          <div class="stat-trend down"><i class="ti ti-trending-down" aria-hidden="true"></i> perlu tindak lanjut</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green"><i class="ti ti-check" aria-hidden="true"></i></div>
          <div class="stat-value" id="stat-dikembalikan">187</div>
          <div class="stat-label">Dikembalikan (Total)</div>
          <div class="stat-trend up"><i class="ti ti-trending-up" aria-hidden="true"></i> +12 bulan ini</div>
        </div>
      </div>

      <div class="grid-2" style="margin-bottom: 20px;">
        <div class="card">
          <div class="card-header">
            <div class="card-title"><i class="ti ti-chart-bar"></i> Peminjaman per Kategori</div>
          </div>
          <div class="card-body">
            <div class="chart-bar-wrap">
              <div class="chart-row">
                <div class="chart-label">Fiksi</div>
                <div class="chart-track"><div class="chart-fill" style="width: 82%"></div></div>
                <div class="chart-val">41</div>
              </div>
              <div class="chart-row">
                <div class="chart-label">Sains</div>
                <div class="chart-track"><div class="chart-fill amber" style="width: 64%"></div></div>
                <div class="chart-val">32</div>
              </div>
              <div class="chart-row">
                <div class="chart-label">Sejarah</div>
                <div class="chart-track"><div class="chart-fill blue" style="width: 54%"></div></div>
                <div class="chart-val">27</div>
              </div>
              <div class="chart-row">
                <div class="chart-label">Teknologi</div>
                <div class="chart-track"><div class="chart-fill" style="width: 48%"></div></div>
                <div class="chart-val">24</div>
              </div>
              <div class="chart-row">
                <div class="chart-label">Biografi</div>
                <div class="chart-track"><div class="chart-fill red" style="width: 32%"></div></div>
                <div class="chart-val">16</div>
              </div>
              <div class="chart-row">
                <div class="chart-label">Lainnya</div>
                <div class="chart-track"><div class="chart-fill" style="width: 20%"></div></div>
                <div class="chart-val">10</div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="card-title"><i class="ti ti-activity"></i> Aktivitas Terbaru</div>
          </div>
          <div class="card-body" style="padding: 8px 20px;">
            <div class="activity-list" id="activity-list">
              <!-- filled by JS -->
            </div>
          </div>
        </div>
      </div>

      <div class="grid-2">
        <div class="card">
          <div class="card-header">
            <div class="card-title"><i class="ti ti-alert-circle"></i> Buku Jatuh Tempo Hari Ini</div>
            <span class="badge badge-red">4 buku</span>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>Judul</th>
                  <th>Peminjam</th>
                  <th>Jatuh Tempo</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="due-today-table"></tbody>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="card-title"><i class="ti ti-star"></i> Buku Terpopuler</div>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Judul Buku</th>
                  <th>Dipinjam</th>
                </tr>
              </thead>
              <tbody id="popular-table"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- ===== KATALOG ===== -->
    <div class="page" id="page-katalog">
      <div class="section-header">
        <div class="section-title">Katalog & Stok Buku</div>
        <button class="btn btn-primary" onclick="openModal('modal-tambah-buku')">
          <i class="ti ti-plus" aria-hidden="true"></i> Tambah Buku
        </button>
      </div>

      <div class="card" style="margin-bottom: 16px;">
        <div class="card-body" style="padding: 14px 16px;">
          <div class="filter-row">
            <div class="search-bar" style="flex: 2; min-width: 200px;">
              <i class="ti ti-search" aria-hidden="true"></i>
              <input class="form-control" type="text" placeholder="Cari judul, penulis, ISBN..." oninput="filterBuku(this.value)" id="search-buku">
            </div>
            <select class="form-control" style="max-width: 160px;" onchange="filterKategori(this.value)">
              <option value="">Semua Kategori</option>
              <option>Fiksi</option>
              <option>Sains</option>
              <option>Sejarah</option>
              <option>Teknologi</option>
              <option>Biografi</option>
              <option>Ensiklopedi</option>
            </select>
            <select class="form-control" style="max-width: 140px;" onchange="filterStok(this.value)">
              <option value="">Semua Stok</option>
              <option value="tersedia">Tersedia</option>
              <option value="habis">Stok Habis</option>
            </select>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Buku</th>
                <th>ISBN</th>
                <th>Kategori</th>
                <th>Stok Total</th>
                <th>Tersedia</th>
                <th>Dipinjam</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="katalog-table"></tbody>
          </table>
        </div>
        <div class="pagination" id="katalog-pagination"></div>
      </div>
    </div>

    <!-- ===== TRANSAKSI PEMINJAMAN ===== -->
    <div class="page" id="page-transaksi">
      <div class="section-header">
        <div class="section-title">Transaksi Peminjaman</div>
        <button class="btn btn-primary" onclick="openModal('modal-pinjam')">
          <i class="ti ti-plus" aria-hidden="true"></i> Buat Peminjaman
        </button>
      </div>

      <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 20px;">
        <div class="stat-card">
          <div class="stat-icon blue"><i class="ti ti-clock" aria-hidden="true"></i></div>
          <div class="stat-value" id="trans-aktif">23</div>
          <div class="stat-label">Sedang Dipinjam</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon amber"><i class="ti ti-alert-triangle" aria-hidden="true"></i></div>
          <div class="stat-value" id="trans-telat">4</div>
          <div class="stat-label">Terlambat</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green"><i class="ti ti-calendar" aria-hidden="true"></i></div>
          <div class="stat-value">7</div>
          <div class="stat-label">Jatuh Tempo Minggu Ini</div>
        </div>
      </div>

      <div class="card">
        <div class="card-body" style="padding: 14px 16px;">
          <div class="filter-row">
            <div class="search-bar" style="flex: 2; min-width: 200px;">
              <i class="ti ti-search" aria-hidden="true"></i>
              <input class="form-control" type="text" placeholder="Cari nama peminjam atau judul buku..." oninput="filterTransaksi(this.value)">
            </div>
            <select class="form-control" style="max-width: 160px;" onchange="filterStatusTransaksi(this.value)">
              <option value="">Semua Status</option>
              <option value="aktif">Aktif</option>
              <option value="terlambat">Terlambat</option>
            </select>
          </div>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>No. Transaksi</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="transaksi-table"></tbody>
          </table>
        </div>
        <div class="pagination" id="transaksi-pagination"></div>
      </div>
    </div>

    <!-- ===== PENGEMBALIAN ===== -->
    <div class="page" id="page-pengembalian">
      <div class="section-header">
        <div class="section-title">Pengembalian Buku</div>
      </div>

      <div class="grid-2">
        <div class="card">
          <div class="card-header">
            <div class="card-title"><i class="ti ti-search"></i> Cari Transaksi Aktif</div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label class="form-label">No. Transaksi / Nama Peminjam</label>
              <div class="search-bar">
                <i class="ti ti-search" aria-hidden="true"></i>
                <input class="form-control" type="text" id="return-search" placeholder="Contoh: TRX-001 atau Budi..." oninput="cariPengembalian(this.value)">
              </div>
            </div>

            <div id="return-results"></div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <div class="card-title"><i class="ti ti-clipboard-check"></i> Detail Pengembalian</div>
          </div>
          <div class="card-body" id="return-detail-panel">
            <div class="empty-state">
              <i class="ti ti-rotate-clockwise" aria-hidden="true"></i>
              <p>Cari dan pilih transaksi dari panel kiri untuk memproses pengembalian.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card" style="margin-top: 20px;">
        <div class="card-header">
          <div class="card-title"><i class="ti ti-alert-triangle"></i> Daftar Pinjaman Terlambat</div>
          <span class="badge badge-red" id="overdue-count">4 item</span>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>No. Transaksi</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Jatuh Tempo</th>
                <th>Keterlambatan</th>
                <th>Denda</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="overdue-table"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ===== RIWAYAT ===== -->
    <div class="page" id="page-riwayat">
      <div class="section-header">
        <div class="section-title">Riwayat Pinjaman</div>
        <button class="btn btn-outline" onclick="exportRiwayat()">
          <i class="ti ti-download" aria-hidden="true"></i> Export
        </button>
      </div>

      <div class="card" style="margin-bottom: 16px;">
        <div class="card-body" style="padding: 14px 16px;">
          <div class="filter-row">
            <div class="search-bar" style="flex: 2; min-width: 200px;">
              <i class="ti ti-search" aria-hidden="true"></i>
              <input class="form-control" type="text" placeholder="Cari riwayat..." oninput="filterRiwayat(this.value)">
            </div>
            <select class="form-control" style="max-width: 160px;" onchange="filterRiwayatStatus(this.value)">
              <option value="">Semua Status</option>
              <option value="dikembalikan">Dikembalikan</option>
              <option value="terlambat">Dikembalikan Terlambat</option>
            </select>
            <input class="form-control" type="month" style="max-width: 160px;" onchange="filterRiwayatBulan(this.value)">
          </div>
        </div>
      </div>

      <div class="card">
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>No. Transaksi</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Jatuh Tempo</th>
                <th>Denda</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="riwayat-table"></tbody>
          </table>
        </div>
        <div class="pagination" id="riwayat-pagination"></div>
      </div>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

<!-- ========== MODALS ========== -->

<!-- Modal Tambah Buku -->
<div class="modal-overlay" id="modal-tambah-buku">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Tambah Buku Baru</div>
      <button class="btn-icon" onclick="closeModal('modal-tambah-buku')"><i class="ti ti-x"></i></button>
    </div>
    <div class="modal-body">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Judul Buku *</label>
          <input class="form-control" type="text" id="new-judul" placeholder="Masukkan judul buku">
        </div>
        <div class="form-group">
          <label class="form-label">Penulis *</label>
          <input class="form-control" type="text" id="new-penulis" placeholder="Nama penulis">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">ISBN</label>
          <input class="form-control" type="text" id="new-isbn" placeholder="978-XXX-XXX-XXXX-X">
        </div>
        <div class="form-group">
          <label class="form-label">Kategori</label>
          <select class="form-control" id="new-kategori">
            <option>Fiksi</option>
            <option>Sains</option>
            <option>Sejarah</option>
            <option>Teknologi</option>
            <option>Biografi</option>
            <option>Ensiklopedi</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Penerbit</label>
          <input class="form-control" type="text" id="new-penerbit" placeholder="Nama penerbit">
        </div>
        <div class="form-group">
          <label class="form-label">Tahun Terbit</label>
          <input class="form-control" type="number" id="new-tahun" placeholder="2024" min="1900" max="2025">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Jumlah Stok</label>
          <input class="form-control" type="number" id="new-stok" placeholder="0" min="1">
        </div>
        <div class="form-group">
          <label class="form-label">Lokasi Rak</label>
          <input class="form-control" type="text" id="new-rak" placeholder="Contoh: A-03">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('modal-tambah-buku')">Batal</button>
      <button class="btn btn-primary" onclick="tambahBuku()"><i class="ti ti-plus"></i> Simpan Buku</button>
    </div>
  </div>
</div>

<!-- Modal Edit Buku -->
<div class="modal-overlay" id="modal-edit-buku">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Edit Data Buku</div>
      <button class="btn-icon" onclick="closeModal('modal-edit-buku')"><i class="ti ti-x"></i></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="edit-buku-id">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Judul Buku *</label>
          <input class="form-control" type="text" id="edit-judul">
        </div>
        <div class="form-group">
          <label class="form-label">Penulis *</label>
          <input class="form-control" type="text" id="edit-penulis">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">ISBN</label>
          <input class="form-control" type="text" id="edit-isbn">
        </div>
        <div class="form-group">
          <label class="form-label">Kategori</label>
          <select class="form-control" id="edit-kategori">
            <option>Fiksi</option>
            <option>Sains</option>
            <option>Sejarah</option>
            <option>Teknologi</option>
            <option>Biografi</option>
            <option>Ensiklopedi</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Jumlah Stok Total</label>
          <input class="form-control" type="number" id="edit-stok" min="0">
        </div>
        <div class="form-group">
          <label class="form-label">Lokasi Rak</label>
          <input class="form-control" type="text" id="edit-rak">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('modal-edit-buku')">Batal</button>
      <button class="btn btn-primary" onclick="simpanEditBuku()"><i class="ti ti-check"></i> Simpan Perubahan</button>
    </div>
  </div>
</div>

<!-- Modal Buat Peminjaman -->
<div class="modal-overlay" id="modal-pinjam">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Buat Transaksi Peminjaman</div>
      <button class="btn-icon" onclick="closeModal('modal-pinjam')"><i class="ti ti-x"></i></button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label class="form-label">Nama Peminjam *</label>
        <input class="form-control" type="text" id="pinjam-nama" placeholder="Nama lengkap peminjam">
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">No. KTP / NIM</label>
          <input class="form-control" type="text" id="pinjam-id" placeholder="Nomor identitas">
        </div>
        <div class="form-group">
          <label class="form-label">No. Telepon</label>
          <input class="form-control" type="text" id="pinjam-telp" placeholder="08xx-xxxx-xxxx">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Pilih Buku *</label>
        <select class="form-control" id="pinjam-buku">
          <option value="">— Pilih buku yang tersedia —</option>
        </select>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Tanggal Pinjam</label>
          <input class="form-control" type="date" id="pinjam-tanggal">
        </div>
        <div class="form-group">
          <label class="form-label">Durasi Pinjam</label>
          <select class="form-control" id="pinjam-durasi">
            <option value="7">7 hari</option>
            <option value="14" selected>14 hari</option>
            <option value="21">21 hari</option>
            <option value="30">30 hari</option>
          </select>
        </div>
      </div>
      <div id="pinjam-info-box"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('modal-pinjam')">Batal</button>
      <button class="btn btn-primary" onclick="buatPeminjaman()"><i class="ti ti-check"></i> Konfirmasi Peminjaman</button>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Kembali -->
<div class="modal-overlay" id="modal-kembali">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Proses Pengembalian Buku</div>
      <button class="btn-icon" onclick="closeModal('modal-kembali')"><i class="ti ti-x"></i></button>
    </div>
    <div class="modal-body" id="modal-kembali-body">
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('modal-kembali')">Batal</button>
      <button class="btn btn-primary" onclick="konfirmasiKembali()"><i class="ti ti-rotate-clockwise"></i> Konfirmasi Kembali</button>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast-container" id="toast-container"></div>

<script>
// ==================== DATA ====================
const DENDA_PER_HARI = 2000;

let dataBuku = [
  { id: 1, judul: "Laskar Pelangi", penulis: "Andrea Hirata", isbn: "978-979-3062-79-2", kategori: "Fiksi", penerbit: "Bentang Pustaka", tahun: 2005, stok: 5, dipinjam: 2, rak: "A-01" },
  { id: 2, judul: "Bumi Manusia", penulis: "Pramoedya Ananta Toer", isbn: "978-979-407-182-0", kategori: "Fiksi", penerbit: "Lentera Dipantara", tahun: 1980, stok: 3, dipinjam: 1, rak: "A-02" },
  { id: 3, judul: "Sapiens: Riwayat Singkat Umat Manusia", penulis: "Yuval Noah Harari", isbn: "978-0-06-231609-7", kategori: "Sejarah", penerbit: "KPG", tahun: 2015, stok: 4, dipinjam: 3, rak: "B-01" },
  { id: 4, judul: "A Brief History of Time", penulis: "Stephen Hawking", isbn: "978-0-553-38016-3", kategori: "Sains", penerbit: "Bantam Books", tahun: 1988, stok: 2, dipinjam: 2, rak: "C-01" },
  { id: 5, judul: "Pemrograman Web dengan Laravel", penulis: "Malvin Rahardja", isbn: "978-602-4381-10-5", kategori: "Teknologi", penerbit: "Andi Publisher", tahun: 2022, stok: 6, dipinjam: 1, rak: "D-01" },
  { id: 6, judul: "Steve Jobs", penulis: "Walter Isaacson", isbn: "978-1-4516-4853-9", kategori: "Biografi", penerbit: "Simon & Schuster", tahun: 2011, stok: 3, dipinjam: 0, rak: "E-01" },
  { id: 7, judul: "Cosmos", penulis: "Carl Sagan", isbn: "978-0-345-33135-9", kategori: "Sains", penerbit: "Random House", tahun: 1980, stok: 2, dipinjam: 1, rak: "C-02" },
  { id: 8, judul: "Filosofi Teras", penulis: "Henry Manampiring", isbn: "978-602-03-7342-1", kategori: "Fiksi", penerbit: "Kompas", tahun: 2018, stok: 4, dipinjam: 2, rak: "A-03" },
  { id: 9, judul: "Clean Code", penulis: "Robert C. Martin", isbn: "978-0-13-235088-4", kategori: "Teknologi", penerbit: "Prentice Hall", tahun: 2008, stok: 3, dipinjam: 2, rak: "D-02" },
  { id: 10, judul: "Ensiklopedi Nusantara", penulis: "Tim Redaksi", isbn: "978-979-788-888-8", kategori: "Ensiklopedi", penerbit: "Balai Pustaka", tahun: 2020, stok: 5, dipinjam: 0, rak: "F-01" },
  { id: 11, judul: "Harry Potter dan Batu Bertuah", penulis: "J.K. Rowling", isbn: "978-0-439-70818-8", kategori: "Fiksi", penerbit: "Gramedia", tahun: 1997, stok: 4, dipinjam: 3, rak: "A-04" },
  { id: 12, judul: "Sejarah Indonesia Modern", penulis: "M.C. Ricklefs", isbn: "978-979-526-200-7", kategori: "Sejarah", penerbit: "Serambi", tahun: 2008, stok: 2, dipinjam: 1, rak: "B-02" },
];

const today = new Date();
function dateStr(offset = 0) {
  const d = new Date(today);
  d.setDate(d.getDate() + offset);
  return d.toISOString().split('T')[0];
}

let dataTransaksi = [
  { id: "TRX-001", nama: "Budi Santoso", noId: "3578010101900001", buku: 1, tanggalPinjam: dateStr(-10), jatuhTempo: dateStr(4), status: "aktif" },
  { id: "TRX-002", nama: "Siti Rahayu", noId: "3578020202900002", buku: 3, tanggalPinjam: dateStr(-20), jatuhTempo: dateStr(-6), status: "terlambat" },
  { id: "TRX-003", nama: "Ahmad Fauzi", noId: "3578030303900003", buku: 5, tanggalPinjam: dateStr(-5), jatuhTempo: dateStr(9), status: "aktif" },
  { id: "TRX-004", nama: "Dewi Lestari", noId: "3578040404900004", buku: 2, tanggalPinjam: dateStr(-18), jatuhTempo: dateStr(-4), status: "terlambat" },
  { id: "TRX-005", nama: "Eko Prasetyo", noId: "3578050505900005", buku: 7, tanggalPinjam: dateStr(-12), jatuhTempo: dateStr(2), status: "aktif" },
  { id: "TRX-006", nama: "Fitri Handayani", noId: "3578060606900006", buku: 9, tanggalPinjam: dateStr(-30), jatuhTempo: dateStr(-16), status: "terlambat" },
  { id: "TRX-007", nama: "Gunawan Wibowo", noId: "3578070707900007", buku: 11, tanggalPinjam: dateStr(-8), jatuhTempo: dateStr(6), status: "aktif" },
  { id: "TRX-008", nama: "Hani Suryani", noId: "3578080808900008", buku: 4, tanggalPinjam: dateStr(-25), jatuhTempo: dateStr(-11), status: "terlambat" },
];

let dataRiwayat = [
  { id: "TRX-R01", nama: "Rini Wulandari", buku: 6, tanggalPinjam: dateStr(-60), tanggalKembali: dateStr(-46), jatuhTempo: dateStr(-46), denda: 0, status: "dikembalikan" },
  { id: "TRX-R02", nama: "Hendra Kusuma", buku: 1, tanggalPinjam: dateStr(-45), tanggalKembali: dateStr(-30), jatuhTempo: dateStr(-31), denda: 2000, status: "terlambat" },
  { id: "TRX-R03", nama: "Maya Sari", buku: 3, tanggalPinjam: dateStr(-40), tanggalKembali: dateStr(-26), jatuhTempo: dateStr(-26), denda: 0, status: "dikembalikan" },
  { id: "TRX-R04", nama: "Doni Pratama", buku: 8, tanggalPinjam: dateStr(-35), tanggalKembali: dateStr(-21), jatuhTempo: dateStr(-25), denda: 8000, status: "terlambat" },
  { id: "TRX-R05", nama: "Yuni Astuti", buku: 10, tanggalPinjam: dateStr(-55), tanggalKembali: dateStr(-42), jatuhTempo: dateStr(-41), denda: 2000, status: "terlambat" },
  { id: "TRX-R06", nama: "Bagas Nugroho", buku: 5, tanggalPinjam: dateStr(-28), tanggalKembali: dateStr(-14), jatuhTempo: dateStr(-14), denda: 0, status: "dikembalikan" },
  { id: "TRX-R07", nama: "Putri Cahyani", buku: 12, tanggalPinjam: dateStr(-50), tanggalKembali: dateStr(-36), jatuhTempo: dateStr(-36), denda: 0, status: "dikembalikan" },
  { id: "TRX-R08", nama: "Rio Anggara", buku: 2, tanggalPinjam: dateStr(-22), tanggalKembali: dateStr(-8), jatuhTempo: dateStr(-8), denda: 0, status: "dikembalikan" },
];

let nextTrxId = 9;
let nextBukuId = 13;
let selectedReturnTrx = null;

// ==================== UTILS ====================
const coverColors = ["#2D5A3D","#1A3D6B","#7A4F00","#6B1A1A","#3D2D5A","#1A6B5A"];
const coverEmojis = ["📚","📖","🔬","🏛️","💻","🌍","✨","🎭"];

function getCoverColor(id) { return coverColors[id % coverColors.length]; }
function getCoverEmoji(kategori) {
  const map = { "Fiksi": "📖", "Sains": "🔬", "Sejarah": "🏛️", "Teknologi": "💻", "Biografi": "👤", "Ensiklopedi": "🌍" };
  return map[kategori] || "📚";
}

function getBuku(id) { return dataBuku.find(b => b.id === id); }
function formatDate(str) {
  if (!str) return "-";
  const d = new Date(str);
  return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
}

function daysDiff(date1, date2) {
  const d1 = new Date(date1); const d2 = new Date(date2);
  return Math.round((d2 - d1) / (1000 * 60 * 60 * 24));
}

function calcDenda(jatuhTempo) {
  const keterlambatan = daysDiff(jatuhTempo, dateStr(0));
  return keterlambatan > 0 ? keterlambatan * DENDA_PER_HARI : 0;
}

function formatRupiah(num) { return "Rp " + num.toLocaleString('id-ID'); }

function showToast(msg, type = "success") {
  const tc = document.getElementById('toast-container');
  const t = document.createElement('div');
  t.className = `toast ${type}`;
  const icon = type === 'success' ? 'ti-check' : type === 'danger' ? 'ti-x' : 'ti-bell';
  t.innerHTML = `<i class="ti ${icon}" aria-hidden="true"></i> ${msg}`;
  tc.appendChild(t);
  setTimeout(() => { t.remove(); }, 3200);
}

// ==================== NAVIGATION ====================
function showPage(page, el) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  document.getElementById('page-' + page).classList.add('active');
  if (el) el.classList.add('active');
  const titles = { dashboard: 'Dashboard', katalog: 'Katalog & Stok Buku', transaksi: 'Transaksi Peminjaman', pengembalian: 'Pengembalian Buku', riwayat: 'Riwayat Pinjaman' };
  document.getElementById('page-title').textContent = titles[page] || page;
  if (page === 'katalog') renderKatalog();
  if (page === 'transaksi') renderTransaksi();
  if (page === 'pengembalian') renderPengembalian();
  if (page === 'riwayat') renderRiwayat();
}

function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

// ==================== DASHBOARD ====================
function renderDashboard() {
  // Stat update
  document.getElementById('stat-total-buku').textContent = dataBuku.length;
  const aktif = dataTransaksi.filter(t => t.status === 'aktif' || t.status === 'terlambat').length;
  const terlambat = dataTransaksi.filter(t => t.status === 'terlambat').length;
  document.getElementById('stat-aktif').textContent = aktif;
  document.getElementById('stat-terlambat').textContent = terlambat;
  document.getElementById('stat-dikembalikan').textContent = dataRiwayat.length;
  document.getElementById('trans-aktif').textContent = aktif;
  document.getElementById('trans-telat').textContent = terlambat;

  // Activity
  const acts = [
    { dot: 'dot-green', text: 'Budi Santoso meminjam <strong>Laskar Pelangi</strong>', time: '10 menit lalu' },
    { dot: 'dot-blue', text: 'Ahmad Fauzi meminjam <strong>Pemrograman Web dengan Laravel</strong>', time: '2 jam lalu' },
    { dot: 'dot-amber', text: 'Siti Rahayu terlambat mengembalikan <strong>Sapiens</strong>', time: 'Kemarin, 14:30' },
    { dot: 'dot-green', text: 'Rini Wulandari mengembalikan <strong>Steve Jobs</strong>', time: '2 hari lalu' },
    { dot: 'dot-red', text: 'Hani Suryani terlambat 11 hari — denda Rp 22.000', time: '3 hari lalu' },
  ];
  document.getElementById('activity-list').innerHTML = acts.map(a => `
    <div class="activity-item">
      <div class="activity-dot ${a.dot}"></div>
      <div>
        <div class="activity-text">${a.text}</div>
        <div class="activity-time">${a.time}</div>
      </div>
    </div>
  `).join('');

  // Due today
  const overdue = dataTransaksi.filter(t => t.status === 'terlambat');
  document.getElementById('due-today-table').innerHTML = overdue.map(t => {
    const buku = getBuku(t.buku);
    return `<tr class="overdue-row">
      <td>${buku ? buku.judul : '-'}</td>
      <td>${t.nama}</td>
      <td>${formatDate(t.jatuhTempo)}</td>
      <td><span class="badge badge-red">Terlambat</span></td>
    </tr>`;
  }).join('') || '<tr><td colspan="4"><div class="empty-state" style="padding: 20px;"><p>Tidak ada buku jatuh tempo.</p></div></td></tr>';

  // Popular
  const popular = [
    { judul: "Laskar Pelangi", dipinjam: 28 },
    { judul: "Sapiens", dipinjam: 24 },
    { judul: "Bumi Manusia", dipinjam: 21 },
    { judul: "Harry Potter", dipinjam: 19 },
    { judul: "Clean Code", dipinjam: 17 },
  ];
  document.getElementById('popular-table').innerHTML = popular.map((b, i) => `
    <tr>
      <td><span class="badge badge-gray">${i + 1}</span></td>
      <td><strong>${b.judul}</strong></td>
      <td><span class="badge badge-green">${b.dipinjam}x</span></td>
    </tr>
  `).join('');
}

// ==================== KATALOG ====================
let katalogFiltered = [...dataBuku];
let katalogPage = 1;
const katalogPerPage = 8;

function renderKatalog() {
  katalogFiltered = [...dataBuku];
  renderKatalogTable();
}

function renderKatalogTable() {
  const start = (katalogPage - 1) * katalogPerPage;
  const slice = katalogFiltered.slice(start, start + katalogPerPage);

  document.getElementById('katalog-table').innerHTML = slice.map(b => {
    const tersedia = b.stok - b.dipinjam;
    const statusBadge = tersedia === 0
      ? '<span class="badge badge-red">Stok Habis</span>'
      : tersedia <= 1
        ? '<span class="badge badge-amber">Hampir Habis</span>'
        : '<span class="badge badge-green">Tersedia</span>';

    return `<tr>
      <td>
        <div style="display: flex; align-items: center; gap: 10px;">
          <div class="book-cover" style="background: ${getCoverColor(b.id)}; color: #fff; font-size: 18px;">${getCoverEmoji(b.kategori)}</div>
          <div>
            <div style="font-weight: 500;">${b.judul}</div>
            <div class="cell-muted">${b.penulis} · ${b.tahun}</div>
          </div>
        </div>
      </td>
      <td class="cell-muted">${b.isbn}</td>
      <td><span class="badge badge-blue">${b.kategori}</span></td>
      <td style="text-align: center; font-weight: 600;">${b.stok}</td>
      <td style="text-align: center; color: var(--accent); font-weight: 600;">${tersedia}</td>
      <td style="text-align: center; color: var(--warn); font-weight: 600;">${b.dipinjam}</td>
      <td>${statusBadge}</td>
      <td>
        <div style="display: flex; gap: 6px;">
          <button class="btn btn-sm btn-outline" onclick="editBuku(${b.id})"><i class="ti ti-edit"></i></button>
          <button class="btn btn-sm btn-danger" onclick="hapusBuku(${b.id})"><i class="ti ti-trash"></i></button>
        </div>
      </td>
    </tr>`;
  }).join('') || `<tr><td colspan="8"><div class="empty-state"><i class="ti ti-book-off"></i><p>Tidak ada buku ditemukan.</p></div></td></tr>`;

  const totalPages = Math.ceil(katalogFiltered.length / katalogPerPage);
  let pag = '';
  for (let i = 1; i <= totalPages; i++) {
    pag += `<button class="page-btn ${i === katalogPage ? 'active' : ''}" onclick="setKatalogPage(${i})">${i}</button>`;
  }
  document.getElementById('katalog-pagination').innerHTML = `<span style="font-size: 12px; color: var(--ink3); margin-right: 8px;">${katalogFiltered.length} buku</span>` + pag;
}

function setKatalogPage(p) { katalogPage = p; renderKatalogTable(); }

function filterBuku(q) {
  q = q.toLowerCase();
  katalogFiltered = dataBuku.filter(b =>
    b.judul.toLowerCase().includes(q) ||
    b.penulis.toLowerCase().includes(q) ||
    b.isbn.includes(q)
  );
  katalogPage = 1;
  renderKatalogTable();
}

function filterKategori(v) {
  katalogFiltered = v ? dataBuku.filter(b => b.kategori === v) : [...dataBuku];
  katalogPage = 1;
  renderKatalogTable();
}

function filterStok(v) {
  katalogFiltered = !v ? [...dataBuku] : v === 'tersedia'
    ? dataBuku.filter(b => b.stok - b.dipinjam > 0)
    : dataBuku.filter(b => b.stok - b.dipinjam === 0);
  katalogPage = 1;
  renderKatalogTable();
}

function tambahBuku() {
  const judul = document.getElementById('new-judul').value.trim();
  const penulis = document.getElementById('new-penulis').value.trim();
  if (!judul || !penulis) { showToast('Judul dan penulis wajib diisi!', 'danger'); return; }
  dataBuku.push({
    id: nextBukuId++,
    judul, penulis,
    isbn: document.getElementById('new-isbn').value || '-',
    kategori: document.getElementById('new-kategori').value,
    penerbit: document.getElementById('new-penerbit').value || '-',
    tahun: parseInt(document.getElementById('new-tahun').value) || 2024,
    stok: parseInt(document.getElementById('new-stok').value) || 1,
    dipinjam: 0,
    rak: document.getElementById('new-rak').value || 'A-01'
  });
  closeModal('modal-tambah-buku');
  showToast(`Buku "${judul}" berhasil ditambahkan.`);
  ['new-judul','new-penulis','new-isbn','new-penerbit','new-tahun','new-stok','new-rak'].forEach(id => document.getElementById(id).value = '');
  renderKatalog();
  renderDashboard();
}

function editBuku(id) {
  const b = getBuku(id);
  if (!b) return;
  document.getElementById('edit-buku-id').value = id;
  document.getElementById('edit-judul').value = b.judul;
  document.getElementById('edit-penulis').value = b.penulis;
  document.getElementById('edit-isbn').value = b.isbn;
  document.getElementById('edit-kategori').value = b.kategori;
  document.getElementById('edit-stok').value = b.stok;
  document.getElementById('edit-rak').value = b.rak;
  openModal('modal-edit-buku');
}

function simpanEditBuku() {
  const id = parseInt(document.getElementById('edit-buku-id').value);
  const b = getBuku(id);
  if (!b) return;
  b.judul = document.getElementById('edit-judul').value;
  b.penulis = document.getElementById('edit-penulis').value;
  b.isbn = document.getElementById('edit-isbn').value;
  b.kategori = document.getElementById('edit-kategori').value;
  b.stok = parseInt(document.getElementById('edit-stok').value) || b.stok;
  b.rak = document.getElementById('edit-rak').value;
  closeModal('modal-edit-buku');
  showToast(`Data "${b.judul}" berhasil diperbarui.`);
  renderKatalogTable();
}

function hapusBuku(id) {
  const b = getBuku(id);
  if (!b) return;
  if (b.dipinjam > 0) { showToast('Tidak bisa menghapus buku yang sedang dipinjam!', 'danger'); return; }
  if (!confirm(`Hapus "${b.judul}" dari katalog?`)) return;
  dataBuku = dataBuku.filter(x => x.id !== id);
  showToast(`Buku "${b.judul}" dihapus dari katalog.`);
  renderKatalog();
  renderDashboard();
}

// ==================== TRANSAKSI ====================
let transaksiFiltered = [...dataTransaksi];
let transaksiPage = 1;
const transaksiPerPage = 8;

function renderTransaksi() {
  transaksiFiltered = [...dataTransaksi];
  renderTransaksiTable();
  populateBukuSelect();
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('pinjam-tanggal').value = today;
}

function renderTransaksiTable() {
  const start = (transaksiPage - 1) * transaksiPerPage;
  const slice = transaksiFiltered.slice(start, start + transaksiPerPage);

  document.getElementById('transaksi-table').innerHTML = slice.map(t => {
    const buku = getBuku(t.buku);
    const isLate = t.status === 'terlambat';
    const denda = isLate ? calcDenda(t.jatuhTempo) : 0;
    const keterlambatan = isLate ? Math.abs(daysDiff(t.jatuhTempo, dateStr(0))) : 0;
    return `<tr class="${isLate ? 'overdue-row' : ''}">
      <td><span class="badge badge-gray">${t.id}</span></td>
      <td>
        <div style="font-weight: 500;">${t.nama}</div>
        <div class="cell-muted">${t.noId}</div>
      </td>
      <td>${buku ? buku.judul : '-'}</td>
      <td class="cell-muted">${formatDate(t.tanggalPinjam)}</td>
      <td class="${isLate ? 'badge-red' : ''}" style="font-size: 13px;">${formatDate(t.jatuhTempo)}</td>
      <td>
        ${isLate
          ? `<span class="badge badge-red"><i class="ti ti-alert-triangle" style="font-size:11px;"></i> Terlambat ${keterlambatan}h · ${formatRupiah(denda)}</span>`
          : '<span class="badge badge-green"><i class="ti ti-clock" style="font-size:11px;"></i> Aktif</span>'
        }
      </td>
      <td>
        <button class="btn btn-sm btn-primary" onclick="prosesKembaliDariTransaksi('${t.id}')">
          <i class="ti ti-rotate-clockwise"></i> Kembalikan
        </button>
      </td>
    </tr>`;
  }).join('') || `<tr><td colspan="7"><div class="empty-state"><i class="ti ti-book-off"></i><p>Tidak ada transaksi aktif.</p></div></td></tr>`;

  const total = transaksiFiltered.length;
  let pag = '';
  const totalPages = Math.ceil(total / transaksiPerPage);
  for (let i = 1; i <= totalPages; i++) {
    pag += `<button class="page-btn ${i === transaksiPage ? 'active' : ''}" onclick="setTransaksiPage(${i})">${i}</button>`;
  }
  document.getElementById('transaksi-pagination').innerHTML = `<span style="font-size: 12px; color: var(--ink3); margin-right: 8px;">${total} transaksi aktif</span>` + pag;
}

function setTransaksiPage(p) { transaksiPage = p; renderTransaksiTable(); }

function filterTransaksi(q) {
  q = q.toLowerCase();
  transaksiFiltered = dataTransaksi.filter(t => {
    const b = getBuku(t.buku);
    return t.nama.toLowerCase().includes(q) || (b && b.judul.toLowerCase().includes(q)) || t.id.toLowerCase().includes(q);
  });
  transaksiPage = 1;
  renderTransaksiTable();
}

function filterStatusTransaksi(v) {
  transaksiFiltered = v ? dataTransaksi.filter(t => t.status === v) : [...dataTransaksi];
  transaksiPage = 1;
  renderTransaksiTable();
}

function populateBukuSelect() {
  const sel = document.getElementById('pinjam-buku');
  sel.innerHTML = '<option value="">— Pilih buku yang tersedia —</option>';
  dataBuku.filter(b => b.stok - b.dipinjam > 0).forEach(b => {
    const tersedia = b.stok - b.dipinjam;
    sel.innerHTML += `<option value="${b.id}">${b.judul} — ${b.penulis} (${tersedia} tersedia)</option>`;
  });
}

function buatPeminjaman() {
  const nama = document.getElementById('pinjam-nama').value.trim();
  const noId = document.getElementById('pinjam-id').value.trim();
  const bukuId = parseInt(document.getElementById('pinjam-buku').value);
  const tanggal = document.getElementById('pinjam-tanggal').value;
  const durasi = parseInt(document.getElementById('pinjam-durasi').value);

  if (!nama || !bukuId || !tanggal) { showToast('Nama, buku, dan tanggal wajib diisi!', 'danger'); return; }

  const buku = getBuku(bukuId);
  if (!buku || buku.stok - buku.dipinjam <= 0) { showToast('Stok buku habis!', 'danger'); return; }

  const jatuhTempo = new Date(tanggal);
  jatuhTempo.setDate(jatuhTempo.getDate() + durasi);
  const jatuhTempoStr = jatuhTempo.toISOString().split('T')[0];
  const trxId = `TRX-${String(nextTrxId++).padStart(3, '0')}`;

  dataTransaksi.unshift({ id: trxId, nama, noId: noId || '-', buku: bukuId, tanggalPinjam: tanggal, jatuhTempo: jatuhTempoStr, status: 'aktif' });
  buku.dipinjam++;

  closeModal('modal-pinjam');
  showToast(`Peminjaman ${trxId} berhasil dibuat untuk ${nama}.`);
  ['pinjam-nama','pinjam-id','pinjam-telp'].forEach(id => document.getElementById(id).value = '');
  document.getElementById('pinjam-info-box').innerHTML = '';
  renderTransaksiTable();
  renderDashboard();
}

// ==================== PENGEMBALIAN ====================
function renderPengembalian() {
  const overdue = dataTransaksi.filter(t => t.status === 'terlambat');
  document.getElementById('overdue-count').textContent = `${overdue.length} item`;

  document.getElementById('overdue-table').innerHTML = overdue.map(t => {
    const buku = getBuku(t.buku);
    const hari = Math.abs(daysDiff(t.jatuhTempo, dateStr(0)));
    const denda = hari * DENDA_PER_HARI;
    return `<tr class="overdue-row">
      <td><span class="badge badge-gray">${t.id}</span></td>
      <td><strong>${t.nama}</strong></td>
      <td>${buku ? buku.judul : '-'}</td>
      <td>${formatDate(t.jatuhTempo)}</td>
      <td><span class="badge badge-red">${hari} hari</span></td>
      <td style="font-weight: 600; color: var(--danger);">${formatRupiah(denda)}</td>
      <td>
        <button class="btn btn-sm btn-primary" onclick="prosesKembali('${t.id}')">
          <i class="ti ti-rotate-clockwise"></i> Proses
        </button>
      </td>
    </tr>`;
  }).join('') || `<tr><td colspan="7"><div class="empty-state" style="padding: 20px;"><i class="ti ti-check"></i><p>Tidak ada pinjaman terlambat. 🎉</p></div></td></tr>`;
}

function cariPengembalian(q) {
  if (!q) { document.getElementById('return-results').innerHTML = ''; return; }
  q = q.toLowerCase();
  const results = dataTransaksi.filter(t =>
    t.id.toLowerCase().includes(q) || t.nama.toLowerCase().includes(q)
  );

  if (!results.length) {
    document.getElementById('return-results').innerHTML = '<div class="alert alert-danger"><i class="ti ti-x"></i> Tidak ada transaksi ditemukan.</div>';
    return;
  }

  document.getElementById('return-results').innerHTML = results.map(t => {
    const buku = getBuku(t.buku);
    const isLate = t.status === 'terlambat';
    return `<div style="border: 1px solid var(--border); border-radius: var(--radius); padding: 12px; margin-bottom: 8px; cursor: pointer; transition: all 0.15s;"
      onclick="pilihTransaksiKembali('${t.id}')"
      onmouseover="this.style.background='var(--bg)'" onmouseout="this.style.background=''">
      <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
          <span class="badge badge-gray" style="margin-bottom: 4px;">${t.id}</span>
          <div style="font-weight: 500; margin-top: 4px;">${t.nama}</div>
          <div class="cell-muted" style="margin-top: 2px;">${buku ? buku.judul : '-'}</div>
        </div>
        <div style="text-align: right;">
          ${isLate ? `<span class="badge badge-red">Terlambat</span>` : '<span class="badge badge-green">Tepat Waktu</span>'}
          <div class="cell-muted" style="margin-top: 4px;">Jatuh tempo: ${formatDate(t.jatuhTempo)}</div>
        </div>
      </div>
    </div>`;
  }).join('');
}

function pilihTransaksiKembali(id) {
  const t = dataTransaksi.find(x => x.id === id);
  if (!t) return;
  selectedReturnTrx = t;

  const buku = getBuku(t.buku);
  const isLate = t.status === 'terlambat';
  const hari = isLate ? Math.abs(daysDiff(t.jatuhTempo, dateStr(0))) : 0;
  const denda = hari * DENDA_PER_HARI;

  document.getElementById('return-detail-panel').innerHTML = `
    <div class="return-confirm">
      <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--accent); margin-bottom: 8px;">Ringkasan Pengembalian</div>
      <div class="book-detail-row">
        <div class="book-detail-label">No. Transaksi</div>
        <div class="book-detail-val">${t.id}</div>
      </div>
      <div class="book-detail-row">
        <div class="book-detail-label">Peminjam</div>
        <div class="book-detail-val">${t.nama}</div>
      </div>
      <div class="book-detail-row">
        <div class="book-detail-label">Buku</div>
        <div class="book-detail-val">${buku ? buku.judul : '-'}</div>
      </div>
      <div class="book-detail-row">
        <div class="book-detail-label">Tgl Pinjam</div>
        <div class="book-detail-val">${formatDate(t.tanggalPinjam)}</div>
      </div>
      <div class="book-detail-row">
        <div class="book-detail-label">Jatuh Tempo</div>
        <div class="book-detail-val">${formatDate(t.jatuhTempo)}</div>
      </div>
      <div class="book-detail-row">
        <div class="book-detail-label">Status</div>
        <div class="book-detail-val">
          ${isLate ? `<span class="badge badge-red">Terlambat ${hari} hari</span>` : '<span class="badge badge-green">Tepat Waktu</span>'}
        </div>
      </div>
      ${denda > 0 ? `<div class="book-detail-row">
        <div class="book-detail-label">Denda</div>
        <div class="book-detail-val" style="color: var(--danger); font-weight: 600;">${formatRupiah(denda)}</div>
      </div>` : ''}
    </div>
    <button class="btn btn-primary" style="width: 100%;" onclick="prosesKembali('${t.id}')">
      <i class="ti ti-rotate-clockwise"></i> Proses Pengembalian
    </button>
  `;
}

function prosesKembali(id) {
  const t = dataTransaksi.find(x => x.id === id);
  if (!t) return;
  const buku = getBuku(t.buku);
  const isLate = t.status === 'terlambat';
  const hari = isLate ? Math.abs(daysDiff(t.jatuhTempo, dateStr(0))) : 0;
  const denda = hari * DENDA_PER_HARI;

  document.getElementById('modal-kembali-body').innerHTML = `
    <div class="return-confirm">
      <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--accent); margin-bottom: 8px;">Konfirmasi Pengembalian</div>
      <div class="book-detail-row">
        <div class="book-detail-label">No. Transaksi</div>
        <div class="book-detail-val">${t.id}</div>
      </div>
      <div class="book-detail-row">
        <div class="book-detail-label">Peminjam</div>
        <div class="book-detail-val">${t.nama}</div>
      </div>
      <div class="book-detail-row">
        <div class="book-detail-label">Buku</div>
        <div class="book-detail-val">${buku ? buku.judul : '-'}</div>
      </div>
      ${denda > 0 ? `
        <div style="margin-top: 12px;" class="alert alert-warning">
          <i class="ti ti-alert-triangle"></i>
          <div><strong>Terlambat ${hari} hari.</strong> Denda yang harus dibayar: <strong>${formatRupiah(denda)}</strong></div>
        </div>
      ` : `
        <div style="margin-top: 12px;" class="alert alert-success">
          <i class="ti ti-check"></i> Pengembalian tepat waktu. Tidak ada denda.
        </div>
      `}
    </div>
  `;
  document.getElementById('modal-kembali').dataset.trxId = id;
  openModal('modal-kembali');
}

function prosesKembaliDariTransaksi(id) {
  prosesKembali(id);
}

function konfirmasiKembali() {
  const id = document.getElementById('modal-kembali').dataset.trxId;
  const idx = dataTransaksi.findIndex(x => x.id === id);
  if (idx === -1) return;
  const t = dataTransaksi[idx];
  const buku = getBuku(t.buku);
  const isLate = t.status === 'terlambat';
  const hari = isLate ? Math.abs(daysDiff(t.jatuhTempo, dateStr(0))) : 0;
  const denda = hari * DENDA_PER_HARI;

  // Move to riwayat
  dataRiwayat.unshift({
    id: t.id, nama: t.nama, buku: t.buku,
    tanggalPinjam: t.tanggalPinjam,
    tanggalKembali: dateStr(0),
    jatuhTempo: t.jatuhTempo,
    denda,
    status: isLate ? 'terlambat' : 'dikembalikan'
  });

  // Remove from active
  dataTransaksi.splice(idx, 1);
  if (buku) buku.dipinjam = Math.max(0, buku.dipinjam - 1);

  closeModal('modal-kembali');
  showToast(`${t.id} — Pengembalian berhasil dicatat.`);
  renderTransaksiTable();
  renderPengembalian();
  renderDashboard();
  document.getElementById('return-detail-panel').innerHTML = `<div class="empty-state"><i class="ti ti-check-circle"></i><p>Pengembalian berhasil diproses.</p></div>`;
  document.getElementById('return-search').value = '';
  document.getElementById('return-results').innerHTML = '';
}

// ==================== RIWAYAT ====================
let riwayatFiltered = [...dataRiwayat];
let riwayatPage = 1;
const riwayatPerPage = 10;

function renderRiwayat() {
  riwayatFiltered = [...dataRiwayat];
  renderRiwayatTable();
}

function renderRiwayatTable() {
  const start = (riwayatPage - 1) * riwayatPerPage;
  const slice = riwayatFiltered.slice(start, start + riwayatPerPage);

  document.getElementById('riwayat-table').innerHTML = slice.map(r => {
    const buku = getBuku(r.buku);
    const isLate = r.status === 'terlambat';
    return `<tr>
      <td><span class="badge badge-gray">${r.id}</span></td>
      <td><strong>${r.nama}</strong></td>
      <td>${buku ? buku.judul : '-'}</td>
      <td class="cell-muted">${formatDate(r.tanggalPinjam)}</td>
      <td class="cell-muted">${formatDate(r.tanggalKembali)}</td>
      <td class="cell-muted">${formatDate(r.jatuhTempo)}</td>
      <td style="${r.denda > 0 ? 'color: var(--danger); font-weight: 600;' : 'color: var(--ink3);'}">
        ${r.denda > 0 ? formatRupiah(r.denda) : '—'}
      </td>
      <td>
        ${isLate
          ? '<span class="badge badge-amber"><i class="ti ti-clock" style="font-size:11px;"></i> Terlambat</span>'
          : '<span class="badge badge-green"><i class="ti ti-check" style="font-size:11px;"></i> Tepat Waktu</span>'
        }
      </td>
    </tr>`;
  }).join('') || `<tr><td colspan="8"><div class="empty-state"><i class="ti ti-history"></i><p>Belum ada riwayat peminjaman.</p></div></td></tr>`;

  const totalPages = Math.ceil(riwayatFiltered.length / riwayatPerPage);
  let pag = '';
  for (let i = 1; i <= totalPages; i++) {
    pag += `<button class="page-btn ${i === riwayatPage ? 'active' : ''}" onclick="setRiwayatPage(${i})">${i}</button>`;
  }
  document.getElementById('riwayat-pagination').innerHTML =
    `<span style="font-size: 12px; color: var(--ink3); margin-right: 8px;">${riwayatFiltered.length} catatan</span>` + pag;
}

function setRiwayatPage(p) { riwayatPage = p; renderRiwayatTable(); }

function filterRiwayat(q) {
  q = q.toLowerCase();
  riwayatFiltered = dataRiwayat.filter(r => {
    const b = getBuku(r.buku);
    return r.nama.toLowerCase().includes(q) || r.id.toLowerCase().includes(q) || (b && b.judul.toLowerCase().includes(q));
  });
  riwayatPage = 1;
  renderRiwayatTable();
}

function filterRiwayatStatus(v) {
  riwayatFiltered = v ? dataRiwayat.filter(r => r.status === v) : [...dataRiwayat];
  riwayatPage = 1;
  renderRiwayatTable();
}

function filterRiwayatBulan(v) {
  if (!v) { riwayatFiltered = [...dataRiwayat]; }
  else {
    riwayatFiltered = dataRiwayat.filter(r => r.tanggalPinjam && r.tanggalPinjam.startsWith(v));
  }
  riwayatPage = 1;
  renderRiwayatTable();
}

function exportRiwayat() {
  const rows = [['No. Transaksi','Peminjam','Buku','Tgl Pinjam','Tgl Kembali','Jatuh Tempo','Denda','Status']];
  dataRiwayat.forEach(r => {
    const b = getBuku(r.buku);
    rows.push([r.id, r.nama, b ? b.judul : '-', r.tanggalPinjam, r.tanggalKembali, r.jatuhTempo, r.denda, r.status]);
  });
  const csv = rows.map(r => r.join(',')).join('\n');
  const blob = new Blob([csv], { type: 'text/csv' });
  const a = document.createElement('a');
  a.href = URL.createObjectURL(blob);
  a.download = 'riwayat-peminjaman.csv';
  a.click();
  showToast('Export CSV berhasil diunduh.');
}

// ==================== INIT ====================
document.addEventListener('DOMContentLoaded', () => {
  const d = new Date();
  document.getElementById('current-date').textContent = d.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'long', year: 'numeric' });
  renderDashboard();
});

document.querySelectorAll('.modal-overlay').forEach(overlay => {
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) overlay.classList.remove('open');
  });
});
</script>
</body>
</html>
