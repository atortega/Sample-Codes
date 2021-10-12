<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"imagesAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Images</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:"images",
    data(){
        return {
            images:[]
        }
    },
    mounted(){
        this.getImages()
    },
    methods:{
        async getImages(){
            await this.axios.get('/api/images').then(response=>{
                this.images = response.data
            }).catch(error=>{
                console.log(error)
                this.images = []
            })
        },
        deleteRooms(id){
            if(confirm("Are you sure to delete this image ?")){
                this.axios.delete(`/api/images/${id}`).then(response=>{
                    this.getImages()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>