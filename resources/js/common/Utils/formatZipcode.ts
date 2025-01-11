export default function formatZipcode(zipcode?: string) {
  if (!zipcode) {
    return '';
  }

  return zipcode.replace(/(\d{5})(\d{3})/, '$1-$2');
}
