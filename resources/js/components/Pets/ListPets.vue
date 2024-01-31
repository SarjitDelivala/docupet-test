<template>
    <div>
        <el-button class="right m-5" type="primary" plain @click = "showDrawer = true">Add New Pet</el-button>

        <el-table
            :data = "pets"
            v-loading = "loading"
            stripe
        >
            <el-table-column prop="name" label="Name"></el-table-column>
            <el-table-column label="Pet Type">
                <template #default="scope">
                    {{ scope.petType.name }}
                </template>
            </el-table-column>
            <el-table-column label="Breed">
                <template #default="scope">
                    <span v-if = "scope.breed_name">{{ scope.breed_name }}</span>
                    <span v-else>{{ scope.breed.name }}</span>
                </template>
            </el-table-column>
            <el-table-column prop="gender" label="Gender"></el-table-column>
            <el-table-column prop="breed.is_dangerous" label="Is Dangerous"></el-table-column>
        </el-table>

        <create-pet :show-drawer="showDrawer" :pet-types="petTypes" :breeds="breeds"></create-pet>
    </div>
</template>

<script>
export default {
    name: 'ListPets',

    mounted() {
        this.fetchPets();
        this.fetchPetTypes();
        this.fetchBreeds();
    },

    data() {
        return {
            pets: [],
            petTypes: [],
            breeds: [],
            loading: false,
            showDrawer: false,
        };
    },

    methods: {
        fetchBreeds() {
            axios.get('/api/pet-types').then(response => {
                this.petTypes = response.data.data;
            }).catch(err => {
                this.$notify.error({
                    title: 'Error',
                    message: 'Something went wrong!',
                })
            });
        },

        fetchPetTypes() {
            axios.get('/api/breeds').then(response => {
                this.breeds = response.data.data;
            }).catch(err => {
                this.$notify.error({
                    title: 'Error',
                    message: 'Something went wrong!',
                })
            });
        },

        fetchPets() {
            this.loading = true;
            axios.get('/api/pets?with[]=breed&with[]=petType').then(response => {
                this.pets = response.data.data;
            }).catch(err => {
                this.$notify.error({
                    title: 'Error',
                    message: 'Something went wrong!',
                })
            }).finally(() => {
                this.loading = false;
            });
        },
    },
}
</script>

