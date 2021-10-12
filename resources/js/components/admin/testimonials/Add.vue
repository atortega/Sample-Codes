<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Testimonial</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="testimony.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" class="form-control" v-model="testimony.location">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="date" class="form-control" v-model="testimony.date">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                
                                <div>
                                    <b-form-textarea
                                    id="textarea"
                                    v-model="testimony.testimony"
                                    placeholder="Testimonial..."
                                    rows="3"
                                    max-rows="6"
                                    ></b-form-textarea>


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
    name:"add-testimony",
    data(){
        return {
            testimony:{
                name:"",
                location:"",
                date: "",
                testimony: ""
            }
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/testimonials',this.testimony).then(response=>{
                this.$router.push({name:"Testimonials"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>