@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="text-center mt-10">
    <h2 class="text-3xl font-bold mb-6">DASHBOARD</h2>
    <p id="welcomeMessage" class="text-xl mb-10"></p>

    <!-- Rendered cards -->
    <div id="cardsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-w-7xl mx-auto"></div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('js/CardController.js') }}"></script>
<script>
  // Welcome message
  const params = new URLSearchParams(window.location.search);
  const username = params.get('username') || localStorage.getItem('username');
  const welcomeMsg = document.getElementById('welcomeMessage');
  welcomeMsg.textContent = username ? `SELAMAT DATANG, ${username.toUpperCase()}!` : 'SELAMAT DATANG, TAMU!';

  const cardController = new CardController();

  function renderCards() {
    const container = document.getElementById('cardsContainer');
    container.innerHTML = '';

    const cards = cardController.all();
    
    if (cards.length === 0) {
      container.innerHTML = `
        <div class="col-span-full text-center py-12">
          <p class="text-gray-500 dark:text-gray-400 text-lg">BELUM ADA KARTU.</p>
          <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">BUAT KARTU BARU DI HALAMAN PENGELOLAAN</p>
        </div>
      `;
      return;
    }

    cards.forEach(card => {
      const div = document.createElement('div');
      div.className = 'border-2 border-borderLight dark:border-borderDark rounded-sm p-4 bg-cardLight dark:bg-cardDark shadow hover:shadow-lg transition-shadow';
      div.innerHTML = `
        <h3 class="text-xl font-bold mb-2 tracking-tight">${escapeHtml(card.title)}</h3>
        <p class="mb-3 text-sm">${escapeHtml(card.content)}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">${new Date(card.createdAt).toLocaleString('id-ID')}</p>
      `;
      container.appendChild(div);
    });
  }

  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // Initial render
  renderCards();

  // Listen for storage changes from other tabs/windows
  window.addEventListener('storage', (e) => {
    if (e.key === 'brutal_blog_cards') {
      renderCards();
    }
  });

  // Custom event listener for same-page updates
  window.addEventListener('cardsUpdated', renderCards);
</script>
@endsection