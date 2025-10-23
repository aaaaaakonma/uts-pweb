class CardRenderer {
  constructor(containerSelector) {
    this.controller = new CardController();
    this.container = document.querySelector(containerSelector);
    this.addBtn = document.getElementById('addBtn');
    this.clearBtn = document.getElementById('clearBtn');
    this.titleInput = document.getElementById('titleInput');
    this.contentInput = document.getElementById('contentInput');
  }

  render() {
    const cards = this.controller.all();
    this.container.innerHTML = '';

    if (cards.length === 0) {
      this.container.innerHTML = `<p class="text-center text-gray-500 dark:text-gray-400">Belum ada artikel.</p>`;
      return;
    }

    cards.forEach(card => {
      const div = document.createElement('div');
      div.className = 'border-2 border-borderLight dark:border-borderDark rounded-sm p-4 bg-cardLight dark:bg-cardDark shadow';
      div.innerHTML = `
        <h4 class="text-xl font-bold mb-2">${card.title}</h4>
        <p class="mb-3">${card.content}</p>
        <small class="text-sm text-gray-500">Dibuat: ${new Date(card.createdAt).toLocaleString()}</small><br>
        <button data-id="${card.id}" class="deleteBtn mt-3 border-2 border-red-400 text-red-600 rounded-sm px-3 py-1 text-sm">Hapus</button>
      `;
      this.container.appendChild(div);
    });

    this.container.querySelectorAll('.deleteBtn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const id = parseInt(e.target.getAttribute('data-id'));
        this.controller.delete(id);
        this.render();
      });
    });
  }

  init() {
    this.render();

    this.addBtn.addEventListener('click', () => {
      const title = this.titleInput.value.trim();
      const content = this.contentInput.value.trim();
      if (!title || !content) return alert('Isi judul dan konten!');
      this.controller.create(title, content);
      this.titleInput.value = '';
      this.contentInput.value = '';
      this.render();
    });

    this.clearBtn.addEventListener('click', () => {
      if (confirm('Hapus semua artikel?')) {
        this.controller.clear();
        this.render();
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('cardList');
  if (container) {
    const renderer = new CardRenderer('#cardList');
    renderer.init();
  }
});