<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-slate-800 leading-tight uppercase tracking-tighter">
            Riwayat Pesanan Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em]">
                        <tr>
                            <th class="px-8 py-5">Nomor Kamar</th>
                            <th class="px-8 py-5">Tipe</th>
                            <th class="px-8 py-5">Tgl Masuk</th>
                            <th class="px-8 py-5 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($bookings as $booking)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-8 py-6 font-bold text-slate-700">
                                #{{ $booking->kamar->no_kamar }}
                            </td>
                            <td class="px-8 py-6">
                                <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-lg text-[10px] font-bold uppercase">
                                    {{ $booking->kamar->tipe_kamar }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium text-slate-600">
                                {{ $booking->created_at->format('d M Y') }}
                            </td>
                            <td class="px-8 py-6 text-center">
                                @if($booking->status_pembayaran == 'Lunas')
                                    <span class="bg-emerald-100 text-emerald-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm border border-emerald-200">
                                        Diterima
                                    </span>
                                @elseif($booking->status_pembayaran == 'Pending')
                                    <span class="bg-amber-100 text-amber-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm border border-amber-200">
                                        Menunggu Konfirmasi
                                    </span>
                                @else
                                    <span class="bg-rose-100 text-rose-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm border border-rose-200">
                                        {{ $booking->status_pembayaran }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-folder-open text-4xl text-slate-200 mb-4"></i>
                                    <p class="text-slate-400 font-medium italic">Belum ada riwayat pemesanan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>