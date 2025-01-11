const formatPhone = (number?: string) => {
  if (!number) return '';

  if (number.startsWith('0800')) {
    return number.replace(/^(\d{4})(\d{3})(\d{4}).*/, '$1 $2 $3');
  }

  if (number.length === 11) {
    return number.replace(/^(\d{2})(\d{1})(\d{4})(\d{4}).*/, '($1) $2 $3-$4');
  }

  if (number.length === 10) {
    return number.replace(/^(\d{2})(\d{4})(\d{4}).*/, '($1) $2-$3');
  }

  return number;
};

export default formatPhone;
