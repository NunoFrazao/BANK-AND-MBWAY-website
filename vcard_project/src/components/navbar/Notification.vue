<template>
    <li class="nav-item dropdown pe-2 d-flex align-items-center">
        <!-- Notification icon -->
        <NotificationIcon @state="loadTransactions" :transactions="transactions" />
        
        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            <NotificationHeader :transactions="transactions" />
            <NotificationBody :transactions="transactions" />
        </ul>
    </li>
</template>

<script setup>

//#region Imports
import { ref, onMounted, watch } from 'vue'
import { useVcardStore } from "@/stores/vcard.js"
import axios from 'axios'
import NotificationIcon from '@/components/navbar/NotificationIcon.vue'
import NotificationHeader from '@/components/navbar/NotificationHeader.vue'
import NotificationBody from '@/components/navbar/NotificationBody.vue'
//#endregion

//#region Constants
const vcardStore = useVcardStore()
const transactions = ref([])
const customOptions = ref({})
//#endregion

//#region Methods
// Load unread transactions
const loadTransactions = async (phone_number) => {
    try {
        if (!vcardStore?.vcard?.phone_number) return

        await axios.get(`vcards/${vcardStore.vcard.phone_number}/transactions/unread`).then((response) => {
            transactions.value = response.data
        }).catch((error) => {
            console.log(error)
        })

        // Accessing custom_options of each transaction in a loop
        transactions.value.forEach((transaction) => {
            // Parse custom_options to convert it from a string to an object
            customOptions.value = JSON.parse(transaction.custom_options)
        })

    } catch (error) {
        console.error(error)
    }
}

// Watch for changes in the transactions array
watch(transactions, () => {
    // Accessing custom_options of each transaction in a loop
    transactions.value.forEach((transaction) => {
        // Parse custom_options to convert it from a string to an object
        customOptions.value = JSON.parse(transaction.custom_options)
    })
})
//#endregion

//#region Lifecycle hooks
// Watch for changes in the vcard property
watch(() => vcardStore.vcard, (newVcard, oldVcard) => {
    if (newVcard && newVcard.phone_number) {
        loadTransactions(newVcard.phone_number)
    }
})

onMounted(() => {
    // Load transactions initially if vcard is available
    if (vcardStore.vcard && vcardStore.vcard.phone_number) {
        loadTransactions(vcardStore.vcard.phone_number)
    }
})
//#endregion

</script>