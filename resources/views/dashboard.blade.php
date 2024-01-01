@extends('layouts.master')
@section('content')
    <div class="row align-items-center">
        {{-- 1 --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-text-gray text-uppercase mb-1">
                                Jumlah Jenis Buku</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($books) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2 --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-grey text-uppercase mb-1">
                                Jumlah Stok Buku</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bookSum }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-warehouse fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3 --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-grey text-uppercase mb-1">
                                Jumlah Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($categories) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-layer-group fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4 --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-grey text-uppercase mb-1">
                                Jumlah User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ count($users) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        {{-- Bar Chart --}}
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-grey">Jumlah Jenis Buku yang Diupload per Bulan
                        {{ now()->format('Y') }}</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        {!! $createdBooksChart->container() !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-gray">Jumlah Buku per Kategori</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie p-3">
                        {!! $booksbyCategoryChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- larapex charts --}}
    <script src="{{ $booksbyCategoryChart->cdn() }}"></script>
    {{ $booksbyCategoryChart->script() }}
    <script src="{{ $createdBooksChart->cdn() }}"></script>
    {{ $createdBooksChart->script() }}
@endsection


@section('title', 'Dashboard | REN Digital Perpustkaan')
