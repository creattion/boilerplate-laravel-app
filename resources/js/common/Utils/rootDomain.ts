export function rootDomain(hostname: string) {
  let parts = hostname.split('.');
  if (parts.length <= 2) return hostname;

  parts = parts.slice(-3);
  if (['co', 'com'].indexOf(parts[1]) > -1) return parts.join('.');

  return parts.slice(-2).join('.');
}
