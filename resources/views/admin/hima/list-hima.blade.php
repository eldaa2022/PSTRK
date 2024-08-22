@extends('layout.navbar_admin')
@section('judul_header', 'Hima')

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DATA JENIS KONTEN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="../assets/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: rgb(255, 255, 255) !important;
        }
        td {
            max-width: 400px; /* Sesuaikan dengan lebar kolom */
            white-space: normal; /* Mengizinkan teks untuk membungkus */
        }

        td.misi  , .deskripsi   {

            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 5;
            overflow: hidden;
            border: none;
        }



    </style>

    <!-- Load jQuery, Bootstrap and other dependencies in correct order -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
    <body>
        <main id="main" class="main">
            <div class="container">
                <div class="table-responsive">
                    <div class="mt-4" style="height: 60px">
                        <form action="/hima" class="form-inline w-50 float-start" method="GET">
                            @csrf
                            <input type="search" name="search" class="form-control" placeholder="Search ..." value="{{request('search')}}">
                        </form>

                        <a href="javascript:void(0)" class="button-tambah ms-1 float-end" id="btn-create-post">Tambah</a>

                    </div>

                    @if($dataKosong)
                        <div class="alert alert-warning mt-4" role="alert">
                            Data tidak ditemukan.
                        </div>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Sejarah</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Visi</th>
                                <th scope="col">Misi</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-himas">
                            @foreach ($himas as $index => $hima)
                            <tr id="index_{{$hima->id}}" >
                                <td>{{$hima->id}}</td>
                                <td>{{$hima->nama}}</td>
                                <td class="sejarah">{{$hima->sejarah}}</td>
                                <td class="deskripsi">{{$hima->deskripsi}}</td>
                                <td class="visi">{{$hima->visi}}</td>
                                <td class="misi">{{$hima->misi}}</td>
                                <td><img src="{{ url('/storage/foto/'.$hima->foto) }}" width="100" height="100"/></td>
                                <td class="text-center" style="padding-right:10px"> <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $hima->id }}" class="button-edit btn btn-sm">edit</a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @endif
                    @include('admin.hima.modal-create-hima')
                    @include('admin.hima.modal-update-hima')

                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $himas->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $himas->previousPageUrl() }}" style="te">Previous</a>
                        </li>

                        <!-- Pagination Elements -->
                        @foreach ($himas->getUrlRange(1, $himas->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $himas->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Next Page Link -->
                        <li class="page-item {{ !$himas->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $himas->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main><!-- End #main -->
    </body>
</html>
