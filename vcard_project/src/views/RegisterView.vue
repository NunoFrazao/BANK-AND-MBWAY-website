<script setup>
import { RouterLink, RouterView } from "vue-router";
import { ref, onMounted, nextTick } from "vue";
import { useToast } from "vue-toastification"

import Axios from 'axios';
import config from '@/utils/config'
import router from '../router/index.js'

const toast = useToast()

const data = ref({
    vcard: {
        phone_number: '',
        name: '',
        email: '',
        password: '',
        confirmation_code: ''
    }
})

const registerVcard = async () => {
    Axios.post('register', data.value.vcard).then((response) => {
        //this.success = "Dados enviados com sucesso";
        //this.response = JSON.stringify(response, null, 2)
        toast.success("A sua conta foi registada com sucesso")
        const status = response
        console.log(status)
        if (status.data.status == true) {
            nextTick(() => {
                router.push('/login');
            });
        } else {
            nextTick(() => {

                router.push('/create-account');
            });
        }
    }).catch(error => {
        toast.error("Não foi possivel criar a sua conta")
        console.log(data.value.vcard);
        // error.response = 'Error: ' + error.response.status
    })
}

</script>
<template>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-center bg-transparent">
                                    <h3 id="formRegisterTitle"
                                        class="font-weight-bolder text-center text-info text-gradient">
                                        Register with</h3>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="registerVcard" method="POST" role="form">
                                        <div class="mb-3">
                                            <input type="text" v-model="data.vcard.phone_number" class="form-control"
                                                placeholder="Mobile Number" aria-label="Mobile"
                                                aria-describedby="mobile-addon">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" v-model="data.vcard.name" class="form-control"
                                                placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                                        </div>
                                        <div class="mb-3">
                                            <input type="email" v-model="data.vcard.email" class="form-control"
                                                placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" v-model="data.vcard.password" class="form-control"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon">
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" v-model="data.vcard.confirmation_code" class="form-control"
                                                placeholder="Confirmation Code" aria-label="Confirmation Code"
                                                aria-describedby="code-addon">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                                up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">Already have an account?
                                        <router-link class="nav-link" :class="{ active: $route.name === 'login' }"
                                            :to="{ name: 'login' }"><a class="text-info text-gradient font-weight-bold">Sign
                                                in</a>
                                        </router-link>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>