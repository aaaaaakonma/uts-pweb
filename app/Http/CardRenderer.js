  class CardRenderer {
    constructor(controller, containerId) {
      this.controller = controller;
      this.container = document.getElementById(containerId);
    }
  
    render() {
      const cards = this.controller.all();
      this.container.innerHTML = '';
  
      if (cards.length === 0) {
        this.container.innerHTML = `<p class="text-center opacity-70">Belum ada postingan.</p>`;
        return;
      }
  
      cards.forEach(card => {
        const el = document.createElement('div');
        el.className = 'border-2 border-borderLight dark:border-borderDark rounded-sm p-4 bg-cardLight dark:bg-cardDark';
        el.innerHTML = `
          <h3 class="text-xl font-bold mb-2">${card.title}</h3>
          <p class="mb-3">${card.content}</p>
          <div class="flex justify-between text-xs opacity-70 mb-2">
            <span>${new Date(card.createdAt).toLocaleString()}</span>
          </div>
          <button class="border-2 border-borderLight dark:border-borderDark rounded-sm px-3 py-1 text-sm hover:bg-red-500 hover:text-white transition" 
            onclick="window.cardApp.deleteCard(${card.id})">Hapus</button>
        `;
        this.container.appendChild(el);
      });
    }
  }
  