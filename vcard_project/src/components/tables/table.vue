<template>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <TableHead :campos='campos' />
                <TableBody :vcards="vcards" />
            </table>
        </div>
    </div>
</template>

<script setup>

import TableHead from "@/components/tables/TableHead.vue"
import TableBody from "@/components/tables/TableBody.vue"

const props = defineProps({
    vcards: Array
})

const campos = ['ID', 'Name', 'Actions', '', '']

</script>