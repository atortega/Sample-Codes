<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"SubcategoryAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sub Category</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Featured Image</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="subcategories.length > 0">
                                <tr v-for="(subcategory,key) in subcategories" :key="key">
                                    <td>{{ subcategory.id }}</td>
                                    <td>{{ subcategory.title }}</td>
                                    <td>{{ subcategory.name }}</td>
                                    <td>
                                        <img src='/images/150.png' width="75px;" v-if="subcategory.featured_image == null">
                                        <img :src='subcategory.featured_image' v-else>
                                    </td>
                                    <td>{{ subcategory.description }}</td>
                                    <td>
                                        <router-link :to='{name:"SubcategoryEdit",params:{id:subcategory.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteCategory(subcategory.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="6" align="center">No Sub Categories Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"subcategories",
    data(){
        return {
            subcategories:[]
        }
    },
    mounted(){
        this.getSubcategories()
    },
    methods:{
        async getSubcategories(){
            await this.axios.get('/api/subcategory').then(response=>{
                this.subcategories = response.data
                console.log('Aner: ', this.subcategories.length)
            }).catch(error=>{
                console.log(error)
                this.subcategories = []
            })
        },
        deleteSubcategory(id){
            if(confirm("Are you sure to delete this sub category ?")){
                this.axios.delete(`/api/subcategory/${id}`).then(response=>{
                    this.getSubategories()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>