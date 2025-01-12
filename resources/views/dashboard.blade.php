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
            <div class="flex gap-5">
                <a href="/peminjaman">
                    <div class="max-w-full mb-6 font-bold text-gray-500 lg:mb-8 dark:text-gray-400">
                        <div class="btn btn-success text-2xl">Melakukan Sewa Mobil</div>
                    </div>
                </a>

                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn btn-error text-2xl">Log Out</button>
                </form>

            </div>
            <div class="max-w-full mb-6 font-bold text-gray-500 lg:mb-8 dark:text-gray-400">
                <p class="text-2xl text-center mb-6">
                    Mobil Yang Sedang Disewa
                </p>
                <div class="flex gap-6">
                    <div class="overflow-x-auto mx-auto">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 lg:gap-8">
                            @foreach ($mobils as $mobil)
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
                                        <table class="items-center max-w-full text-center border">
                                            <tr>
                                                <th class="border">Tanggal Peminjaman</th>
                                                <th>Tanggal Pengembalian</th>
                                            </tr>
                                            <tr>
                                                @php
                                                    $latestPinjaman = $mobil->pinjaman->last();
                                                @endphp
                                                @if ($latestPinjaman)
                                                    <td class="border">{{ $latestPinjaman->tanggal_mulai }}</td>
                                                    <td class="border">{{ $latestPinjaman->tanggal_selesai }}</td>
                                                @else
                                                    <td colspan="2" class="border">Belum ada pinjaman</td>
                                                @endif
                                            </tr>
                                        </table>

                                        @if ($latestPinjaman->tanggal_selesai <= now()->format('Y-m-d'))
                                            <div class="badge badge-warning mt-2">Waktunya Pengembalian</div>
                                        @endif

                                        <form action="/pengembalian" method="post">
                                            @csrf
                                            <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">
                                            @php
                                                $latestPinjaman = $mobil->pinjaman->last();
                                                $tanggalMulai = $latestPinjaman->tanggal_mulai;
                                                $tanggalKembali = $latestPinjaman->tanggal_selesai;

                                                $lamanyaPinjaman = ceil(
                                                    now()->diffInDays($latestPinjaman->tanggal_mulai),
                                                );
                                                $biaya = abs($lamanyaPinjaman * $latestPinjaman->mobil->tarif);

                                            @endphp

                                            @if ($latestPinjaman->tanggal_selesai <= now()->format('Y-m-d'))
                                                <div class="card-actions justify-end mt-2">
                                                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                                        type="button">
                                                        Kembalikan
                                                    </button>

                                                    <div id="popup-modal" tabindex="-1"
                                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                                            <div class="relative bg-white rounded-lg shadow">

                                                                <div class="p-4 text-center">
                                                                    <h3 class="text-lg font-normal text-gray-500">
                                                                        Anda akan melakukan pengembalian mobil
                                                                    </h3>
                                                                    <div class="text-black">
                                                                        <p>{{ $mobil->merk }}</p>
                                                                        <p>{{ $mobil->no_plat }}</p>
                                                                        <p class="mb-5">Total Biaya : Rp.
                                                                            {{ number_format($biaya, 0, ',', '.') }}
                                                                        </p>
                                                                    </div>

                                                                    <button data-modal-hide="popup-modal" type="submit"
                                                                        class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                                                        Yes, I'm sure
                                                                    </button>
                                                                    <button data-modal-hide="popup-modal" type="button"
                                                                        class="text-gray-500 bg-white border rounded-lg text-sm px-5 py-2.5">
                                                                        No, cancel
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

                                                </div>
                                            @else
                                                <div class="card-actions justify-end mt-2">
                                                    <button type="submit" class="btn btn-accent rounded-xl"
                                                        disabled>Kembalikan</button>
                                                </div>
                                            @endif


                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="max-w-full mb-6 font-bold text-gray-500 lg:mb-8 dark:text-gray-400">
                    <p class="text-2xl text-center mb-6">
                        Riwayat Penyewaan Mobil
                    </p>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Merk
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Model
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nomor Polisi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Peminjaman
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Pengembalian
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Biaya
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayats as $riwayat)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $riwayat->mobil->merk }}
                                        </td>
                                        <th class="px-6 py-4 ">
                                            {{ $riwayat->mobil->model }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $riwayat->mobil->no_plat }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $riwayat->tanggal_pinjam }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $riwayat->tanggal_kembali }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp. {{ number_format($riwayat->biaya, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
    </section>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

@endsection
