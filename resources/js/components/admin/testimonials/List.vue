<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"testimonyAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Testimonials</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Testimony</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="testimonials.length > 0">
                                <tr v-for="(testimony,key) in testimonials" :key="key">
                                    <td>{{ testimony.id }}</td>
                                    <td>{{ testimony.name }}</td>
                                    <td>{{ testimony.location }}</td>
                                    <td>{{ testimony.date }}</td>
                                    <td>{{ testimony.testimony }}</td>
                                    <td>
                                        <router-link :to='{name:"testimonyEdit",params:{id:testimony.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteTestimonyr(testimony.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="6" align="center">{{ testimonies }}</td>
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
    name: "testimonyList",
    
    data() {
        return {
            testimonials: [],
            testimonies: 'Loading testimonials...'
        }
    },
    mounted() {
        this.getTestimonials()
    },
    methods: {
        async getTestimonials() {
            await this.axios.get('/api/testimonials').then(response => {
                this.testimonials = response.data
                if (this.testimonials.length == 0) {
                    this.testimonies = 'No Testimonials Found.'
                }
            }).catch(error => {
                console.log(error)
                this.testimonials = [],
                this.testimonies = 'No Testimonials Found.'
            })
        }
    }
}
</script>