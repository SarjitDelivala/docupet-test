
<template>
    <el-drawer
        v-model="visible"
        size="40%"
        title="Add New Pet"
    >
        <template #default>
            <el-form :model="pet">
                <el-form-item label="Name" prop="name">
                    <el-input v-model="pet.name"></el-input>
                </el-form-item>
                <el-form-item label="Pet Type" prop="pet_type_id">
                    <el-select v-model="pet.pet_type_id">
                        <el-option v-for="(index, pet) in petTypes" :key="index" :label="pet.name" :value="pet.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Breed" prop="breed_id">
                    <el-select v-model="pet.breed_id">
                        <el-option v-for="(index, breed) in fbreeds" :key="index" :label="breed.name" :value="breed.id">
                        </el-option>
                    </el-select>

                    <el-radio-group v-model="pet.breed_known" v-if="pet.breed_id">
                        <el-radio-button label="I don't know"></el-radio-button>
                        <el-radio-button label="It's a mix"></el-radio-button>
                    </el-radio-group>
                    <el-input v-model="pet.breed_name" v-if = "pet.breed_known === mixText"></el-input>
                </el-form-item>
                <el-form-item label="Do you Know their date of birth" prop="age">
                    <el-radio-group v-model="pet.age_known">
                        <el-radio-button label="No"></el-radio-button>
                        <el-radio-button label="Yes"></el-radio-button>
                    </el-radio-group>
                    <el-date-picker v-model="pet.dob" v-if = "pet.age_known === 'Yes'"></el-date-picker>
                    <el-input type="number" v-model="pet.age" v-else-if = "pet.age_known === 'No'"></el-input>
                </el-form-item>
                <el-form-item label="Gender" prop="gender">
                    <el-radio-group v-model="pet.gender">
                        <el-radio-button label="Male"></el-radio-button>
                        <el-radio-button label="Female"></el-radio-button>
                    </el-radio-group>
                </el-form-item>
            </el-form>
        </template>
        <template #footer>
            <div>
                <el-button type="default" plain>Cancel</el-button>
                <el-button type="primary" plain>Save</el-button>
            </div>
        </template>
    </el-drawer>
</template>

<script>
export default {
    name: 'CreatePet',

    props: {
        breeds: {
            required: true,
        },

        petTypes: {
            required: true,
        },

        showDrawer: {
            required: true,
            type: Boolean,
        }
    },

    computed: {
        fbreeds() {
            _.filter(this.breeds, (b) => {
                return b.pet_type_id === this.pet.pet_type_id;
            });
        },

        mixText() {
            return "It's a mix"
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
        };
    },

    methods: {
        savePet() {

        },
    },
}
</script>
