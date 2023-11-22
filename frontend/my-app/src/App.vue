<script>
import Navbar from './components/Navbar.vue';
import CreateAlbumForm from './components/CreateAlbumForm.vue';
import AlbumList from './components/AlbumList.vue';
import { createAlbum } from './services/api';

export default {
  components: {
    Navbar,
    CreateAlbumForm,
    AlbumList,
  },
  data() {
    return {
      showForm: false,
    };
  },
  methods: {
    openCreateAlbumDialog() {
      this.showForm = true;
    },
    async createAlbum(albumData) {
      try {
        const response = await createAlbum(albumData);

        if (response.status === 201) {
          console.log('Álbum criado com sucesso:', response.data);
          this.showForm = false;
        } else {
          console.error('Erro ao criar álbum:', response.data);
        }
      } catch (error) {
        console.error('Erro ao criar álbum:', error);
      }
    },
  },
};
</script>
