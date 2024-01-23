<template>
    <a href="javascript:;" class="nav-link text-body position-relative p-0" id="dropdownMenuButton"
        data-bs-toggle="dropdown" aria-expanded="false" @click="updateState">
        <i class="fa fa-bell cursor-pointer"></i>
        <span id="transactions-notifier" class="text-center" v-if="transactions.length > 0"></span>
    </a>
</template>

<script setup>

//#region Constants
const emit = defineEmits(['state'])
//#endregion

const props = defineProps({
    transactions: Array,
})

//#region Methods
const updateState = () => {
    emit('state')
}
//#endregion

</script>

<style scoped>
span#transactions-notifier {
    content: "";
    position: absolute;
    top: -2px;
    right: -8px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #ff5252;
    color: #fff;
    font-size: 9px;
}
</style>