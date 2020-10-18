import axios from 'axios'

export default axios.create({
  baseURL: `http://${window.location.hostname}/Projects/Que/Server/public`,
  headers: {
    'Content-type': 'application/json'
  }
})
