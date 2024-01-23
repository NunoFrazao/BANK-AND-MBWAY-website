<template>
    <!-- Personal info -->
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
            <div class="row gx-4">
                <div class="col-auto">
                    <div id="vcard-photo" class="avatar avatar-xl position-relative mask bg-gradient-primary">
                        <h3 class="text-light">{{ vcardFromName.name?.[0] || 'X' }}</h3>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">{{ vcardFromName.name || 'vCard X' }}</h5>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item">
                                <h5 class="mb-0 px-3 text-info">
                                    <span class="text-secondary text-sm opacity-7">+351</span> {{ vcardTo }}
                                </h5>
                            </li>
                            <li class="nav-item d-flex justify-content-center align-items-center">
                                <div class="col-4 d-flex">
                                    <i class="material-icons">credit_card</i>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <!-- Main -->
        <div class="row mt-4 pb-3">
            <!-- Form -->
            <div class="col-lg-6 mb-md-5">
                <form method="POST" class="form w-100">
                    <!-- Quantity input -->
                    <div class="mb-3">
                        <label for="input-quantity" class="form-label labels">Escolha a quantidade</label>
                        <input v-model="inputQuantity" type="number" :class="{ 'is-invalid': errors && errors?.value }"
                            class="form-control" id="input-quantity" placeholder="0.00€" name="quantity">
                        <div class="invalid-feedback">{{ errors?.value?.[0] }}</div>
                    </div>

                    <!-- Description input -->
                    <div class="mb-3">
                        <label for="input-description" class="form-label">Descrição</label>
                        <input v-model="inputDescription" type="text" class="form-control" id="input-description"
                            placeholder="Ex: Renda" name="description">
                    </div>
                    <br>
                    <!-- Button submit -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark w-25 m-0"
                            @click.prevent="addTransaction">Enviar</button>
                    </div>
                </form>
            </div>
            <!-- Adds -->
            <div class="col-lg-6 mb-3">
                <div class="card h-100">
                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                            <h5 class="text-white font-weight-bolder mb-4 pt-2">Work with the rockets</h5>
                            <p class="text-white">Wealth creation is an evolutionarily recent positive-sum game. It is
                                all about who take the opportunity first.</p>
                            <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                                Read More
                                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Text -->
        <div class="row mt-4 border-top">
            <p class="mt-5">A transacção será efetuada sem código de confirmação.
                <br><br>
                <small>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quibusdam vero repellat
                    doloribus vitae minus
                    dicta! Ipsum iure, dolorem laborum corporis obcaecati similique quia reiciendis, id perspiciatis
                    veritatis
                    et
                    voluptas.
                </small>
            </p>
        </div>
    </div>
</template>

<script setup>

//#region Imports
import { ref, reactive, onMounted, nextTick, watchEffect } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import config from '@/utils/config'
import axios from 'axios'
import { useToast } from "vue-toastification"
import { useVcardStore } from "@/stores/vcard.js"
//#endregion

const props = defineProps({
    vcardFrom: {
        type: String,
        default: null
    },
    vcardTo: {
        type: String,
        default: null
    }
})

watchEffect(() => {
    useVcardStore()
})

//#region Constants
const route = useRoute()
const router = useRouter()
const vcardStore = useVcardStore()
const toast = useToast()
const errors = ref([])

const vcardFrom = ref(vcardStore?.vcard?.phone_number)
const vcardTo = ref(route.params.vcardTo)
const inputQuantity = ref('')
const inputDescription = ref('')
const currentVcardFrom = ref(vcardStore?.vcard)
const currentVcardTo = ref({})
const vcardFromName = reactive({ name: vcardStore?.vcard?.name })
const newVcard = () => {
    return {
        phone_number: null,
        name: '',
        email: '',
        blocked: 0,
        confirmation_code: null,
        balance: 0,
        max_debit: 0
    }
}
//#endregion

//#region Methods
const getCurrentDate = () => {
    const currentDate = new Date()
    const year = currentDate.getFullYear()
    const month = String(currentDate.getMonth() + 1).padStart(2, '0') // Months are zero-based, so add 1
    const day = String(currentDate.getDate()).padStart(2, '0')

    const formattedDate = `${year}-${month}-${day}`
    return formattedDate
}

const getCurrentDateTime = () => {
    const currentDate = new Date()
    const year = currentDate.getFullYear()
    const month = String(currentDate.getMonth() + 1).padStart(2, '0') // Months are zero-based, so add 1
    const day = String(currentDate.getDate()).padStart(2, '0')
    const hours = String(currentDate.getHours()).padStart(2, '0')
    const minutes = String(currentDate.getMinutes()).padStart(2, '0')
    const seconds = String(currentDate.getSeconds()).padStart(2, '0')

    const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`
    return formattedDateTime
}
//#endregion

//#region Transaction
const loadVcardTo = async (vcardTo) => {
    if (!vcardTo || (vcardTo < 900000000)) {
        currentVcardTo.value = newVcard()
    } else {
        await axios.get('vcards/' + vcardTo).then((response) => {
            currentVcardTo.value = response.data.data
            vcardFromName.name = getRecipientFullName(response.data.data)
        }).catch((error) => {
            console.log(error)
        })
    }
}

const newTransaction = {
    from: {
        vcard: vcardFrom.value,
        date: getCurrentDate(),
        datetime: getCurrentDateTime(),
        type: 'D',
        value: 0,
        old_balance: 0,
        new_balance: 0,
        payment_type: 'VCARD',
        payment_reference: vcardTo.value,
        pair_vcard: vcardTo.value,
        description: inputDescription.value,
        custom_options: JSON.stringify({ isRead: false })
    },
    to: {
        vcard: vcardTo.value,
        date: getCurrentDate(),
        datetime: getCurrentDateTime(),
        type: 'C',
        value: 0,
        old_balance: 0,
        new_balance: 0,
        payment_type: 'VCARD',
        payment_reference: vcardFrom.value,
        pair_vcard: vcardFrom.value,
        description: '',
        custom_options: JSON.stringify({ isRead: false, senderName: vcardFromName.name })
    }
}

const addTransaction = async () => {
    // Update the data of the vcardFrom
    newTransaction.from.value = inputQuantity.value
    newTransaction.from.description = inputDescription.value || 'Transação'
    newTransaction.from.old_balance = currentVcardFrom.value.balance

    // Verify if the balance is enough
    if (currentVcardFrom.value.balance - inputQuantity.value > 0) {
        newTransaction.from.new_balance = (currentVcardFrom.value.balance - inputQuantity.value)

        // ######## POSTS ########

        // ### Transaction FROM
        await axios.post('transactions', newTransaction.from).then((response) => {
            if (response.status === 201) {
                toast.success(`Transaction to "${getRecipientFullName(currentVcardTo.value) || ''}" successfully`)
            }
        }).catch((error) => {
            error.response?.status != 200 ? errors.value = error.response?.data?.errors : toast.error('Error')
            // console.log(error.response.data.errors);
        })


        // Update the data of the vcardTo
        newTransaction.to.value = inputQuantity.value
        newTransaction.to.old_balance = currentVcardTo.value.balance
        newTransaction.to.new_balance = parseInt(currentVcardTo.value.balance) + inputQuantity.value

        // ### Transaction TO
        await axios.post('transactions', newTransaction.to).then((response) => {
            if (response.status === 201) {
                // Redirect to history page
                nextTick(() => { router.push({ name: 'history' }); });
            }
        }).catch((error) => {
            error.response?.status != 200 ? errors.value = errors.response?.data?.errors : toast.error('Error')
            // console.log(error.response.data.errors);
        })

        updateVcardFrom()
        updateVcardTo()
    } else {
        newTransaction.from.new_balance = null
        toast.error('Transaction invalid - Insuficient funds')
    }
}

// Update the vcardFrom
const updateVcardFrom = async () => {
    // Update the balance of the vcardFrom
    currentVcardFrom.value.balance = parseInt(currentVcardFrom.value.balance) - inputQuantity.value

    await axios.put(`vcards/${vcardFrom.value}`, currentVcardFrom.value).then((response) => {
        if (response.status === 200) {
            // console.log(currentVcardFrom.value.balance)
        }
    }).catch((error) => {
        error.response?.status != 200 ? errors.value = errors.response?.data?.errors : toast.error('Error')
        console.log(error.response.data.errors)
    })
}

// Update the vcardTo
const updateVcardTo = async () => {
    // Update the balance of the vcardTo 
    currentVcardTo.value.balance = parseInt(currentVcardTo.value.balance) + inputQuantity.value

    await axios.put(`vcards/${vcardTo.value}`, currentVcardTo.value).then((response) => {
        if (response.status === 200) {
            // console.log(currentVcardTo.value.balance)
        }
    }).catch((error) => {
        error.response?.status != 200 ? errors.value = errors.response?.data?.errors : toast.error('Error')
        console.log(error.response.data.errors)
    })
}

const getRecipientFullName = (recipient) => {
    if (recipient && recipient.name) {
        const names = recipient.name.split(' ')
        if (names.length >= 2) {
            // Display the first and last names
            return `${names[0]} ${names[names.length - 1]}`
        } else {
            // Display the full name if only one name is available
            return recipient.name
        }
    }
    return '';
}
//#endregion

//#region Lifecycle hooks
onMounted(() => {
    currentVcardFrom,
        currentVcardTo,
        loadVcardTo(vcardTo.value)
})
//#endregion
</script>

<style scoped>
label.labels {
    position: relative;
}

label.labels::after {
    content: "*";
    position: absolute;
    top: 0px;
    right: -10px;
    font-size: 0.65rem;
    color: #ff5252;
}
</style>