<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="Content-Type" content="text/html" ; charset="utf-8" />
      <title>Laporan</title>
      <style>
         * {
            box-sizing: border-box;
         }

         .table {
            width: 100%;
            border-collapse: collapse;
            page-break-after: always;
         }

         .table td,
         .table th {
            text-align: center;
         }

         .table th {
            background-color: #4154F1;
            color: black;
         }

         .table tbody:nth-child(even) {
            background-color: #f5f5f5;
         }

         .title {
            color: #adadad;
            text-align: center;
         }

         .subtitle a {
            color: white;
            text-decoration: none;
            float: left;
            padding-top: 1px;
         }

         .subtitle a:hover {
            color: #dbd7e6;
            text-decoration: none;
         }

         .form-control {
         }

         .btn {
            background-color: #4154F1;
            color: white;
         }

         body {
            margin: 0;
         }
      </style>
   </head>
   <body>
      <div class="container">
        
         <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200 align-self-center text-center">Laporan pdf </h2>
         
<table class="table mt-3" cellpadding="10" cellspace="0">
  
   
    <thead class="align-self-center text-center">
     
      <tr>          
         <th scope="col">Nama barang</th>
         <th scope="col">Nama user</th>
         <th scope="col">Tanggal mulai</th>
         <th scope="col">Harga akhir</th>
         <th scope="col">Harga yang terakhir di tawarkan</th>                        
            
       </tr>
        
    </thead>
   
   
    <tbody>
      @foreach ($datas as $key)  
      <tr>
        
        <td scope="row">{{ $key->barangs->name }}</td>
        <td>{{ $key->iduser->name }}</td>
        <td>{{ $key->barangs->waktu }}</td>
        <td>
          Rp. {{number_format($key->silelang->harga_akhir, 0, '', '.') }}
          
        </td>
        <td>
          Rp. {{number_format($banyak, 0, '', '.') }}              
        </td>                               
      </tr>
  
      @endforeach
    </tbody>
   
   

</table>
			
      </div>
   </body>
</html>
