const apiBaseUrl =
  window.location.hostname.indexOf('apps.binnyva.com') >= 0
    ? 'https://apps.binnyva.com/que'
    : `http://${window.location.hostname}/Projects/Que`

export { apiBaseUrl }
