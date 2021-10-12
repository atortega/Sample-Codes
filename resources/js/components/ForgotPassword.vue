<template>
    <b-container class = "mt-5" align-h='center'>
        <b-card>
            <template #header>
                <h4 class="mb-0">Reset Your Password</h4>
            </template>
            <b-card-body>
                <b-card-text>Please enter your email to reset your account.</b-card-text>
                <b-form-input v-model="email" placeholder="Enter your email"></b-form-input>
            </b-card-body>
            <b-card-footer>
                <b-button variant="danger" @click="onCancel">Cancel</b-button>
                <b-button variant="primary" @click="onSubmit">Submit</b-button>
            </b-card-footer>
        </b-card>
    </b-container>
</template>

<script>
    export default {
        data() {
            return { 
                email: ''
            }
        },
        methods: {
            onCancel() {
                this.$router.push('/login') 
            },
            onSubmit() {

            }
        }
    }
</script>
