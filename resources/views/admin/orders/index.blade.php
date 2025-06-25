<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel - Orders</title>
  <link rel="stylesheet" href="{{ asset('css/products.css') }}">
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

    <!-- Main -->
    <main class="main-content">
      <nav class="navbar">
        <h1>Daftar Pesanan</h1>
      </nav>

      @if(session('success'))
      <div class="alert">{{ session('success') }}</div>
    @endif

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Pelanggan</th>
              <th>Produk</th>
              <th>Total</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th>Ubah Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
          <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>
            @foreach ($order->products as $product)
          {{ $product->name }} (x{{ $product->pivot->quantity }})<br>
        @endforeach
            </td>
            <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
            <td>
            <span class="status-badge status-{{ $order->status }}">
              {{ ucfirst($order->status) }}
            </span>
            </td>
            <td>{{ $order->created_at->format('d M Y') }}</td>
            <td>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="status-form">
              @csrf
              @method('PATCH')
              <select name="status" onchange="this.form.submit()" class="select-status">
              <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="approved" {{ $order->status === 'approved' ? 'selected' : '' }}>Approved</option>
              <option value="reject" {{ $order->status === 'reject' ? 'selected' : '' }}>Reject</option>
              <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
              </select>
            </form>
            </td>
          </tr>
      @endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>

</html>