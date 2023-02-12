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

@section('isi')
<div class="card text-center">
    <div class="card-body">
      <h5 class="card-title">Barang</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover">
        @if ($datas->count())   
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Nama barang</th>
            <th scope="col">Waktu</th>
            <th scope="col">Harga awal</th>
            <th scope="col">Harga akhir</th>
            <th scope="col">Status</th>            
            <th scope="col">Action</th>
       
          </tr>
        </thead>
    
          
        
        <tbody>
   
          @foreach ($datas as $key)  
          <tr>
            <td id="td"><img src="/assets/images/barang/{{ $key->image }}" style="height: 100px; width: 150px" /></td>
            <th scope="row">{{ $key->name }}</th>
            <td>{{ $key->waktu }}</td>
            <td>
              Rp. {{number_format($key->harga_awal, 0, '', '.') }}
              
            </td>
            <td>
                           
                             
                           
                        Rp. {{number_format($banyak, 0, '', '.') }}
                
            </td>
            <td>
              @if ( $key->status === "dibuka" )
              <span class="card text-bg-success p-1 text-white text-center">Masih di buka</span>
              @else
              <span class="card text-bg-danger p-1 text-white text-center">Sudah di tutup</span>
              @endif                        
            </td>
            <td> 
            
            
              <form action="{{ url('barang/'.$key->id) }}" method="POST" >
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                
            </form>
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