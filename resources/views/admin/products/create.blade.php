<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="{{ asset('css/products.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>
  <div class="form-container">
    <div class="form-header">
      <a href="{{ route('products.index') }}" class="btn-back">← Kembali</a>
      <h2>Tambah Produk Baru</h2>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="number" class="form-control" name="price" value="{{ old('price') }}" required>
      </div>

      <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" name="gender" required>
          <option value="">-- Pilih Gender --</option>
          @foreach ($genders as $gender)
        <option value="{{ $gender }}" {{ old('gender') == $gender ? 'selected' : '' }}>
        {{ ucfirst($gender) }}
        </option>
      @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select class="form-select" name="category_id" required>
          <option value="">-- Pilih Kategori --</option>
          @foreach ($categories as $cat)
        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
        {{ $cat->name }}
        </option>
      @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Gambar Produk</label>
        <input type="file" class="form-control" name="image" accept="image/*">
      </div>

      <button type="submit" class="btn btn-primary">Simpan Produk</button>
    </form>
  </div>
</body>

</html>