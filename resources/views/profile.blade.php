@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="text-center mt-20">
    <h2 class="text-3xl font-bold mb-6">Profile</h2>
    <p id="profileName" class="text-xl"></p>
  </div>
@endsection

@section('scripts')
<script>
  const params = new URLSearchParams(window.location.search);
  const username = params.get('username');
  if (username) {
    document.getElementById('profileName').textContent = `Selamat datang, ${username}!`;
  } else {
    document.getElementById('profileName').textContent = 'Tidak ada data pengguna.';
  }
</script>
@endsection
