<template>
    <tbody>
        <tr v-for="(vcard, idx) in filteredVcards" :key="vcard.id">
            <!-- Vcard id -->
            <td class="align-middle">
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ idx + 1 }}</h6>
                    </div>
                </div>
            </td>
            <!-- Vcard name -->
            <td class="align-middle">
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ vcard.name }}</h6>
                    </div>
                </div>
            </td>
            <td class="align-middle">
                <RouterLink :to="{ path: `/transaction/${vcardFrom}/${vcard.phone_number}` }" class="w-100">
                    <a href="javascript:;" class="tableActions font-weight-bold text-xs transaction-link" data-toggle="tooltip"
                        data-original-title="Edit vcard">
                        Enviar Dinheiro
                    </a>
                </RouterLink>
            </td>
            <td class="align-middle">
                <a href="javascript:;" class="tableActions font-weight-bold text-xs" data-toggle="tooltip"
                    data-original-title="Edit vcard">
                    Pedir Dinheiro
                </a>
            </td>
            <td class="align-middle">
                <a href="javascript:;" class="tableActionsDelete font-weight-bold text-xs" data-toggle="tooltip"
                    data-original-title="Edit vcard">
                    Eliminar
                </a>
            </td>
        </tr>
    </tbody>
</template>

<script setup>

import { ref, computed } from 'vue'
import { useVcardStore } from '@/stores/vcard.js'

const vcardStore = useVcardStore()
const vcardFrom = ref(vcardStore?.vcard?.phone_number)

const props = defineProps({
    vcards: Array
})

// Get the first 6 vcards
const filteredVcards = computed(() => {
    if (Array.isArray(props.vcards)) {
        return props.vcards.slice(0, 6);
    } else {
        return [];
    }
})

</script>


<style scoped>
a.transaction-link {
    color: rgb(212, 128, 58); 
}

</style>