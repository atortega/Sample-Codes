<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <div class="welcome-are">
                <div class="section-title">
                    <h2>Welcome to Pacifico Seaside Lodge<br /><font-awesome-icon :icon="['fas', 'bars']" /></h2>
                </div>
                <p>For a quiet and cozy place to stay with an affordable price set in Moalboal, 20m from the heart Panagsama Beach, Pacifico Seaside Lodge offers accommodation with free WiFi and free private parking. An ideal place to book for nearby Diving shops, centers and the accessible Panagsama's favorite spots lineup including  beach bars, restaurants, seafood grills, souvenirs and retail shops. </p>
                <p>Pacifico Seaside Lodge offers a different view depending on your options and availability. Here, we offer a relaxing Ocean View where your room is facing the shoreline perfect for Group outings and stay-in vacation with magnificent scenery of sunsets. Let's you experience the famous sardines and turtles watching just outside your room.</p>
                <p>We also have Private and Backpackers rooms with Garden and Inner View all are ideal for more chillin' and exclusive experience where excellent and comfortable room is our primary concern. A pet friendly Garden View with a mini lawn for more serene and relaxing desertion where you can have your own private moments.</p>
                <p>This friendly and accommodating environment will help you enjoy the rest of your days ahead. </p>
                <div class="designation-area">
                    <ul>
                        <li>Aner Ortega</li>
                        <li>Aner Ortega, Operations Manager</li>
                    </ul>
                </div>
            </div>
            </b-col>
            <b-col>
                <div class="section-title">
                    <h2>Activites<br /><font-awesome-icon icon="bars" /></h2>
                </div>
                <div class="activites-area">
                <b-list-group>
                    <b-list-group-item style="border: none">
                        <a href='/activities/snorkling'><span><img src='/images/icons/1.png' className='activities-image' /></span>Snorkling</a>
                    </b-list-group-item>
                     <b-list-group-item style="border: none">
                        <a href='/activities/diving'><span><img src='/images/icons/2.png' className='activities-image' /></span>Diving</a>
                    </b-list-group-item>
                    <b-list-group-item style="border: none">
                        <a href='/activities/island-hopping'><span><img src='/images/icons/3.png' className='activities-image' /></span>Island Hopping</a>
                    </b-list-group-item>
                     <b-list-group-item style="border: none">
                        <a href='/activities/bicycle'><span><img src='/images/icons/4.png' className='activities-image' /></span>Bicycle</a>
                    </b-list-group-item>
                    <b-list-group-item style="border: none">
                        <a href='/activities/sardines-watching'><span><img src='/images/icons/5.png' className='activities-image' /></span>Sardines Watching</a>
                    </b-list-group-item>
                </b-list-group>
                </div>
            

            </b-col>
            <b-col>
                <div class="section-title">
                    <h2>Review<br /><font-awesome-icon :icon="['fas', 'bars']" /></h2>
                </div>
                <div class="testimonial-area">
                    <b-container fluid class="overflow-auto" style="height:500px;"> 
                        
                        <div class="mb-4" v-for="(testimony,key) in testimonials" :key="key">
                            <b-row>
                                <b-col cols="8" class='text-left'>
                                    <h6>{{ testimony.name}}</h6>
                                </b-col>
                                <b-col cols="4" class="text-right">
                                    <span style="font-size:75%">{{ testimony.date }}</span>
                                </b-col>
                            </b-row>
                            <b-row class="mb-2">
                                <b-col style='color:#adb5bd'>
                                    {{ testimony.location }}
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col>
                                    {{ testimony.testimony }}
                                </b-col>
                            </b-row>    
                            
                        </div>
                    </b-container>

                </div>
            </b-col>
        </b-row>
        
    </b-container>
</template>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    .section-title {
    margin-bottom: 60px;
    position: relative;
    }
    .section-title h2 {
    color: #333333;
    font-family: "Montserrat",sans-serif;
    font-size: 22px;
    font-weight: 400;
    text-transform: uppercase;
    margin-left: 10px !important;
    }
    .section-title h2:after {
    /*content: "\f0c9";*/
    font-family: "Font Awesome 5 Free";
    position: absolute;
    top: 40px;
    left: 10px !important;
    font-size: 25px;
    color: #cccccc;
    }

    .about-page-area, .welcome-are p span {
    font-family: 'Droid Sans', sans-serif;
    font-weight: bold;
    color: #666666;
    }
    .about-page-area .welcome-are .designation-area ul li {
    display: block;
    padding: 0 0 5px 0;
    }
    .designation-area ul li:first-child {
    color: #333333;
    font-family: 'Mrs Saint Delafield';
    font-size: 30px;
    line-height: 30px;
    }
    .about-page-area, .welcome-are, .designation-area ul li:last-child {
    color: #888888;
    font-family: 'Droid Sans', sans-serif;
    }

    .activites-area ul li a {
    color: #666666;
    text-decoration: none;
    transition: all 0.3s ease 0s;
    }
    .activites-area ul li a span {
    margin-right: 20px;
    font-size: 25px;
    }
    .activites-area ul li a:hover {
    color: #1f83b1;
    }

    ul {
    list-style: outside none none;
    margin: 0;
    padding: 0;
    }

    .activities-image {
    display: inline-block !important;
    max-width: 100% !important;
    height: auto;
    vertical-align: middle !important;
    width: 30px;
    }

    .activites-area span:after {
    margin-right: 20px;
    content: '';
    }


</style>

<script>
export default {
    data() {
        return {
            testimonials: [],
            testimonies: ''
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