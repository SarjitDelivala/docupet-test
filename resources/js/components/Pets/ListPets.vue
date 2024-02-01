<template>
    <div>
        <el-button class="right m-5" type="primary" plain @click = "showDrawer = true">Add New Pet</el-button>

        <el-table
            :data = "pets"
            v-loading = "loading"
            :row-class-name = "showDangerStatus"
        >
            <el-table-column label="Name">
                <template #default="scope">
                    {{ scope.row.name }}
                </template>
            </el-table-column>
            <el-table-column label="Pet Type">
                <template #default="scope">
                    {{ scope.row.petType.name }}
                </template>
            </el-table-column>
            <el-table-column label="Breed">
                <template #default="scope">
                    <span v-if = "scope.row.breed_name">{{ scope.row.breed_name }}</span>
                    <span v-else>{{ scope.row.breed.name }}</span>
                </template>
            </el-table-column>
            <el-table-column label="Gender">
                <template #default="scope">
                    {{ scope.row.gender }}
                </template>
            </el-table-column>
            <el-table-column label="Is Dangerous">
                <template #default="scope">
                    <span v-if="scope.row.breed.is_dangerous">
                        Yes
                    </span>
                    <span v-else>
                        No
                    </span>
                </template>
            </el-table-column>
        </el-table>

        <create-pet :show-drawer="showDrawer" :pet-types="petTypes" :breeds="breeds"></create-pet>
    </div>
</template>

<script>
export default {
    name: 'ListPets',

    mounted() {
        this.fetchPets();
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

        showDangerStatus(row, rowIndex) {
            if (row.row.breed.is_dangerous) {
                return 'warning-row';
            }
            return "";
        }
    },
}
</script>

<style>
.el-table .warning-row {
    --el-table-tr-bg-color: #f2bcbc !important;
}
</style>
