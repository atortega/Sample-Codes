<template>
    <b-container fluid>
        <b-row>
            <b-col cols="2" class='bg-dark'>
                <admin_sidebar></admin_sidebar>
            </b-col>
            <b-col cols="10">
               <router-view name="admin_view"></router-view>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import admin_sidebar from './admin_sidebar.vue';
export default {
    
    components: {admin_sidebar},

}
</script>