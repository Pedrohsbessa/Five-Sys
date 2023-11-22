<template>
    <div>
        <h2>Lista de Álbuns</h2>
        <ul>
            <li v-for="album in albums" :key="album.id">
                <strong>{{ album.title }}</strong>
                <p>{{ album.description }}</p>
            </li>
        </ul>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            albums: [],
        };
    },
    mounted() {
        this.fetchAlbums();
    },
    methods: {
        async fetchAlbums() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/albums');
                const data = await response.json();
                this.albums = data;
            } catch (error) {
                console.error('Erro ao obter a lista de álbuns:', error);
            }
        },
    },
};
</script>
  
<style scoped>
</style>
  