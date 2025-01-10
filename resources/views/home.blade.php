<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Manajemen Produk</h2>
        <form action="/products" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control @error('product_code') is-invalid @enderror" name="product_code" placeholder="Kode Barang">
                    @error('product_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <select class="form-select @error('category') is-invalid @enderror" name="category">
                        <option value="">Pilih Kategori</option>
                        <option value="Kategori 1">Kategori 1</option>
                        <option value="Kategori 2">Kategori 2</option>
                        <option value="Kategori 3">Kategori 3</option>
                    </select>
                    @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-1">
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="Stok">
                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Harga">
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success w-100">Tambah Produk</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Kode Barang</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="Gambar"></td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <a href="/products/{{ $product->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/products/{{ $product->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
