<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"roomsAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Rooms</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Room Name</th>
                                    <th>Featured Image</th>
                                    <th>Rate</th>
                                    <th>Rate Type</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="rooms.length > 0">
                                <tr v-for="(room,key) in rooms" :key="key">
                                    <td>{{ room.id }}</td>
                                    <td>{{ room.category }}</td>
                                    <td>{{ room.subcategory }}</td>
                                    <td>{{ room.name }}</td>
                                    <td>
                                        <img src='/images/150.png' width="75px;" v-if="room.featured_image == null">
                                        <img :src='room.featured_image' v-else>
                                    </td>
                                    <td>{{ room.rate.toFixed(2) }}</td>
                                    <td>{{ room.rate_type }}</td>
                                    <td>{{ room.description }}</td>
                                    <td>
                                        <router-link :to='{name:"roomEdit",params:{id:room.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteRoom(room.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="9" align="center">No Rooms Found.</td>
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
    name:"rooms",
    data(){
        return {
            rooms:[]
        }
    },
    mounted(){
        this.getRooms()
    },
    methods:{
        async getRooms(){
            await this.axios.get('/api/rooms').then(response=>{
                this.rooms = response.data
            }).catch(error=>{
                console.log(error)
                this.rooms = []
            })
        },
        deleteRooms(id){
            if(confirm("Are you sure to delete this room ?")){
                this.axios.delete(`/api/rooms/${id}`).then(response=>{
                    this.getRooms()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>