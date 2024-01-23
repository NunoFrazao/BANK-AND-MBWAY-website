<script setup>
import { RouterLink } from "vue-router";
import { ref } from "vue";
import { useToast } from "vue-toastification"
import { useVcardStore } from "@/stores/vcard";

import router from '../router/index.js'
//import { useVcardStore } from "@/stores/vcard";

const vcardStore = useVcardStore()
const toast = useToast()

const credentials = ref({
    phone_number: '',
    password: '',
    confirmation_code: ''
})

const emit = defineEmits(['login'])

const isLoggedIn = ref(vcardStore.isLoggedIn);

const login = async () => {
    if (await vcardStore.login(credentials.value)) {
        toast.success("User " + vcardStore.vcard.name + " has logged in")
        isLoggedIn.value = true; // Update the reactive ref
        emit('login')
        router.push('/')
    } else {
        //delete Axios.defaults.headers.common.Authorization
        //vcardStore.clearVcard()
        credentials.value.password = ''
        credentials.value.confirmation_code = ''
        toast.error("Credenciais inválidas")
        //console.log(error
        router.push('/create-account')
    }
}


</script>
<template>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <!-- Form -->
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 id="formLoginTitle" class="font-weight-bolder text-center text-info text-gradient">
                                        Welcome back
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="login" method="POST" role="form">

                                        <label>Mobile Number</label>
                                        <div class="mb-3">
                                            <input type="text" required v-model="credentials.phone_number"
                                                class="form-control" placeholder="Mobile number" aria-label="Mobile Number"
                                                aria-describedby="mobile-addon" />
                                        </div>

                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" required v-model="credentials.password"
                                                class="form-control" placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon" />
                                        </div>
                                        <label>Confirm. Code</label>
                                        <div class="mb-3">
                                            <input type="password" required v-model="credentials.confirmation_code"
                                                class="form-control" placeholder="Confirmation code" aria-label="ConfCode"
                                                aria-describedby="conf-code-addon" />
                                        </div>

                                        <div class="text-center">
                                            <button id="formLoginSubmitButton" type="submit"
                                                class="btn bg-gradient-info w-100 mt-4 mb-0">
                                                Sign in
                                            </button>
                                        </div>

                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <router-link class="nav-link" :class="{ active: $route.name === 'create-account' }"
                                            :to="{ name: 'create-account' }">
                                            <a class="text-info text-gradient font-weight-bold">Sign
                                                up</a>
                                        </router-link>
                                    </p>
                                </div>
                            </div>
                        </div>  
                        <div id="div-img" class="col-xl-1"></div>
                        <!-- Image -->                   
                        <div id="div-img" class="col-xl-7">
                            <img src="../assets/img/bank-vault.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<style scoped>

div#div-img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center;
}

@media (max-width: 1200px) { 
    div#div-img {
        display: none;
    }
}

</style>
