
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

// Make it available globally
window.CardController = CardController;