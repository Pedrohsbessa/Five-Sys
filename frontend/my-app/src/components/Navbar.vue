<script>
import CreateAlbumForm from './CreateAlbumForm.vue';

export default {
    name: 'Navbar',
    components: {
        CreateAlbumForm,
    },
    data() {
        return {
            buttonText: 'Novo Álbum',
        };
    },
    methods: {
        onClick() {
            this.$refs.form.open();
        },
        handleCreateAlbum(albumData) {
            this.$emit('create-album', albumData);
        },
    },
};
</script>

<template>
    <div>
        <nav class="navbar">
            <div class="navbar-content">
                <a href="#" class="navbar-brand">Meu Site</a>
                <button @click="onClick" class="navbar-button">{{ buttonText }}</button>
            </div>
        </nav>

        <CreateAlbumForm ref="form" @create-album="handleCreateAlbum" />
    </div>
</template>

<style scoped>

</style>
