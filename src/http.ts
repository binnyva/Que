import axios from 'axios'

let url = `http://${window.location.hostname}/Projects/Que/Server/public`
if (window.location.hostname.indexOf('apps.binnyva.com') >= 0) {
  url = 'https://apps.binnyva.com/que/Que/Server/public'
}

export default axios.create({
  baseURL: url,
  headers: {
    'Content-type': 'application/json'
  }
})
