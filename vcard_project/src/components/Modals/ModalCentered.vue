<script setup>
import {RouterLink} from "vue-router";
import {ref} from "vue";
import {useToast} from "vue-toastification"
import {useVcardStore} from "@/stores/vcard"

import router from '@/router/index.js'

const vcardStore=useVcardStore()
const toast=useToast()

const credentials=ref({
    phone_number: vcardStore.vcard.phone_number,
    balance: vcardStore.vcard.balance,
    confirmation_code: ''
})

const emit=defineEmits(['confirmDelete'])

const confirmDelete=async () => {
    await vcardStore.deleteVcard(credentials.value).then((response) => {
        console.log(response)
        console.log(vcardStore.vcard.balance)


        if(response==vcardStore.vcard.balance) {
            toast.error(`Não foi possivel eliminar o vCard, ainda tem ${response}€ disponivel na sua conta`)
        } else if(response==1) {

            toast.error("O vCard foi eliminado permanentemente do sistema, irá ser redirecionado para a página de registo")
            router.push("/create-account")

        } else if(response==2) {
            toast.warning("O vCard foi eliminado parcialmente, irá ser redirecionado para o login")
            router.push("/create-account")
        }
    }).catch((error) => {
        console.log(error);
    });
}

</script>


<template>
    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="confirmationModalLabel">Are you sure that you want the delete
                        your vCard
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="confirmDelete" method="POST" role="form">
                        <label>Confirmation Code</label>
                        <div class="mb-3">
                            <input type="password" required v-model="credentials.confirmation_code" class="form-control"
                                placeholder="Confirmation Code" aria-label="Confirmation Code"
                                aria-describedby="password-addon" />
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" id="btnSubmit" class="btn btn-primary">Save changes</button>
                            <button type="button" id="btnCancel" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
#btnSubmit {
    background-image: linear-gradient(310deg, #181c30, #2b425f);
    margin-right: 5px;
}
</style>