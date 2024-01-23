<template>
  <!-- Main content -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>History table</h6>
            </div>
            <div class="col-md-12">
              <div class="card h-100">
                <div class="card-header pb-0 px-4">
                  <div class="row">
                    <div class="col-md-6">
                      <h6 class="mb-0">Your Transactions</h6>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                      <i class="far fa-calendar-alt me-2"></i>
                      <small>{{ formattedDate }}</small>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-4 px-4">
                  <ul class="list-group">
                    <li v-for="transaction in paginatedTransactions" :key="transaction.id" :value="transaction.id"
                      class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                      <div class="d-flex align-items-center">
                        <button
                          class="btn btn-icon-only btn-rounded mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"
                          :class="transactionType(transaction) == 'C'
                            ? 'btn-outline-success'
                            : 'btn-outline-danger'
                            ">
                          <i :class="transactionType(transaction) == 'C'
                            ? 'fas fa-arrow-up'
                            : 'fas fa-arrow-down'
                            "></i>
                        </button>
                        <div class="d-flex flex-column">
                          <h6 class="mb-1 text-dark text-sm">
                            {{ transaction.description || 'Transação' }}
                          </h6>
                          <span class="text-xs">{{
                            transaction.datetime
                          }}</span>
                        </div>
                      </div>
                      <div class="d-flex align-items-center text-gradient text-sm font-weight-bold" :class="transactionType(transaction) == 'C'
                            ? 'text-success'
                            : 'text-danger'
                          ">
                        {{ transaction.value }}
                      </div>
                    </li>
                  </ul>

                  <!-- Pagination controls -->
                  <div class="pagination mt-4">
                    <button @click="prevPage" :disabled="currentPage === 1">
                      Previous
                    </button>
                    <span>Page {{ currentPage }} of {{ totalPages }}</span>
                    <button @click="nextPage" :disabled="currentPage === totalPages">
                      Next
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { useDateFormat, useNow } from "@vueuse/core";
import axios from "axios";
import config from "../utils/config.js";

const vcard = ref([]);

// Define props
const props = defineProps({
  pageTitle: String,
});

// Date formatting logic
const formattedDate = useDateFormat(useNow(), "DD MMMM YYYY");

// Define pageTitle
const pageTitle = ref("Histórico");

const transactions = ref([]);

const fetchTransactions = async () => {
  try {
    const response = await axios.get(
      `${config.baseAPI}/vcards/${config.phoneNumber}/transactions`
    );
    transactions.value = response.data.data;
    //console.log("transactions:", transactions.value);
    // console.log("response data:", response.data.data);
  } catch (error) {
    console.error("Error fetching transactions:", error);
  }
};

const transactionType = (transaction) => {
  return transaction.type;
};

const loadTransactions = () => {
  axios
    .get(`vcards/${config.phoneNumber}/transactions`)
    .then((response) => {
      transactions.value = response.data.data;
    })
    .catch((error) => {
      console.log(error);
    });
};

const itemsPerPage = 10;
const currentPage = ref(1);

const totalPages = computed(() =>
  Math.ceil(transactions.value.length / itemsPerPage)
);

const paginatedTransactions = computed(() => {
  const startIndex = (currentPage.value - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  return transactions.value.slice(startIndex, endIndex);
});

const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

onMounted(async () => {
  // console.log("Component is mounted");
  await fetchTransactions();
});
</script>
