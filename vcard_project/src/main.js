import "@/assets/main.css";
// import '@/assets/base.css'
import axios from "axios";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "@/App.vue";
import router from "@/router";

const app = createApp(App);

//#region Toasts styles
app.use(Toast, {
  position: "top-center",
  timeout: 3000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: true,
  hideProgressBar: true,
  closeButton: "button",
  icon: true,
  rtl: false,
});
//#endregion

//#region serverAPI
const serverBaseUrl = "http://vcard.test";
app.provide("serverBaseUrl", serverBaseUrl);
// Default Axios configuration
axios.defaults.baseURL = serverBaseUrl + "/api";
axios.defaults.headers.common["Content-type"] = "application/json";
//#endregion

app.use(createPinia());
app.use(router);
app.mount("#app");
