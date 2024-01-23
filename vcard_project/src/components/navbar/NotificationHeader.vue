<template>
    <li v-if="noTransactions">
        <a class="dropdown-item text-center mb-2 border-radius-md" href="javascript:;">
            0 notifications
        </a>
    </li>
    <li v-else>
        <h6 class="dropdown-header px-2 text-dark mb-2">
            Latest {{ transactionsLength }} notifications
        </h6>
    </li>
</template>

<script setup>

//#region Imports
import { computed } from 'vue'
//#endregion

const props = defineProps({
    transactions: Array,
})

//#region Methods
const transactionsLength = computed(() => props.transactions.length);
const noTransactions = computed(() => transactionsLength.value === 0);
//#endregion

</script>