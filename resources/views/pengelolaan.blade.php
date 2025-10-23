@extends('layouts.app')

@section('title', 'Pengelolaan')

@section('content')
<div class="max-w-4xl mx-auto mt-12">
  <h2 class="text-3xl font-bold mb-6 text-center">PENGELOLAAN ARTIKEL</h2>

  <!-- Form -->
  <div class="border-2 border-borderLight dark:border-borderDark rounded-sm p-6 mb-8 bg-cardLight dark:bg-cardDark shadow">
    <h3 class="text-xl font-semibold mb-4">TAMBAH ARTIKEL BARU</h3>
    <input id="titleInput" type="text" placeholder="Judul artikel..."
      class="w-full border-2 border-borderLight dark:border-borderDark rounded-sm mb-3 p-3 dark:bg-bgDark dark:text-textDark focus:outline-none focus:border-gray-600" />
    <textarea id="contentInput" placeholder="Konten artikel..."
      class="w-full border-2 border-borderLight dark:border-borderDark rounded-sm mb-4 p-3 h-32 dark:bg-bgDark dark:text-textDark focus:outline-none focus:border-gray-600"></textarea>
    <div class="flex gap-3">
      <button id="addBtn"
        class="border-2 border-borderLight dark:border-borderDark rounded-sm px-6 py-2 bg-bgLight dark:bg-bgDark font-bold text-md shadow hover:bg-gray-100 dark:hover:bg-gray-800 transition">
        TAMBAH
      </button>
      <button id="clearBtn"
        class="border-2 border-red-400 dark:border-red-500 text-red-600 dark:text-red-400 rounded-sm px-6 py-2 font-bold text-md shadow hover:bg-red-50 dark:hover:bg-red-950 transition">
        HAPUS SEMUA
      </button>
    </div>
  </div>

  <!-- Stats -->
  <div class="mb-6 text-center">
    <p class="text-sm text-gray-600 dark:text-gray-400">
      TOTAL ARTIKEL: <span id="cardCount" class="font-bold">0</span>
    </p>
  </div>

  <!-- List Cards -->
  <div id="cardList" class="grid gap-4"></div>
</div>
@endsection

@section('scripts')
<script>
// Inline CardController to ensure it loads
class CardController {
  constructor() {
    this.storageKey = 'brutal_blog_cards';
  }

  all() {
    const data = localStorage.getItem(this.storageKey);
    return data ? JSON.parse(data) : [];
  }

  create(title, content) {
    const cards = this.all();
    const newCard = {
      id: Date.now(),
      title: title,
      content: content,
      createdAt: new Date().toISOString()
    };
    cards.push(newCard);
    localStorage.setItem(this.storageKey, JSON.stringify(cards));
    return newCard;
  }

  delete(id) {
    const cards = this.all();
    const filtered = cards.filter(card => card.id !== id);
    localStorage.setItem(this.storageKey, JSON.stringify(filtered));
    return true;
  }

  clear() {
    localStorage.removeItem(this.storageKey);
    return true;
  }

  find(id) {
    const cards = this.all();
    return cards.find(card => card.id === id);
  }
}
</script>
<script>
  const cardController = new CardController();
  const titleInput = document.getElementById('titleInput');
  const contentInput = document.getElementById('contentInput');
  const addBtn = document.getElementById('addBtn');
  const clearBtn = document.getElementById('clearBtn');
  const cardList = document.getElementById('cardList');
  const cardCount = document.getElementById('cardCount');

  function renderCards() {
    const cards = cardController.all();
    cardList.innerHTML = '';
    cardCount.textContent = cards.length;

    if (cards.length === 0) {
      cardList.innerHTML = `
        <div class="text-center py-12 border-2 border-dashed border-borderLight dark:border-borderDark rounded-sm">
          <p class="text-gray-500 dark:text-gray-400">BELUM ADA ARTIKEL.</p>
          <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">TAMBAHKAN ARTIKEL PERTAMA ANDA!</p>
        </div>
      `;
      return;
    }

    cards.forEach(card => {
      const div = document.createElement('div');
      div.className = 'border-2 border-borderLight dark:border-borderDark rounded-sm p-4 bg-cardLight dark:bg-cardDark shadow hover:shadow-lg transition-all';
      div.innerHTML = `
        <div class="flex justify-between items-start mb-2">
          <h4 class="text-xl font-bold tracking-tight flex-1">${escapeHtml(card.title)}</h4>
          <button data-id="${card.id}" class="deleteBtn border-2 border-red-400 text-red-600 dark:text-red-400 rounded-sm px-3 py-1 text-sm font-bold hover:bg-red-50 dark:hover:bg-red-950 transition ml-3">
            HAPUS
          </button>
        </div>
        <p class="mb-3 text-sm text-gray-700 dark:text-gray-300">${escapeHtml(card.content)}</p>
        <small class="text-xs text-gray-500 dark:text-gray-400">
          Dibuat: ${new Date(card.createdAt).toLocaleString('id-ID')}
        </small>
      `;
      cardList.appendChild(div);
    });

    // Attach delete handlers
    cardList.querySelectorAll('.deleteBtn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const id = parseInt(e.target.getAttribute('data-id'));
        if (confirm('Hapus artikel ini?')) {
          cardController.delete(id);
          renderCards();
          dispatchCardsUpdate();
        }
      });
    });
  }

  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  function dispatchCardsUpdate() {
    window.dispatchEvent(new CustomEvent('cardsUpdated'));
  }

  // Add card
  addBtn.addEventListener('click', () => {
    const title = titleInput.value.trim();
    const content = contentInput.value.trim();
    
    if (!title || !content) {
      alert('ISI JUDUL DAN KONTEN!');
      return;
    }

    cardController.create(title, content);
    titleInput.value = '';
    contentInput.value = '';
    renderCards();
    dispatchCardsUpdate();
    
    // Show success feedback
    addBtn.textContent = 'BERHASIL!';
    setTimeout(() => {
      addBtn.textContent = 'TAMBAH';
    }, 1000);
  });

  // Clear all cards
  clearBtn.addEventListener('click', () => {
    if (cardController.all().length === 0) {
      alert('TIDAK ADA ARTIKEL UNTUK DIHAPUS!');
      return;
    }
    
    if (confirm('HAPUS SEMUA ARTIKEL? TINDAKAN INI TIDAK DAPAT DIBATALKAN!')) {
      cardController.clear();
      renderCards();
      dispatchCardsUpdate();
    }
  });

  // Allow Enter key to submit
  titleInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
      contentInput.focus();
    }
  });

  contentInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter' && e.ctrlKey) {
      addBtn.click();
    }
  });

  // Initial render
  renderCards();

  // Listen for storage changes from other tabs
  window.addEventListener('storage', (e) => {
    if (e.key === 'brutal_blog_cards') {
      renderCards();
    }
  });
</script>
@endsection