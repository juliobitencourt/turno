import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';

import Globalnav from "./components/globalnav/Menu.vue";
import CheckForm from "./components/checks/Form.vue";
import ExpenseForm from "./components/expenses/Form.vue";
import ApproveCheck from "./components/admin/ApproveCheck.vue";
import DenyCheck from "./components/admin/DenyCheck.vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'

const app = createApp({});

app.component("globalnav", Globalnav);
app.component("checkform", CheckForm);
app.component("expenseform", ExpenseForm);
app.component("approvecheck", ApproveCheck);
app.component("denycheck", DenyCheck);
app.component("tabgroup", TabGroup);
app.component("tablist", TabList);
app.component("tab", Tab);
app.component("tabpanels", TabPanels);
app.component("tabpanel", TabPanel);

const mountedApp = app.mount("#app");