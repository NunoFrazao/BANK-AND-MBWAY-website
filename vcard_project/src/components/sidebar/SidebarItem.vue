<template>
    <li class="nav-item">
        <RouterLink :to="to">
            <a class="nav-link" :class="{ active: isExactActive }">
                <!-- Icon -->
                <div
                    class="icon icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons" :class="isExactActive ? 'text-light' : 'text-secondary'">{{ description.icon }}</i>
                </div>

                <!-- Description -->
                <span class="nav-link-text ms-1">
                    {{ description.description }}
                </span>
            </a>
        </RouterLink>
    </li>
</template>

<script setup>

import { ref, computed } from 'vue'

const props = defineProps({
    to: String,
    description: Object,
    currentRoute: String // Add the currentRoute prop
})

const isExactActive = computed(() => {
    return props.currentRoute === props.to
})

</script>