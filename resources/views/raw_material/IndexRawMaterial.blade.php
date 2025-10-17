{{-- Ganti dengan layout utama aplikasi Anda --}}
@extends('layouts.app') 

@section('content')
<div class="container">
    <h1>Daftar Pemeriksaan Bahan Baku</h1>
    <a href="{{ route('inspections.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal Datang</th>
                <th>Bahan Baku</th>
                <th>Supplier</th>
                <th>Nopol Mobil</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inspections as $item)
            <tr>
                <td>{{ $item->setup_kedatangan }}</td>
                <td>{{ $item->bahan_baku }}</td>
                <td>{{ $item->supplier }}</td>
                <td>{{ $item->nopol_mobil }}</td>
                <td>
                    <a href="{{ route('inspections.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('inspections.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $inspections->links() }}
</div>
@endsection