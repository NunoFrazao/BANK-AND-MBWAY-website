<template>
    <li v-for="transaction in transactions" :key="transaction.id">
        <NotificationItem :transaction="transaction" />
    </li>
    <li v-if="transactions.length >= 5">
        <NotificationAll />
    </li>
</template>

<script setup>

//#region Imports
import NotificationItem from '@/components/navbar/NotificationItem.vue'
import NotificationAll from '@/components/navbar/NotificationAll.vue'
//#endregion

const props = defineProps({
    transactions: Array,
})

</script>