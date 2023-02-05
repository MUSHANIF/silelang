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
<a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah</a>
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
            <th scope="col">Deskripsi awal</th>            
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
              {{ $key->deskripsi_awal }}                           
            </td>
            <td> 
              <a href="{{ route('barang.edit',$key->id) }}" class="btn btn-success"><i class="bi bi-pencil-fill"></i></a>
            
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