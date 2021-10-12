<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Sub Category</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" v-model="subcategory.category_id" >
                                        <option :value="0">Please select a category</option>
                                        <option v-for="(category, key) in categories" :key="key" :value="category.id" >
                                            {{ category.title }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="subcategory.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="subcategory.description">
                                </div>
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
            options: [],
            categories: [],
            subcategory:{
                category_id: 0,
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
            await this.axios.post('/api/subcategory',this.subcategory).then(response=>{
                this.$router.push({name:"SubcategoryList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>