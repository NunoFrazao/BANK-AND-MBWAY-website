<template>
    <a class="dropdown-item border-radius-md" href="javascript:;"
        @click="handleTransactionClick(transaction.id, transaction)">
        <div class="d-flex py-1">
            <div class="avatar avatar-sm me-3  my-auto"
                :class="gradientType">
                <i class="material-icons">credit_card</i>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h6 class="text-sm font-weight-normal mb-1 font-weight-bold">
                    Transaction {{ transactionType }} {{
                        getSenderName(transaction) || transaction.value }}
                </h6>
                <p class="text-xs text-secondary mb-0 ">
                    <i class="fa fa-clock me-1"></i>
                    {{ formatTransactionDate(transaction.date) }}
                </p>
            </div>
        </div>
    </a>
</template>

<script setup>

//#region Imports
import { computed } from 'vue'
import axios from 'axios'
//#endregion

const props = defineProps({
    transaction: Object,
})

//#region Methods
// Format transaction date
const formatTransactionDate = (dateString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric' }
    const formattedDate = new Date(dateString).toLocaleDateString('pt-PT', options)
    return formattedDate
}

// Get the sender name from the transaction
const getSenderName = (transaction) => {
    try {
        const customOptions = JSON.parse(transaction.custom_options);

        // Check if custom_options is present and has the senderName property
        return (customOptions && customOptions.senderName) ? getRecipientFullName(customOptions.senderName) : `${transaction.value}€`
    } catch (error) {
        return ''
    }
}

const getRecipientFullName = (recipient) => {
    if (recipient) {
        const names = recipient.split(' ')
        if (names.length >= 2) {
            // Display the first and last names
            return `${names[0]} ${names[names.length - 1]}`
        } else {
            // Display the full name if only one name is available
            return recipient
        }
    }
    return '';
}

const handleTransactionClick = async (transactionId, transaction) => {
    const customOptions = JSON.parse(transaction.custom_options)
    customOptions.isRead = true

    await axios.patch(`transactions/${transactionId}`, { custom_options: customOptions }).then((response) => {
        if (response.status === 200) {
            // console.log('Transaction updated successfully')
        }
    }).catch((error) => {
        error.response?.status != 200 ? toast('Hmm') : toast.error('Error')
        console.log(error.response.data.errors)
    })
}

const gradientType = computed(() => {
    return props.transaction.type == 'C' ? 'bg-gradient-success' : 'bg-gradient-primary'
})

const transactionType = computed(() => {
    return props.transaction.type == 'C' ? 'from' : 'of'
})
//#endregion

</script>