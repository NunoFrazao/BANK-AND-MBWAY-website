import { ref, onMounted, computed, inject } from "vue";
import { defineStore } from "pinia";
import axios from "axios";

export const useVcardStore = defineStore("vcard", () => {
  const serverBaseUrl = inject("serverBaseUrl");
  // console.log(serverBaseUrl);

  // Set the base URL for Axios
  axios.defaults.baseURL = serverBaseUrl + "/api";

  // Create a reactive variable to track login status
  const isLoggedIn = ref(false)

  // Load login status on mount
  onMounted(() => {
    isLoggedIn.value = sessionStorage.getItem("isLoggedIn") === "true"
  });

  const vcard = ref(null);
  const vcardPhone = computed(() => vcard.value ?? "Anonimo");

  async function loadVcard2() {
    try {
      const response = await axios.get("vcards/me");
      vcard.value = response.data.data;
      isLoggedIn.value = true; // Set login status to true
    } catch (error) {
      clearVcard();
      console.log("401 - Unauthorized")
    }
  }

  function clearVcard() {
    delete axios.defaults.headers.common.Authorization;
    vcard.value = null;
    isLoggedIn.value = false; // Set login status to false
    sessionStorage.setItem("isLoggedIn", "false")
  }
  async function login(credentials) {
    try {
      const response = await axios.post("login", credentials);
      axios.defaults.headers.common.Authorization =
        "Bearer " + response.data.access_token;

      sessionStorage.setItem("isLoggedIn", true)
      isLoggedIn.value = true; // Set login status to true
      sessionStorage.setItem("token", response.data.access_token);

      await loadVcard2();
      return true;
    } catch (error) {
      clearVcard();
      return false;
    }
  }
  async function logout() {
    try {
      await axios.post("logout");
      clearVcard();
      return true;
    } catch (error) {
      return false;
    }
  }

  async function loadTransactions(phone_number) {
    try {
      const response = await axios.get(`vcards/${phone_number}/transactions`);
      return response.data.data;
    } catch (error) {
      console.log(error);
      // You might want to handle the error or propagate it further.
      throw error;
    }
  }

  async function deleteVcard(credentials) {
    console.log(
      Object.keys(await loadTransactions(credentials.phone_number)).length
    );
    if (credentials.balance != 0.0) {
      console.log(credentials.balance);
      return credentials.balance;
    } else if (
      Object.keys(await loadTransactions(credentials.phone_number)).length == 0
    ) {
      if (
        await axios.post(
          `vcards/${credentials.phone_number}/destroy`,
          credentials
        )
      ) {
        return 1;
      } else {
        return 0;
      }
    } else {
      console.log("entra aqui");
      if (
        await axios.post(
          `vcards/${credentials.phone_number}/delete`,
          credentials
        )
      ) {
        return 2;
      } else {
        return 0;
      }
    }
  }
  return {
    vcard,
    vcardPhone,
    loadVcard2,
    clearVcard,
    login,
    logout,
    deleteVcard,
    loadTransactions,
    isLoggedIn,
  };
});
