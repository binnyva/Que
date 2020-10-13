import axios from 'axios'

export default axios.create({
  baseURL: 'http://localhost/Projects/Que/Server/public',
  headers: {
    'Content-type': 'application/json'
  }
})
