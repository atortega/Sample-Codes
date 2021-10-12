<template>
    <main>

        <div class="container-fluid">
            <b-navbar toggleable="lg" variant="dark" type="dark">
                <b-navbar-brand to='/'>
                    <img alt="Pacifico Seaside Lodge" src="/images/logo/pacificolodge-small.png" >
                </b-navbar-brand>

                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                <b-collapse id="nav-collapse" is-nav>
                    <b-navbar-nav>
                        <b-nav-item exact-active-class="active" to="/">Home</b-nav-item>
                        <b-nav-item exact-active-class="active" to="/category">Category</b-nav-item>
                        <b-nav-item-dropdown text="Rooms" right>
                            <b-dropdown-item to="/">Ocean View</b-dropdown-item>
                            <b-dropdown-item to="/">Garden View</b-dropdown-item>
                            <b-dropdown-item to="/">Inner View</b-dropdown-item>
                            <b-dropdown-item to="/">Bunk Beds Room at Garden View</b-dropdown-item>
                            <b-dropdown-item to="/">Bunk Beds Room at Inner View</b-dropdown-item>
                        </b-nav-item-dropdown>

                    </b-navbar-nav>
                    <b-navbar-nav class="ml-auto">
                        <b-nav-item exact-active-class="active" to="/login" v-if='!isLoggedIn' >Login</b-nav-item>
                        <b-nav-item exact-active-class="active" to="/register" @click="showModal($event)" v-if='!isLoggedIn' >Register</b-nav-item>

                        <b-nav-item exact-active-class="active" to="/admin" v-if='isLoggedIn' >Admin</b-nav-item>
                        <b-nav-item-dropdown text="Profile" right v-if='isLoggedIn'>
                            <div>
                                <b-card
                                    title=""
                                    img-src="/images/profile.jpg"
                                    img-alt="Image"
                                    img-top
                                    tag="article"
                                    style="max-width: 20rem;"
                                    class="mb-2"
                                >
                                    <b-card-text>
                                        {{ user.email }}
                                    </b-card-text>
                                    <b-button href="#" variant="primary" @click="logout($event)">Logout</b-button>
                                </b-card>
                            </div>
                        </b-nav-item-dropdown>
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>
        </div>
        


        <b-modal ref="register-modal" id="register-modal" hide-footer title="Sign Up" >
            <form ref="registerForm" @submit.stop.prevent="formSubmit">
                <b-form-group
                    label="Name"
                    label-for="name-input"
                    invalid-feedback="Name is required"
                    :state="nameState"
                >
                    <b-form-input
                        id="name-input"
                        v-model="name"
                        :state="nameState"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    id="group-email"
                    label="Email Address"
                    label-for="email"
                    description="We'll never share your email with anyone else."
                >
                    <b-form-input
                        id="email"
                        v-model="email"
                        type="email"
                        placeholder="Enter Email"
                        required
                    >
                    </b-form-input>
                </b-form-group>
                <b-form-group
                    id="password-group"
                    label="Password"
                    label-for="password"
                >
                    <b-form-input
                        id="password"
                        v-model="password"
                        type="password"
                        placeholder="Enter your password."
                        required
                    >
                    </b-form-input>
                </b-form-group>
                <b-form-group
                    id="cpassword-group"
                    label="Verify Password"
                    label-for="cpassword"
                >
                    <b-form-input
                        id="cpassword"
                        v-model="password_confirmation"
                        type="password"
                        placeholder="Confirm your password."
                        required
                    >
                    </b-form-input>
                </b-form-group>

                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </form>
        </b-modal>
        
        <div class="container-fluid mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>

 <script>

    export default {
        data() {
            return {
                logged_name: '',
                logged_email: '',
                logged_id: '',
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                nameState: null
            }
        },
        computed : {
            isLoggedIn() {
                return this.$store.getters.isLoggedIn
            },
            user: function() {
                console.log(JSON.stringify(this.$store.getters.user))
                console.log(localStorage.getItem('user'))
                return this.$store.getters.user || {}
            }
            
        },
        methods: {
            logout: function (event) {
                event.preventDefault()
                console.log('Logout trigered')
                this.$store.dispatch('logout')
                .then(() => {
                    this.$router.push('/login')
                })
            },
            showModal(event) {
                event.preventDefault()
                this.$refs['register-modal'].show()
            },
            hideModal() {
                this.$refs['register-modal'].hide()
            },
            formSubmit(event) {
                this.$store.dispatch('register', {name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation})
                .then(() => 
                    this.$nextTick(function () {
                        this.$bvModal.hide('register-modal')
                        this.$router.push('/') 
                    })
                )
                .catch(err => console.log(err))
                    console.log(this.email,this.name)
            }
        },

    }
</script>
