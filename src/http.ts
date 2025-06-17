import axios from 'axios'

let url = `http://${window.location.hostname}/Projects/Que`
if (window.location.hostname.indexOf('apps.binnyva.com') >= 0) {
  url = 'https://apps.binnyva.com/que'
}

export default axios.create({
  baseURL: url,
  headers: {
    'Content-type': 'application/json'
  }
})
