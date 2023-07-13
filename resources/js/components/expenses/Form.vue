<script setup>
import { ref, reactive } from 'vue'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { vMaska } from "maska"

const processing = ref(false)
const amount = ref(null)
const date = ref('')
const description = ref('')

const errors = reactive({
    amount: '',
    date: '',
    description: '',
})

const resetErrors = () => {
    errors.amount = '',
    errors.date = '',
    errors.description = ''
}

const send = () => {
    processing.value = true
    resetErrors()

    axios.post('/expenses/new', {
        amount: amount.value,
        date: date.value,
        description: description.value,
    })
        .then((response) => {
            window.location.href = "/expenses";
        })
        .catch((error) => {
            if (error.response.data.errors.amount) {
                errors.amount = error.response.data.errors.amount[0]
            }

            if (error.response.data.errors.date) {
                errors.date = error.response.data.errors.date[0]
            }

            if (error.response.data.errors.description) {
                errors.description = error.response.data.errors.description[0]
            }
        })
        .finally(() => processing.value = false);
}
</script>

<template>
    <div>
        <form @submit.prevent="send" enctype="multipart/form-data">
            <div class="flex-1 p-6 text-blue-500 flex flex-col gap-8">
                <div class="flex items-center gap-6">
                    <div class="flex-1 border-b flex flex-col">
                        <label for="amount" class="flex items-center gap-2 text-blue-300 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="uppercase">Amount</span>
                        </label>
                        <input
                            class="px-7 py-3"
                            type="text"
                            name=""
                            id=""
                            v-model="amount"
                            v-maska
                            data-maska="0.99"
                            data-maska-tokens="0:\d:multiple|9:\d:optional"
                            autofocus
                        >
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ errors.amount }}</span>
                    </div>
                    <span>USD</span>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex-1 border-b flex flex-col">
                        <label for="date" class="flex items-center gap-2 text-blue-300 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            <span class="uppercase">Date</span>
                        </label>
                        <VueDatePicker v-model="date" locale="pt" select-text="Selecionar" cancel-text="Cancelar" format="MM/dd/yyyy"></VueDatePicker>
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ errors.date }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex-1 border-b flex flex-col">
                        <label for="description" class="flex items-center gap-2 text-blue-300 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            <span class="uppercase">Description</span>
                        </label>
                        <input class="px-7 py-3" type="text" name="" id="" v-model="description">
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ errors.description }}</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <input :disabled="processing"
                    class="rounded bg-blue-500 hover:bg-blue-600 cursor-pointer w-full mt-6 text-center text-white p-4 uppercase font-bold text-sm transition-all"
                    :class="{ 'opacity-50': processing }" type="submit" value="Add Purchase">
            </div>
        </form>
    </div>
</template>