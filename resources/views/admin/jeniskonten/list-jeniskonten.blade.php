@extends('layout.navbar_admin')
@section('judul_header', 'Jenis Konten')

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
                    <form action="/jenis_konten" class="form-inline w-50 float-start" method="GET">
                        @csrf
                        <input type="search" name="search" class="form-control" placeholder="Search ..." value="{{ request('search') }}">
                    </form>

                    <a href="javascript:void(0)" class="button-tambah ms-1 float-end" id="btn-create-post">Tambah</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Jenis Konten</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-jenis_kontens">
                        @foreach ($jenis_kontens as $index => $jenis_konten)
                        <tr id="index_{{ $jenis_konten->id }}">
                            <td style="text-align: center">{{ ($jenis_kontens->currentPage() - 1) * $jenis_kontens->perPage() + $loop->iteration }}</td>
                            <td style="text-align: center">{{ $jenis_konten->jenis }}</td>
                            <td class="text-center" style="padding-right:10px">
                                <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $jenis_konten->id }}" class="button-edit btn btn-sm">edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $jenis_kontens->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $jenis_kontens->previousPageUrl() }}">Previous</a>
                        </li>

                        <!-- Pagination Elements -->
                        @foreach ($jenis_kontens->getUrlRange(1, $jenis_kontens->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $jenis_kontens->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Next Page Link -->
                        <li class="page-item {{ !$jenis_kontens->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $jenis_kontens->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main><!-- End #main -->
    @include('admin.jeniskonten.modal-create')
    @include('admin.jeniskonten.modal-update')
    </body>
</html>
