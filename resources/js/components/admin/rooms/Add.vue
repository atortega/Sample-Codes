<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Room</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Category">
                                    <select class="form-control" v-model="room.category_id" v-on:change="categoryChange">
                                        <option :value="0">Please select a category</option>
                                        <option v-for="(category, key) in categories" :key="key" :value="category.id" >
                                            {{ category.title }}
                                        </option>
                                    </select>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Sub Category">
                                    <select class="form-control" v-model="room.subcategory_id" >
                                        
                                        <option :value="0">Please select a sub category</option>
                                        <option  v-for="(subcategory, key) in subcategories" :key="key" v-bind:value="subcategory.id"> {{ subcategory.name }} </option>
                                        
                                    </select>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Room Name">
                                    <b-form-input v-model="room.name" type="text" class="form-control"></b-form-input>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Description">
                                    <b-form-input v-model="room.description" type="text" class="form-control"></b-form-input>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Room Rate in PHP" append=".00">
                                    <b-form-input v-model="room.rate" type="number" class="form-control"></b-form-input>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Room Rate Type">
                                    <b-form-select v-model="room.rate_type" :options="rate_type_options"></b-form-select>
                                </b-input-group>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"add-subcategory",
    data(){
        return {
            selected: null,
            rate_type_options: [
                {value: null, text: 'Select room rate type.'},
                {value: 'per night', text: 'per night'},
                {value: 'per pax', text: 'per pax'}
            ],
            categories: [],
            subcategories: [],
            room:{
                category_id: 0,
                subcategory_id: 0,
                rate: '',
                rate_type: '',
                name:"",
                description:""
            }
        }
    },
    mounted(){
        this.getCategories()
    },
    methods:{
        async getCategories(){
            await this.axios.get('/api/category').then(response=>{
                this.categories = response.data

            }).catch(error=>{
                console.log(error)
                this.options = []
            })
        },
        async create(){
            await this.axios.post('/api/rooms',this.room).then(response=>{
                this.$router.push({name:"Rooms"})
            }).catch(error=>{
                console.log(error)
            })
        },
        categoryChange() {
            this.axios.get('/api/subcategory/category/'+this.room.category_id).then(
                response => {
                    this.subcategories = response.data
                }
            ).catch(
                error => {
                    console.log(error)
                    this.subcategories = []

                }
            )
        }
    }
}
</script>