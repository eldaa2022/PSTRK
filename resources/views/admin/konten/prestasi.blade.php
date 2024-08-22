@extends('layout.navbar_admin')
@section('judul_header', 'Prestasi')

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DATA PRESTASI</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="../assets/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: rgb(255, 255, 255) !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 1px solid black;
        }

        th {
            padding: 10px;

        }

        td {
            padding: 10px;
            vertical-align: top;
            margin-bottom: 10px;

        }

        td.deskripsi {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
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
                    <form action="/prestasi" class="form-inline w-50 float-start" method="GET">
                        @csrf
                        <input type="search" name="search" class="form-control" placeholder="Search ..." value="{{ request('search') }}">
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
                            <th scope="col">Judul</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Tanggal Publish</th>
                            <th scope="col">Lampiran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-konten">
                        @foreach ($prestasis as $index => $konten)
                        <tr id="index_{{ $konten->id }}">
                        </td>
                        <td style="text-align: center;border-bottom: none">{{ ($prestasis->currentPage() - 1) * $prestasis->perPage() + $loop->iteration }}</td>
                            <td style="border-bottom: none">{{$konten->judul}}</td>
                            <td class="deskripsi" style="border-bottom: none">{{$konten->deskripsi}}</td>
                            <td style="border-bottom: none">{{$konten->tags}}</td>
                            <td style="border-bottom: none">{{$konten->tgl_publish}}</td>
                            <td style="border-bottom: none"><img src="{{ url('/storage/foto/'.$konten->lampiran) }}" width="100" height="100"/></td>
                            <td class="text-center" style="padding-right:10px;border-bottom: none">
                                <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $konten->id }}" class="button-edit btn btn-sm">edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @endif
                @include('admin.konten.modal-create')
                @include('admin.konten.modal-update')

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $prestasis->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $prestasis->previousPageUrl() }}">Previous</a>
                        </li>

                        <!-- Pagination Elements -->
                        @foreach ($prestasis->getUrlRange(1, $prestasis->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $prestasis->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Next Page Link -->
                        <li class="page-item {{ !$prestasis->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $prestasis->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main><!-- End #main -->

    </body>
</html>
