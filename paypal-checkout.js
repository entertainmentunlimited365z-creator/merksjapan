window.MerksPayPal = {
  render(cart) {
    const container = document.querySelector('#paypal-button-container');
    const message = document.querySelector('#paypal-message');
    if (!container || !cart.length) return;
    if (window.MerksPayPalConfigurationError) {
      message.textContent = 'PayPal決済は一時的にご利用いただけません。店舗までお問い合わせください。';
      return;
    }
    if (window.MerksPayPalLoadError || !window.paypal) {
      message.textContent = 'PayPalを読み込めませんでした。ページを更新して再度お試しください。';
      return;
    }
    container.innerHTML = '';
    paypal.Buttons({
      createOrder() {
        return fetch('paypal-api.php', {method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify({action: 'create', cart})})
          .then(response => response.json().catch(() => ({})))
          .then(data => { if (!data.id) throw new Error(data.error || 'PayPal決済を開始できませんでした。'); return data.id; });
      },
      onApprove(data) {
        return fetch('paypal-api.php', {method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify({action: 'capture', orderID: data.orderID})})
          .then(response => response.json().catch(() => ({})))
          .then(data => { if (!data.success) throw new Error(data.error || 'お支払いを完了できませんでした。'); localStorage.removeItem(MerksCart.key); window.location.href = 'payment-success.php'; });
      },
      onError(error) { message.textContent = error.message || 'PayPal決済をご利用いただけません。再度お試しください。'; }
    }).render('#paypal-button-container');
  }
};
window.MerksPayPal.render(JSON.parse(localStorage.getItem(MerksCart.key) || '[]'));
