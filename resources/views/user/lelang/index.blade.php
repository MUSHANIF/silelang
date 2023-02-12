@extends('layouts.dashboard')
@section('antena')
<h1>barang</h1>
<nav>
  
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/jns">barang</a></li>
    <li class="breadcrumb-item active">Home</li>
  </ol>
@endsection
@section('search')
<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->
@endsection
@section('button')
{{-- <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah</a> --}}
@endsection
@section('isi')
@if ($menang)
  

  <div class="alert alert-primary alert-dismissible fade show" role="alert">
             Selamat Anda telah memenangkan lelang untuk barang ini!.(harap klik tombol terima & ambil)
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="card text-center">
    <div class="card-body">
      <h5 class="card-title">Barang Yang anda ikuti</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover">
        @if ($datas->count())   
        <thead>
          <tr>
          
            <th scope="col">Nama barang</th>
            <th scope="col">Waktu</th>
            <th scope="col">Harga awal</th>
            <th scope="col">Harga tertinggi saat ini</th>
            <th scope="col">Harga yang anda tawarkan</th>            
            <th scope="col">Status</th>
            <th scope="col">Action</th>
       
          </tr>
        </thead>
    
          
        
        <tbody>
   
          @foreach ($datas as $key)  
          <tr>
            
            <th scope="row">{{ $key->lelang->name }}</th>
            <td>{{ $key->tgl_lelang }}</td>
            <td>
              Rp. {{number_format($key->lelang->harga_awal, 0, '', '.') }}
              
            </td>
            <td>
              Rp. {{number_format($ke, 0, '', '.') }}
              
            </td>
            <td>
              Rp. {{number_format($key->harga_akhir, 0, '', '.') }}
              @if ($ke > $key->harga_akhir )
              <a id="ganti" type="button" 
              
              data-bs-toggle="modal" data-bs-target="#exampleModal"class="btn btn-success ms-2"><i class="bi bi-pencil-fill"></i></a>

              @endif
              
            </td>
            <td>
               @if ( $key->status === "dibuka" )
              <span class="card text-bg-success p-1 text-white text-center">Masih di buka</span>
              @else
              <span class="card text-bg-danger p-1 text-white text-center">Sudah di tutup</span>
              @endif
            
            </td>
            <td> 
              @if ($menang)
              @can('lelang')
                <form action="{{ url('terima/'.$key->id) }}" method="POST" >
              @elsecan('user')  
                <form action="{{ url('terimauser/'.$key->id) }}" method="POST" >
              @endcan
              
                @csrf
                <input type="hidden" name="id_barang" value="{{ $key->id_barang }}">
                <input type="hidden" name="userid" value="{{ $key->userid }}">
                <input type="hidden" name="id" value="{{ $key->id }}">
                <input type="hidden" name="penawaran_harga" value="{{ $key->harga_akhir }}">
                @if ($key->status === "ditutup")
                <button type="submit" class="btn btn-success">Terima & ambil</button>
                @endif
              
                
            </form>
            @else
              <form action="{{ url('barang/'.$key->id) }}" method="POST" >
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                
            </form>
            @endif
          </td>
          </tr>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah harga</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  @can('lelang')
                  <form action="{{ route('ubah', $key->id) }}" method="POST">  
                    @elsecan('user')
                    <form action="{{ route('ubahuser', $key->id) }}" method="POST">
                  @endcan
                  
                    @csrf
                    
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Ubah Harga:</label>
                      {{-- <input type="text" name="id" value="{{ $key->id }}" id="id"> --}}
                      <input type="number" value="{{ $key->harga_akhir }}" id="harga_akhir" name="harga_akhir" class="form-control" id="recipient-name">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                    
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          @endforeach
          @else
            <td colspan="8">No products found</td>
          @endif
         
        </tbody>
      
      </table>
      

    </div>
  </div>

@endsection