@extends('layouts.template')
   
 @section('content')
     <div class="card card-outline card-primary">
         <div class="card-header">
             <h3 class="card-title">{{ $page->title }}</h3>
             <div class="card-tools">
                 <a class="btn btn-sm btn-primary mt-1" href="{{ url('supplier/create') }}">Tambah</a>
             </div>
         </div>
         <div class="card-body">
             @if (session('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
             @endif
             @if (session('error'))
                 <div class="alert alert-danger">{{ session('error') }}</div>
             @endif
             <table class="table-bordered table-striped table-hover table-sm table" id="table_supplier">
                 <thead>
                     <tr>
                         <th>ID Supplier</th>
                         <th>Kode</th>
                         <th>Nama</th>
                         <th>Alamat</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
             </table>
         </div>
     </div>
 @endsection
      
 @push('css')
 @endpush
      
 @push('js')
     <script>
         $(document).ready(function() {
             var dataSupplier = $('#table_supplier').DataTable({
                 serverSide: true,
                 ajax: {
                     "url": "{{ url('supplier/list') }}",
                     "dataType": "json",
                     "type": "POST",
                 },
                 columns: [
                     {
                         data: "DT_RowIndex", 
                         className: "text-center",
                         orderable: false,
                         searchable: false
                     },
                     {
                         data: "supplier_kode", 
                         className: "",
                         orderable: true,
                         searchable: true
                     },
                     {
                         data: "supplier_nama", 
                         className: "",
                         orderable: true,
                         searchable: true
                     },
                     {
                         data: "supplier_alamat", 
                         className: "",
                         orderable: true,
                         searchable: true
                     },
                     {
                         data: "aksi", 
                         className: "",
                         orderable: false,
                         searchable: false
                     }
                 ]
             });
         });
     </script>
 @endpush