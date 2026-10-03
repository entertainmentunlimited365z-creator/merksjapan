const MerksOptions = {
  root: document.querySelector('.product-options'),
  colour: document.querySelector('#selected-colour')?.textContent || '',
  size: document.querySelector('#selected-size')?.textContent || '',
  colourFilters: {
    'アイボリー': 'brightness(1.12) saturate(.65) sepia(.12)',
    'ホワイト': 'brightness(1.12) saturate(.65)',
    'ブラック': 'brightness(.55) saturate(.45) contrast(1.12)',
    'ローズ': 'sepia(.22) saturate(1.18) hue-rotate(300deg)',
    'シャンパン': 'sepia(.42) saturate(.88) brightness(1.06)',
    'キャメル': 'sepia(.55) saturate(1.2) hue-rotate(340deg)',
    'ブルー': 'saturate(1.15) hue-rotate(8deg)',
    'インディゴ': 'brightness(.72) saturate(1.2) hue-rotate(8deg)',
    'グレー': 'grayscale(.55)',
    'ネイビー': 'brightness(.62) saturate(.9) hue-rotate(8deg)',
    'Ivory': 'brightness(1.12) saturate(.65) sepia(.12)',
    'Black': 'brightness(.55) saturate(.45) contrast(1.12)',
    'Soft Rose': 'sepia(.22) saturate(1.18) hue-rotate(300deg)',
    'Rose': 'sepia(.26) saturate(1.25) hue-rotate(305deg)',
    'Champagne': 'sepia(.42) saturate(.88) brightness(1.06)',
    'Cognac': 'sepia(.55) saturate(1.2) hue-rotate(340deg)'
  },
  selectColour(button) {
    document.querySelectorAll('.swatch').forEach(swatch => { swatch.classList.remove('selected'); swatch.setAttribute('aria-pressed', 'false'); });
    button.classList.add('selected'); this.colour = button.dataset.colour;
    button.setAttribute('aria-pressed', 'true');
    document.querySelector('#selected-colour').textContent = this.colour;
    document.querySelector('#product-image').style.filter = this.colourFilters[this.colour] || 'none';
  },
  selectSize(button) {
    document.querySelectorAll('.size-option').forEach(option => { option.classList.remove('selected'); option.setAttribute('aria-pressed', 'false'); });
    button.classList.add('selected'); this.size = button.dataset.size;
    button.setAttribute('aria-pressed', 'true');
    document.querySelector('#selected-size').textContent = this.size;
    const images = JSON.parse(this.root.dataset.sizeImages || '{}');
    if (images[this.size]) document.querySelector('#product-image').src = images[this.size];
  },
  options() { return {colour: this.colour, size: this.size}; },
  addSelected() { MerksCart.add(this.root.dataset.product, this.options()); },
  buyNow() { MerksCart.buyNow(this.root.dataset.product, this.options()); }
};
