@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- HEADER -->
    <div class="bg-white border border-secondary rounded-3xl shadow-sm p-5 flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <div class="relative">
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3b82f6&color=fff"
                     class="w-12 h-12 rounded-full shadow-sm" />

                <!-- online dot -->
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></span>
            </div>

            <div>
                <h2 class="font-extrabold text-dark flex items-center gap-2">
                    Budi Santoso
                    <i class="bi bi-patch-check-fill text-primary"></i>
                </h2>
                <p class="text-xs text-gray-500">Online • fast response</p>
            </div>
        </div>

        <a href="{{ route('tutors') }}"
           class="text-sm font-bold text-gray-400 hover:text-primary transition">
            ← Kembali
        </a>
    </div>

    <!-- CHAT CARD -->
    <div class="bg-white border border-secondary rounded-3xl shadow-lg overflow-hidden flex flex-col h-[75vh]">

        <!-- CHAT AREA -->
        <div class="flex-1 overflow-y-auto px-6 py-6 space-y-6 bg-surface/40">

            <!-- DATE SEPARATOR -->
            <div class="flex justify-center">
                <span class="text-[11px] font-bold text-gray-400 bg-white border border-secondary px-4 py-1 rounded-full shadow-sm">
                    Hari Ini
                </span>
            </div>

            <!-- RECEIVED -->
            <div class="flex items-end gap-3">
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3b82f6&color=fff"
                     class="w-9 h-9 rounded-full shadow-sm">

                <div class="bg-white border border-secondary px-4 py-3 rounded-2xl rounded-bl-md shadow-sm max-w-md">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Halo 👋 kamu mau belajar apa hari ini?
                    </p>
                    <span class="text-[10px] text-gray-400 mt-1 block">10:02</span>
                </div>
            </div>

            <!-- SENT -->
            <div class="flex justify-end">
                <div class="bg-primary text-white px-4 py-3 rounded-2xl rounded-br-md shadow-md max-w-md">
                    <p class="text-sm leading-relaxed">
                        Kak aku bingung Laravel routing 😭
                    </p>
                    <span class="text-[10px] text-white/70 mt-1 block text-right">10:03</span>
                </div>
            </div>

            <!-- RECEIVED -->
            <div class="flex items-end gap-3">
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3b82f6&color=fff"
                     class="w-9 h-9 rounded-full shadow-sm">

                <div class="bg-white border border-secondary px-4 py-3 rounded-2xl rounded-bl-md shadow-sm max-w-md">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Oke kita breakdown pelan-pelan ya 😄
                        Routing itu konsep mapping URL → function.
                    </p>
                    <span class="text-[10px] text-gray-400 mt-1 block">10:05</span>
                </div>
            </div>

        </div>

        <!-- INPUT (GLASS STYLE) -->
        <div class="p-4 bg-white border-t border-secondary">
            <form class="flex items-center gap-3">

                <!-- attachment -->
                <button type="button"
                        class="w-11 h-11 rounded-xl bg-surface border border-secondary hover:bg-gray-100 transition flex items-center justify-center">
                    <i class="bi bi-plus-lg text-gray-600"></i>
                </button>

                <!-- input -->
                <div class="flex-1 relative">
                    <input type="text"
                           placeholder="Tulis pesan..."
                           class="w-full bg-surface border border-secondary rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary transition pr-10">

                    <i class="bi bi-emoji-smile absolute right-3 top-3.5 text-gray-400"></i>
                </div>

                <!-- send -->
                <button type="submit"
                        class="w-12 h-12 bg-primary hover:bg-primary-hover text-white rounded-xl flex items-center justify-center shadow-lg active:scale-95 transition">
                    <i class="bi bi-send-fill"></i>
                </button>

            </form>
        </div>

    </div>
</div>
@endsection
