import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "@/views/DashboardView.vue";
import { useVcardStore } from "@/stores/vcard.js";

// Define routes
const routes = [
    {
        path: "/",
        name: "home",
        meta: {
            title: "Dashboard",
            requiresAuth: true
        },
        component: Dashboard,
    },
    {
        path: "/tables",
        name: "tables",
        meta: {
            title: "Tabelas",
            requiresAuth: true
        },
        component: () => import("@/views/TablesView.vue"),
    },
    {
        path: "/billing",
        name: "billing",
        meta: {
            title: "Transações",
            requiresAuth: true
        },
        component: () => import("@/views/BillingView.vue"),
    },
    {
        path: "/history",
        name: "history",
        meta: {
            title: "Histórico",
            requiresAuth: true
        },
        component: () => import("@/views/HistoryView.vue"),
    },
    {
        path: "/my-contacts",
        name: "my-contacts",
        meta: {
            title: "Contatos",
            requiresAuth: true
        },
        component: () => import("@/views/MyContactsView.vue"),
    },
    {
        path: "/transaction/:vcardFrom/:vcardTo", // :userFrom and :userTo are dynamic parameters
        name: "transaction",
        meta: {
            title: "Transação",
            requiresAuth: true
        },
        component: () => import("@/views/TransactionView.vue"),
        props: true, // Pass route params as props
    },
    {
        path: "/deposit",
        name: "deposit",
        meta: {
            title: "Depósitos",
            requiresAuth: true
        },
        component: () => import("@/views/DepositView.vue"),
    },
    {
        path: "/login",
        name: "login",
        meta: {
            title: "Login",
        },
        component: () => import("@/views/LoginView.vue"),
    },
    {
        path: "/create-account",
        name: "create-account",
        meta: {
            title: "Create Account",
        },
        component: () => import("@/views/RegisterView.vue"),
    },
    {
        path: "/logout",
        name: "logout",
        meta: {
            title: "Logout",
            requiresAuth: true
        },
    },
    {
        path: "/:pathMatch(.*)*", // If no route is matched, redirect to 404
        name: "not-found",
        meta: {
            title: "Not Found",
            requiresAuth: true
        },
        component: () => import("@/views/NotFoundView.vue"),
    },
  {
    path: "/profile",
    name: "profile",
    meta: { title: "Profile" },
    component: () => import("@/views/ProfileView.vue"),
  },
];

// Create a new router instance
const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { top: 0 };
  },
});

// Capitalize the first letter of each word in a string
function capitalizeFirstLetter(string) {
  // Replace hyphens and other symbols with spaces
  string = string.replace(/[-_]/g, " ");

  return string.charAt(0).toUpperCase() + string.slice(1);
}

// Check if the user is authenticated
router.beforeEach((to, from, next) => {
    const vcardStore = useVcardStore()
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

    (requiresAuth && !vcardStore.isLoggedIn) ? next({ name: "login" }) : next()
});

// Set the page title based on the route name
router.afterEach((to) => {
    document.title = to.name ? `vCard - ${capitalizeFirstLetter(to.name)}` : "Dashboard";
});

export default router;
