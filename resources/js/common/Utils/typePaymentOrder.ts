export default (status: App.Models.Order['payment_type']) => {
  switch (status) {
    case 'PIX':
      return 'Pix';
    case 'CREDIT_CARD':
      return 'Cartão de Crédito';
    case 'BOLETO':
      return 'Boleto';
  }
};
