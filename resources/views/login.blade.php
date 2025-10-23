@extends('layouts.app')

@section('title', 'Login')

@section('content')
  <div class="flex flex-col items-center justify-center min-h-[60vh]">
    <h2 class="text-3xl font-bold mb-6">Login to Brutal Blog Box</h2>
    <div class="border-2 border-borderLight dark:border-borderDark rounded-sm p-6 w-80">
      <input id="username" type="text" placeholder="Username"
        class="w-full border mb-3 p-2 dark:bg-cardDark dark:text-textDark" />
      <input id="password" type="password" placeholder="Password"
        class="w-full border mb-3 p-2 dark:bg-cardDark dark:text-textDark" />
      <button id="loginBtn"
        class="w-full border-2 border-borderLight dark:border-borderDark rounded-sm px-4 py-2 bg-cardLight dark:bg-cardDark font-medium text-md mt-2 shadow">
        LOGIN
      </button>
    </div>
  </div>
@endsection

@section('scripts')
<script></script>
<script>
  document.getElementById('loginBtn').addEventListener('click', () => {
    const user = document.getElementById('username').value.trim();
    const pass = document.getElementById('password').value.trim();

    if (!user || !pass) return alert('Isi username dan password.');

    if (pass === '123') {
      localStorage.setItem('username', user);
      window.location.href = `/dashboard?username=${encodeURIComponent(user)}`;
    } else {
      alert('Password salah. Gunakan "123" untuk demo.');
    }
  });
</script>
@endsection
