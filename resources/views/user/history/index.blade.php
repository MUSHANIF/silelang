@extends('layouts.dashboard')
@section('antena')
<h1>barang</h1>
<nav>
  
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/jns">History</a></li>
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

@section('isi')

<div class="card text-center">
    <div class="card-body">
      <h5 class="card-title">Barang Yang anda sekarang miliki</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover">
        @if ($datas->count())   
        <thead>
          <tr>
          
            <th scope="col">Nama barang</th>
            <th scope="col">Nama user</th>
            <th scope="col">Tanggal mulai</th>
            <th scope="col">Harga akhir</th>
            <th scope="col">Harga yang anda tawarkan</th>                        
            <th scope="col">Action</th>
       
          </tr>
        </thead>
    
          
        
        <tbody>
   
          @foreach ($datas as $key)  
          <tr>
            
            <th scope="row">{{ $key->barangs->name }}</th>
            <td>{{ $key->iduser->name }}</td>
            <td>{{ $key->barangs->waktu }}</td>
            <td>
              Rp. {{number_format($key->silelang->harga_akhir, 0, '', '.') }}
              
            </td>
            <td>
              Rp. {{number_format($key->silelang->harga_akhir, 0, '', '.') }}
              
            </td>
           
            
             
          <td>
            <span class="card text-bg-success p-1 text-white text-center">SELAMAT!</span>
          </td>
          </tr>
      
          @endforeach
          @else
            <td colspan="8">No products found</td>
          @endif
         
        </tbody>
      
      </table>
      

    </div>
  </div>

@endsection