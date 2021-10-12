<template>
    <b-container class="mt-5">
        <b-form @submit="onSubmit" @onReset="onReset" v-if="show">
            <b-form-group
                id="name-group"
                label="Name"
                label-for="name"
            >
                <b-form-input
                    id="name"
                    v-model="form.name"
                    type="text"
                    placeholder="Enter your name."
                    required
                >
                </b-form-input>
            </b-form-group>
            <b-form-group
                id="group-email"
                label="Email Address"
                label-for="email"
                description="We'll never share your email with anyone else."
            >
                <b-form-input
                    id="email"
                    v-model="form.email"
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
                    v-model="form.password"
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
                    v-model="form.cpassword"
                    type="password"
                    placeholder="Confirm your password."
                    required
                >
                </b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary">Submit</b-button>
            <b-button type="reset" variant="danger">Reset</b-button>

        </b-form>
    </b-container>
</template>

<script>
export default{
    data() {
        return {
            form: {
                name: '',
                email: '',
                passord: '',
                cpassword: ''
            },
            show: true
        }
        

    },
    methods: {
        onSubmit(event) {
            event.preventDefault()
            
            this.$store.dispatch('register', this.form)
            .then(() => 
                this.$nextTick(function () {
                    this.$router.push('/') 
                })
            )
            .catch(err => console.log(err))
            alert(JSON.stringify(this.form))
        },
        onReset(event) {
            event.preventDefault()
            this.form.name = ''
            this.form.email = ''
            this.form.password = ''
            this.form.cpassword = ''
            this.show = false
            this.nextTick(() => {
                this.show = true
            })
        }
    }
}
</script>
