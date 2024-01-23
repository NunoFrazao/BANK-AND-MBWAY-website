<template>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>

            <!-- Redirect to dashboard page -->
            <RouterLink to="/">
                <a class="navbar-brand m-0 d-flex align-items-center" href="/" :class="{ active: currentRoute === '/' }"
                    @click="handleRedirectToDashboard">
                    <i class="material-icons text-secondary">dashboard</i>
                    <span class="ms-1 font-weight-bold">VCard Dashboard</span>
                </a>
            </RouterLink>
        </div>
        <hr class="horizontal dark mt-0">

        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <!-- Sidebar pages list -->
                <SidebarItem v-for="(description, idx) in descriptions" :key="idx" :to="getRouteName(idx)"
                    :icon="icons[idx]" :description="descriptions[idx]" :current-route="currentRoute"
                    @click="handleSidebarItemClick(getRouteName(idx))">
                </SidebarItem>

                <!-- Divider -->
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>

                <!-- Other options -->
                <li class="nav-item">
                    <RouterLink to="/profile">
                        <a class="nav-link" :class="{ active: currentRoute === '/profile' }">
                            <div
                                class="icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons">credit_card</i>
                            </div>
                            <span class="nav-link-text ms-1">Profile</span>
                        </a>
                    </RouterLink>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="">
                        <div
                            class="icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons text-secondary">money</i>
                        </div>
                        <span class="nav-link-text ms-1">Bank Vault</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="">
                        <div
                            class="icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons text-secondary">build</i>
                        </div>
                        <span class="nav-link-text ms-1">Options</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup>

import { ref, computed } from 'vue'
import SidebarItem from '@/components/sidebar/SidebarItem.vue'

let currentRoute = ref('/') // Initialize with a default value

const descriptions = [
    { description: 'Dashboard', icon: 'home' },
    { description: 'Tables', icon: 'assessment' },
    { description: 'Billing', icon: 'payment' },
    { description: 'History', icon: 'history' },
    { description: 'Contacts', icon: 'contacts' }
]

const icons = ['home', 'table', 'payment', 'history', 'contacts']

const getRouteName = (idx) => {
    // Define the route names as per your application
    const routeNames = ['/', '/tables', '/billing', '/history', '/my-contacts']
    return routeNames[idx]
}

const handleRedirectToDashboard = () => {
    currentRoute.value = '/'
}

const handleSidebarItemClick = (route) => {
    currentRoute.value = route
}

</script>