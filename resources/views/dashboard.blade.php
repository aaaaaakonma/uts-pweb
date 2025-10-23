@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="text-center mt-10">
    <h2 class="text-3xl font-bold mb-6">Dashboard</h2>
    <p id="welcomeMessage" class="text-xl mb-10"></p>

    <!-- Card creation form -->
    <div class="border-2 border-borderLight dark:border-borderDark rounded-sm p-4 w-96 mx-auto mb-6">
      <input id="cardTitle" type="text" placeholder="Card Title"
        class="w-full border mb-3 p-2 dark:bg-cardDark dark:text-textDark" />
      <textarea id="cardContent" placeholder="Card Content"
        class="w-full border mb-3 p-2 dark:bg-cardDark dark:text-textDark"></textarea>
      <button id="addCardBtn"
        class="w-full border-2 border-borderLight dark:border-borderDark rounded-sm px-4 py-2 bg-cardLight dark:bg-cardDark font-medium text-md mt-2 shadow">
        ADD CARD
      </button>
    </div>

    <!-- Rendered cards -->
    <div id="cardsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('js/CardController.js') }}"></script>
<script>
  const params = new URLSearchParams(window.location.search);
  const username = params.get('username');
  const welcomeMsg = document.getElementById('welcomeMessage');
  welcomeMsg.textContent = username ? `Selamat datang, ${username}!` : 'Selamat datang, tamu!';

  const cardController = new CardController();

  function renderCards() {
    const container = document.getElementById('cardsContainer');
    container.innerHTML = '';

    const cards = cardController.all();
    if (cards.length === 0) {
      container.innerHTML = '<p class="text-gray-500">Belum ada kartu. Tambahkan satu!</p>';
      return;
    }

    cards.forEach(card => {
      const div = document.createElement('div');
      div.className = 'border-2 border-borderLight dark:border-borderDark rounded-sm p-4 bg-cardLight dark:bg-cardDark shadow';
      div.innerHTML = `
        <h3 class="text-xl font-bold mb-2">${card.title}</h3>
        <p class="mb-3">${card.content}</p>
        <p class="text-xs text-gray-500 mb-3">${new Date(card.createdAt).toLocaleString()}</p>
        <button data-id="${card.id}" class="deleteBtn border border-red-500 text-red-500 px-2 py-1 text-sm rounded-sm hover:bg-red-500 hover:text-white transition">Delete</button>
      `;
      container.appendChild(div);
    });

    // Attach delete handlers
    document.querySelectorAll('.deleteBtn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const id = Number(e.target.dataset.id);
        cardController.delete(id);
        renderCards();
      });
    });
  }

  document.getElementById('addCardBtn').addEventListener('click', () => {
    const title = document.getElementById('cardTitle').value.trim();
    const content = document.getElementById('cardContent').value.trim();
    if (!title || !content) return alert('Isi semua field.');

    cardController.create(title, content);
    document.getElementById('cardTitle').value = '';
    document.getElementById('cardContent').value = '';
    renderCards();
  });

  // Initial render
  renderCards();
</script>
@endsection
