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

                <a href="#">
                    <div class="max-w-full mb-6 font-bold text-gray-500 lg:mb-8 dark:text-gray-400">
                        <div class="btn btn-success text-2xl">Melakukan Pengembalian</div>
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
                            @for ($i = 0; $i < 4; $i++)
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
                                        <table class="items-center max-w-full text-center border">
                                            <tr>
                                                <th class="border">Tanggal Peminjaman</th>
                                                <th>Tanggal Pengembalian</th>
                                            </tr>
                                            <tr>
                                                <td class="border">23 Oktober 2020</td>
                                                <td class="border">23 Oktober 2020</td>
                                            </tr>
                                        </table>

                                        <div class="badge badge-warning mt-2">Melebihi batas peminjaman</div>

                                        <div class="card-actions justify-end mt-2">
                                            <div class="btn btn-accent rounded-xl">Kembalikan</div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
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
                                        Tanggal
                                    </th>
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
                                        Biaya
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        23 Oktober 2020
                                    </td>
                                    <th class="px-6 py-4 ">
                                        Avansa
                                    </th>
                                    <td class="px-6 py-4">
                                        Pribadi
                                    </td>
                                    <td class="px-6 py-4">
                                        AS 1234 BE
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp. 500.000
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
    </section>
@endsection

@section('script')
@endsection
