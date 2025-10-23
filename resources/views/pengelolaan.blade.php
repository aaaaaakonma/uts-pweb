@extends('layouts.app')

@section('title', 'Pengelolaan')

@section('content')
<div class="max-w-3xl mx-auto mt-12">
  <h2 class="text-3xl font-bold mb-6 text-center">Pengelolaan Artikel</h2>

  <!-- Form -->
  <div class="border-2 border-borderLight dark:border-borderDark rounded-sm p-4 mb-8">
    <h3 class="text-xl font-semibold mb-3">Tambah Artikel</h3>
    <input id="titleInput" type="text" placeholder="Judul"
      class="w-full border mb-3 p-2 dark:bg-cardDark dark:text-textDark" />
    <textarea id="contentInput" placeholder="Konten"
      class="w-full border mb-3 p-2 h-24 dark:bg-cardDark dark:text-textDark"></textarea>
    <button id="addBtn"
      class="border-2 border-borderLight dark:border-borderDark rounded-sm px-4 py-2 bg-cardLight dark:bg-cardDark font-medium text-md shadow">
      Tambah
    </button>
    <button id="clearBtn"
      class="ml-2 border-2 border-red-400 dark:border-red-500 text-red-600 dark:text-red-400 rounded-sm px-4 py-2 font-medium text-md shadow">
      Hapus Semua
    </button>
  </div>

  <!-- List Cards -->
  <div id="cardList" class="grid gap-4"></div>
</div>
@endsection

@section('scripts')
<script type="module" src="{{ asset('js/cardRenderer.js') }}"></script>
@endsection

