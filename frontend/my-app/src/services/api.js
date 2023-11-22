// api.js
import axios from 'axios'

const apiUrl = 'http://127.0.0.1:8000/api'

export async function createAlbum(albumData) {
  console.log('Enviando solicitação para criar álbum:', albumData)

  try {
    const response = await axios.post(`${apiUrl}/albums`, {
      title: albumData.title,
      description: albumData.description
    })

    console.log('Resposta do backend ao criar álbum:', response.data)
    return response.data
  } catch (error) {
    console.error('Erro ao criar álbum:', error)
    throw error
  }
}
