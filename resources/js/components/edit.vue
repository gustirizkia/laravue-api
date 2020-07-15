<template>
    <div class="container mt-3">
        <h5>Tambah Data</h5>
        <form @submit.prevent="PostUpdate">
            <div class="form-group mt-3">
                <label for="judul">Masukan Judul</label>
                <input
                    type="text"
                    class="form-control"
                    id="judul"
                    v-model="post.judul"
                />
                <div v-if="validation.judul" class="text-danger">
                    {{ validation.judul[0] }}
                </div>
                <label for="konten">Masukan konten</label>
                <textarea
                    class="form-control"
                    id="konten"
                    rows="5"
                    v-model="post.konten"
                />
                <div v-if="validation.judul">
                    {{ validation.judul[0] }}
                </div>
            </div>
            <div class="form-group">
                <button
                    type="submit"
                    class="btn btn-md btn-success"
                    v-on:click="warn('Data Berhasil di Ubah ' + post.judul)"
                >
                    SIMPAN
                </button>
                <button type="reset" class="btn btn-md btn-danger">
                    RESET
                </button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            post: {},
            validation: []
        };
    },
    created() {
        let uri = `http://127.0.0.1:8000/api/${this.$route.params.id}`;
        this.axios.get(uri).then(response => {
            this.post = response.data.data;
        });
    },
    methods: {
        warn: function(message) {
            if (this.post) {
                alert(message);
                window.location.href = "/";
            }
        },
        PostUpdate() {
            let uri = `http://127.0.0.1:8000/api/ubah/${this.$route.params.id}`;
            this.axios
                .post(uri, this.post)
                .then(response => {
                    this.$route.push({ name: "posts" });
                })
                .catch(error => {
                    this.validation = error.response.data.data;
                });
        }
    }
};
</script>
