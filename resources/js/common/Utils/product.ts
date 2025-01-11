export function getType(type: App.Models.Product['type']) {
  switch (type) {
    case 'SIMPLE':
      return 'Simples';
    case 'VARIATION':
      return 'Variável';
    default:
      return 'Desconhecido';
  }
}
