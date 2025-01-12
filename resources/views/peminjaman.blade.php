@extends('layouts.index')
@section('title', 'Form Pinjaman')

@section('style')
@endsection

@section('content')
    <section class="bg-white  dark:bg-gray-900 mx-auto lg:mx-20">
        <div class="container flex flex-col justify-center px-6 py-8 mx-auto">
            <div class="max-w-full mb-6 font-bold text-gray-500 lg:mb-8 dark:text-gray-400">
                <p class="text-4xl text-center">
                    Aplikasi Penyewaan Mobil
                </p>
            </div>
            <div class="max-w-full mb-6 font-bold text-gray-500 lg:mb-8 dark:text-gray-400">
                <p class="text-3xl mb-2">
                    Selamat Datang
                </p>
                <p class="text-2xl">
                    {{ $dataUser->nama }}
                </p>
                <p class="text-xl">
                    {{ $dataUser->no_sim }}
                </p>
            </div>

            <div class="max-w-fit mt-20 font-bold text-gray-500 lg:mb-8 dark:text-gray-400 border p-6 rounded-xl">
                <p class="text-xl mb-6 text-white">
                    Silahkan menentukan tanggal penyewaan
                </p>
                <form class="max-w-lg" action="{{ route('cek_mobil') }}" method="POST">
                    @csrf
                    <div class="flex gap-3 mb-5">
                        <div class="w-full">
                            <label for="tanggal_mulai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                Peminjaman</label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('tanggal_mulai') }}" required />
                        </div>
                        <div class="w-full">
                            <label for="tanggal_selesai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                Pengembalian</label>
                            <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('tanggal_selesai') }}" required />
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>


            <div class="max-w-full mb-6 font-bold text-gray-500 lg:mb-8 dark:text-gray-400">
                <p class="text-2xl text-center mb-6">
                    Mobil Yang Tersedia Untuk Hari Ini
                </p>
                <div class="flex gap-6">
                    <div class="overflow-x-auto mx-auto">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 lg:gap-8">
                            @if ($request->tanggal_mulai && $request->tanggal_selesai)
                                @if ($availableMobil)
                                    @foreach ($availableMobil as $mobil)
                                        <div class="card bg-base-100 w-auto shadow-xl">
                                            <figure>
                                                <img src="https://auto2000.co.id/berita-dan-tips/_next/image?url=https%3A%2F%2Fastradigitaldigiroomuat.blob.core.windows.net%2Fstorage-uat-001%2Fmobil-offroad.jpg&w=800&q=75"
                                                    alt="Shoes" />
                                            </figure>
                                            <div class="card-body">
                                                <h2 class="card-title">
                                                    Nama Merk
                                                    <div class="badge badge-primary">Model</div>
                                                </h2>
                                                <p>AB 1234 CE</p>
                                                <p class="badge badge-info">Rp. 500.000 /hari</p>


                                                <div class="card-actions justify-end mt-2">
                                                    <div class="btn btn-accent rounded-xl">Lakukan Peminjaman</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center">Tidak Ada Mobil Yang Tersedia Untuk Hari Ini</p>
                                @endif
                            @elseif ($semuaMobil)
                                @foreach ($semuaMobil as $mobil)
                                    <div class="card bg-base-100 w-auto shadow-xl">
                                        <figure>
                                            <img src="https://auto2000.co.id/berita-dan-tips/_next/image?url=https%3A%2F%2Fastradigitaldigiroomuat.blob.core.windows.net%2Fstorage-uat-001%2Fmobil-offroad.jpg&w=800&q=75"
                                                alt="Shoes" />
                                        </figure>
                                        <div class="card-body">
                                            <h2 class="card-title">
                                                {{ $mobil->merk }}
                                                <div class="badge badge-primary">{{ $mobil->model }}</div>
                                            </h2>
                                            <p>{{ $mobil->no_plat }}</p>
                                            <p class="badge badge-info">Rp. {{ $mobil->harga_sewa }} /hari</p>

                                            <div class="card-actions justify-end mt-2">
                                                <div class="btn btn-accent rounded-xl">Lakukan Peminjaman</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">Tidak Ada Mobil Yang Tersedia Untuk Hari Ini</p>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
    </section>
@endsection

@section('script')
@endsection
