<template>
  <div v-if="isOpen" class="form-overlay">
    <div class="form-container">
      <label for="title">Título:</label>
      <input type="text" id="title" v-model="album.title" />

      <label for="description">Descrição:</label>
      <textarea id="description" v-model="album.description"></textarea>

      <div class="form-buttons">
        <button @click="submitForm">Enviar</button>
        <button @click="cancelForm">Cancelar</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isOpen: false,
      album: {
        title: '',
        description: '',
      },
    };
  },
  methods: {
    open() {
      this.isOpen = true;
    },
    close() {
      this.isOpen = false;
    },
    submitForm() {
      this.$emit('create-album', this.album);
      this.close();
    },
    cancelForm() {
      this.close();
    },
  },
};
</script>

<style scoped>

</style>
