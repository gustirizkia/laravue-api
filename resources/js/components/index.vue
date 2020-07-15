<template>
    <div class="container mt-5">
        <router-link :to="{ name: 'create' }" class="btn btn-md btn-success"
            >TAMBAH POST</router-link
        >
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">Judul Konten</th>
                    <th scope="col">Isi Konten</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(post, index) in posts" :key="post.id">
                    <td>{{ post.judul }}</td>
                    <td>{{ post.konten }}</td>
                    <td>
                        <router-link
                            :to="{ name: 'edit', params: { id: post.id } }"
                            class="btn btn-sm btn-primary mr-2 mb-3"
                            >EDIT</router-link
                        >
                        <button
                            @click.prevent="PostDelete(post.id, index)"
                            class="btn btn-sm btn-danger mb-3"
                        >
                            HAPUS
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data() {
        return {
            posts: [] // mendefisikan variabel posts
        };
    },

    mounted() {
        axios
            .get("http://127.0.0.1:8000/api")
            .then(response => (this.posts = response.data.data));
    },
    methods: {
        PostDelete(id, index) {
            this.axios
                .delete(`http://127.0.0.1:8000/api/hapus/${id}`)
                .then(response => {
                    this.posts.splice(index, 1);
                    alert("arikel berhasil " + " di hapus");
                });
        }
    }
};
</script>
