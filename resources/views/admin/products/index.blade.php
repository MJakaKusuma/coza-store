<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel - Produk</title>
  <link rel="stylesheet" href="{{ asset('css/products.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>

  <div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Admin Panel</h2>
      <ul>
        <li><a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.index') ? 'active' : '' }}">🛒
            Pesanan</a></li>
        <li><a href="{{ route('products.index') }}"
            class="{{ request()->routeIs('products.index') ? 'active' : '' }}">📦 Produk</a></li>
        <li><a href="#">⚙️ Pengaturan</a></li>
      </ul>

      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
      </form>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <nav class="navbar">
        <h1>Daftar Produk</h1>
        <a href="{{ route('products.create') }}" class="btn-main">+ Tambah Produk</a>
      </nav>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

      <div class="product-grid">
        @forelse ($products as $product)
        <div class="product-card">
          @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        @else
        <img src="https://via.placeholder.com/300x180?text=No+Image" alt="No image">
        @endif

          <div class="product-info">
          <h3>{{ $product->name }}</h3>
          <p class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
          <p class="meta">{{ ucfirst($product->gender) }} | {{ ucfirst($product->category->name ?? '-') }}</p>
          <small class="text-muted">Ditambahkan: {{ $product->created_at->format('d M Y') }}</small>

          <div class="actions">
            <a href="{{ route('products.edit', $product->id) }}" class="btn-action edit">Edit</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
            onsubmit="return confirm('Yakin ingin menghapus produk ini?')" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-action delete">Hapus</button>
            </form>
          </div>
          </div>
        </div>
    @empty
      <p class="text-center">Belum ada produk.</p>
    @endforelse
      </div>
    </main>
  </div>

</body>

</html>