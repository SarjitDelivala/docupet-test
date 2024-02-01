<template>
    <div>
        <el-drawer
            v-model="visible"
            v-loading="loading"
            size="40%"
            title="Add New Pet"
            @open="openEvents"
            @close="closeEvents"
        >
            <template #header>
                <h2>Add New Pet</h2>
            </template>
            <template #default>
                <div>
                    <div style="color: red">
                        <h4 v-if="errors.length">Errors</h4>
                        <ul>
                            <li v-for="(error, index) in errors" :key="index">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                    <el-form :model="pet">
                        <el-form-item label="Name" prop="name">
                            <el-input v-model="pet.name"></el-input>
                        </el-form-item>
                        <el-form-item label="Pet Type" prop="pet_type_id">
                            <el-select v-model="pet.pet_type_id">
                                <el-option v-for="(petType, index) in petTypes" :key="index" :label="petType.name"
                                           :value="petType.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Breed" prop="breed_id">
                            <el-select v-model="pet.breed_id">
                                <el-option v-for="(breed, index) in fbreeds" :key="index" :label="breed.name"
                                           :value="breed.id">
                                </el-option>
                            </el-select>

                            <el-radio-group v-model="pet.breed_known" v-if="pet.breed_id === otherBreed">
                                <el-radio-button label="I don't know"></el-radio-button>
                                <el-radio-button label="It's a mix"></el-radio-button>
                            </el-radio-group>
                            <el-input v-model="pet.breed_name" v-if="pet.breed_known === mixText"></el-input>
                        </el-form-item>
                        <el-form-item label="Do you Know their date of birth" prop="age">
                            <el-radio-group v-model="pet.age_known">
                                <el-radio-button label="No"></el-radio-button>
                                <el-radio-button label="Yes"></el-radio-button>
                            </el-radio-group>
                            <el-date-picker v-model="pet.dob" value-format="YYYY-MM-DD"
                                            v-if="pet.age_known === 'Yes'"></el-date-picker>
                            <el-input type="number" v-model="pet.age" v-else-if="pet.age_known === 'No'"></el-input>
                        </el-form-item>
                        <el-form-item label="Gender" prop="gender">
                            <el-radio-group v-model="pet.gender">
                                <el-radio-button label="Male"></el-radio-button>
                                <el-radio-button label="Female"></el-radio-button>
                            </el-radio-group>
                        </el-form-item>
                    </el-form>
                </div>
            </template>
            <template #footer>
                <div>
                    <el-button type="default" plain @click="this.visible = false">Cancel</el-button>
                    <el-button type="primary" plain @click="savePet">Save</el-button>
                </div>
            </template>
        </el-drawer>
    </div>
</template>

<script>
export default {
    name: 'CreatePet',

    props: {
        showDrawer: {
            required: true,
            type: Boolean,
        }
    },

    computed: {
        fbreeds() {
            return _.filter(this.breeds, (b) => {
                return b.pet_type_id === this.pet.pet_type_id;
            });
        },

        mixText() {
            return "It's a mix"
        },

        otherBreed() {
            let breed = _.find(this.fbreeds, (b) => {
                return b.name === "Can't find it?";
            });

            return breed?.id;
        },
    },

    watch: {
        visible() {
            this.$emit('update:showDrawer', this.visible);
        },

        showDrawer(value) {
            this.visible = value;
        },
    },


    data() {
        return {
            visible: this.showDrawer,
            loading: false,
            pet: {
                name: '',
                breed_id: '',
                pet_type_id: '',
                gender: '',
                age: '',
                dob: '',
                breed_name: '',
                breed_known: '',
                age_known: '',
            },
            petTypes: [],
            breeds: [],
            errors: [],
        };
    },

    methods: {
        savePet() {
            this.errors = [];
            this.loading = true;
            axios.post('/api/pets', this.pet).then(response => {
                this.$notify.success({
                    title: 'Success',
                    message: 'Pet Data Saved!',
                })
                this.closeEvents();
            }).catch(err => {
                if (err.response.status === 422) {
                    _.forEach(err.response.data.errors, (value, key) => {
                        this.errors = _.union(this.errors, value);
                    })
                } else {
                    this.$notify.error({
                        title: 'Error',
                        message: 'Something went wrong!',
                    })
                }

            }).finally(() => {
                this.loading = false;
            });
        },

        fetchPetTypes() {
            axios.get('/api/pet-types').then(response => {
                this.petTypes = response.data.data;
            }).catch(err => {
                this.$notify.error({
                    title: 'Error',
                    message: 'Something went wrong!',
                })
            });
        },

        fetchBreeds() {
            axios.get('/api/breeds').then(response => {
                this.breeds = response.data.data;
            }).catch(err => {
                this.$notify.error({
                    title: 'Error',
                    message: 'Something went wrong!',
                })
            });
        },

        openEvents() {
            this.fetchPetTypes();
            this.fetchBreeds();
        },

        closeEvents() {
            this.$emit('update:showDrawer', false);
        },
    },
}
</script>
