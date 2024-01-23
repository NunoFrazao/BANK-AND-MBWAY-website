<template>
    <!-- Sidebar -->
    <Sidebar v-if="isLoggedIn" />

    <!-- Main content -->
    <main id="main-app-div" class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <Navbar v-if="isLoggedIn" :pageTitle="pageTitle" @logout="logout" />

        <RouterView />

        <!-- Footer -->
    </main>
    <Footer v-if="isLoggedIn" />
</template>

<script setup>

//#region Imports
import { ref, computed, onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useToast } from "vue-toastification"
import { useVcardStore } from "@/stores/vcard.js"

import config from '@/utils/config'
import Sidebar from '@/components/sidebar/Sidebar.vue'
import Navbar from '@/components/navbar/Topbar.vue'
import Footer from '@/components/footer/Footer.vue'
import Axios from 'axios'
import router from '@/router/index.js'
//#endregion

//#region Constants
const route = useRoute()
const toast = useToast()
const vcardStore = useVcardStore()
const isLoggedIn = ref(vcardStore.isLoggedIn)
//#endregion

//#region Methods
// Watch for changes in the store's isLoggedIn and update the local variable
watch(() => vcardStore.isLoggedIn, (newValue) => {
    isLoggedIn.value = newValue
});

//variavel de sessao do login
onMounted(async () => {
    try {
        const token = sessionStorage.getItem("token")
        if (token) {
            Axios.defaults.headers.common.Authorization = "Bearer " + token
            vcardStore.loadVcard2()
        }
    } catch (error) {
        console.log(error)
    }
})
//fim da variavel de sessao


//bloco para terminar a variavel de sessao
const logout = async () => {
    try {
        sessionStorage.setItem("isLoggedIn", false)
        isLoggedIn.value = false; // Update the reactive ref

        await Axios.post('logout')
        delete Axios.defaults.headers.common.Authorization
        vcardStore.clearVcard()
        // // Remove the token from storage on logout
        toast.success("Logging out. Goodbye")
        router.push('/login')
    } catch (error) {
        toast.error("It wasn't possible to end session, :(")
    }
}
//fim terminar sessao

// Set page title
const pageTitle = computed(() => route.meta?.title || 'Dashboard')
//#endregion

</script>

<style scoped>
main#main-app-div {
    margin-bottom: 100px;
}
</style>
