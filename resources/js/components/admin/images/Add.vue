<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Image</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Category">
                                    <select class="form-control" v-model="image.category_id" v-on:change="categoryChange">
                                        <option :value="0">Please select a category</option>
                                        <option v-for="(category, key) in categories" :key="key" :value="category.id" >
                                            {{ category.title }}
                                        </option>
                                    </select>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Sub Category">
                                    <select class="form-control" v-model="image.subcategory_id" v-on:change="subCategoryChange">
                                        
                                        <option :value="0">Please select a sub category</option>
                                        <option  v-for="(subcategory, key) in subcategories" :key="key" v-bind:value="subcategory.id"> {{ subcategory.name }} </option>
                                        
                                    </select>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Room">
                                    <select class="form-control" v-model="image.room_id" >
                                        
                                        <option :value="0">Please select a room</option>
                                        <option  v-for="(room, key) in rooms" :key="key" v-bind:value="room.id"> {{ room.name }} </option>
                                        
                                    </select>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Image Title">
                                    <b-form-input v-model="image.title" type="text" class="form-control"></b-form-input>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Description">
                                    <b-form-input v-model="image.description" type="text" class="form-control"></b-form-input>
                                </b-input-group>
                            </div>
                            <div class="col-12 mb-2">
                                <b-input-group size="sm" prepend="Image">
                                    <b-form-file
                                        v-model="files"
                                        :state="Boolean(files)"
                                        accept="image/jpeg, image/png, image/gif, image/jpg"
                                        multiple
                                        :file-name-formatter="formatNames"
                                        placeholder="Choose a file or drop it here..."
                                        drop-placeholder="Drop file here..."
                                    ></b-form-file>
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
            categories: [],
            subcategories: [],
            rooms: [],
            files: [],
            image:{
                category_id: 0,
                subcategory_id: 0,
                room_id: 0,
                title: '',
                description:"",
                file: []
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
            let formData = new FormData();
            for( var i = 0; i < this.files.length; i++ ){
                let file = this.files[i];

                formData.append('files[' + i + ']', file);
            }
            formData.append('category_id', this.image.category_id)
            formData.append('subcategory_id', this.image.subcategory_id)
            formData.append('room_id', this.image.room_id)
            formData.append('title', this.image.title)
            formData.append('description', this.image.description_id)
            console.log(formData)
            await this.axios.post('/api/images', formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(response =>{
                console.log(response)
                this.$router.push({name:"Images"})
            }).catch(error=>{
                console.log(error)
            })
        },
        categoryChange() {
            this.axios.get('/api/subcategory/category/'+this.image.category_id).then(
                response => {
                    this.subcategories = response.data
                }
            ).catch(
                error => {
                    console.log(error)
                    this.subcategories = []

                }
            )
        },
        subCategoryChange() {
            this.axios.get('/api/rooms/category/'+this.image.category_id+'/subcategory/'+this.image.subcategory_id).then(
                response => {
                    this.rooms = response.data
                }
            ).catch(
                error => {
                    console.log(error)
                    this.rooms = []

                }
            )
        },
        formatNames(files) {
            return files.length === 1 ? files[0].name : `${files.length} files selected`
        }
    }
}
</script>