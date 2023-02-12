@extends('layouts.dashboard')
@section('isi')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">
@foreach ($datas as $key )
    

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="/assets/images/barang/{{ $key->image }}" alt="Profile" class="rounded-circle">
            <h2>{{ $key->name }}</h2>
            <form action="{{ route('status',$id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="ditutup">
                


           
                
                
                <button type="submit" class="btn btn-primary mt-4">Tutup</button>
            </form>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">{{ $key->deskripsi_awal }}</p>

                <h5 class="card-title">Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{ $key->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Harga awal</div>
                  <div class="col-lg-9 col-md-8">{{number_format($key->harga_awal, 0, '', '.') }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Penawaran tertinggi</div>
                    <div class="col-lg-9 col-md-8"><span class="card text-bg-primary text-bold p-1 text-white text-center">{{number_format($ke, 0, '', '.') }}</span></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Status</div>
                
                    <div class="col-lg-9 col-md-8">@if ( $key->status === "dibuka" )
                        <span class="card text-bg-success p-1 text-white text-center">Masih di buka</span>
                        @else
                        <span class="card text-bg-danger p-1 text-white text-center">Sudah di tutup</span>
                        @endif   </div>
                
                  </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nama Akun pemilik</div>
                  <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                </div>

               

              </div>
              @endforeach              

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection