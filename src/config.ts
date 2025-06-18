const apiBaseUrl =
  window.location.hostname.indexOf('apps.binnyva.com') >= 0
    ? 'https://apps.binnyva.com/que'
    : `http://${window.location.hostname}/Projects/Que`

const defaultTags = [
  'deep',
  'love',
  'career',
  'family',
  'vulnerability',
  'fun',
  'sex',
  'relationship',
]

export { apiBaseUrl, defaultTags }
