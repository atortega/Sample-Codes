<template>
    
    <b-container class = "mt-5">
        <b-overlay
            :show="busy"
            rounded
            opacity="0.6"
            spinner-small
            spinner-variant="primary"
            @hidden="onHidden"
        >
            <b-form class="login" @submit.prevent="login" :disabled="busy">
                <h1>Sign in</h1>
                
                <div class="alert-danger mt-5 mb-5" v-if="login_error">Invalid login details</div>
                
                
                <b-form-group
                    id="input-group-1"
                >
                    <b-form-input
                        id="email"
                        v-model="email"
                        type="email"
                        placeholder="Enter Email"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    id="input-group-password"
                >
                    <b-form-input
                        id="password"
                        v-model="password"
                        type="password"
                        placeholder="Enter Password"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    id="check-group-remember_me"
                >
                    <b-form-checkbox
                        id="remember_me"
                        v-model="remember_me"
                        name= "remember_me"
                        value="yes"
                        unchecked-value="no"
                    >Remember Me</b-form-checkbox>
                </b-form-group>
                <div><b-button block variant="primary" type="submit">Log In</b-button></div>
                <div><router-link exact-active-class="active" to="/forgotpassword" class="">Forgot Password?</router-link></div>
                <hr/>
                
            </b-form>
        </b-overlay>
    </b-container>
</template>

<script>
    export default {
      data(){
        return {
            login_error: false,
            email : "",
            password : "",
            remember_me: "no",
            busy: false
        }
      },
      methods: {
        login: function () {
            this.busy = true
            console.log('Login atttempt')
            let email = this.email 
            let password = this.password
            this.$store.dispatch('login', { email, password })
            .then(() => 
                this.$nextTick(function () {
                    this.$router.push('/') 
                })
            )
            .catch(err =>
                this.$nextTick(function () {
                    this.login_error = true;
                    console.log(err)
                })
            )
            .finally(() => { 
                console.log('Finally trigerred')
                console.log(this.$store.getters.user)
                this.busy = false
            })
        },
        showModal: function () {
            this.$root.$emit('bv::show::modal', 'register-modal', '')
        },
        onHidden: function () {

        }
      }

    }
</script>