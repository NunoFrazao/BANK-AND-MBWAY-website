<template>
    <thead>
        <tr>
            <th v-for="campo in campos" :key="campo" @click="sortTable(campo)"
                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ campo }}</th>
            <th class="text-secondary opacity-7"></th>
        </tr>
    </thead>
</template>

<script>
export default {
    name: 'TableComponent',
    props: {
        campos: {
            type: Array,
        }
    }
}
</script>