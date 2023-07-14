<script setup>
import { ref, reactive, watch } from 'vue'
import { vMaska } from "maska"

const processing = ref(false)
const description = ref('')
const amount = ref(null)
const file = ref('')
const filePreview = ref('')

const errors = reactive({
    amount: '',
    description: '',
    file: '',
})

const resetErrors = () => {
    errors.amount = '',
        errors.date = '',
        errors.description = ''
}

watch(file, async () => {
    if (file.value) {
        filePreview.value = URL.createObjectURL(file.value)
    } else {
        filePreview.value = ''
    }
});

const formatAmount = () => {
    let number = amount.value
    amount.value = Number(number).toFixed(2)
}

const send  = () => {
    processing.value = true
    resetErrors()

    axios.post('/checks/new', {
        description: description.value,
        amount: amount.value,
        file: file.value,
    }, {
        headers: {
            "Content-Type": "multipart/form-data",
        }
    })
    .then((response) => {
        window.location.href = "/checks";
    })
    .catch((error) => {
        if (error.response.data.errors.amount) {
            errors.amount = error.response.data.errors.amount[0]
        }

        if (error.response.data.errors.description) {
            errors.description = error.response.data.errors.description[0]
        }

        if (error.response.data.errors.file) {
            errors.file = error.response.data.errors.file[0]
        }
    })
    .finally(() => processing.value = false);
}
</script>

<template>
    <div>
        <form @submit.prevent="send" enctype="multipart/form-data">
            <div class="mx-auto lg:w-3/6 flex-1 p-6 text-blue-500 flex flex-col gap-8">
                <div class="flex items-center gap-6">
                    <div class="flex-1 border-b flex flex-col">
                        <label for="amount" class="flex items-center gap-2 text-blue-300 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="uppercase">Amount</span>
                        </label>
                        <input
                            class="px-7 py-3"
                            type="text"
                            v-model="amount"
                            v-maska
                            data-maska="0.99"
                            data-maska-tokens="0:\d:multiple|9:\d:optional"
                            @blur="formatAmount"
                            autofocus
                        >
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ errors.amount }}</span>
                    </div>
                    <span>USD</span>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex-1 border-b flex flex-col">
                        <label for="description" class="flex items-center gap-2 text-blue-300 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            <span class="uppercase">Description</span>
                        </label>
                        <input class="px-7 py-3" type="text" name="" id="" v-model="description">
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ errors.description }}</span>
                    </div>
                </div>

                <div
                    v-if="!filePreview"
                    class="border-dashed border-2 p-12"
                >
                    <label class="grid place-items-center cursor-pointer">
                        <input class="hidden" type="file" @input="file = $event.target.files[0]"  />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <span class="uppercase mt-6">Upload Check Picture</span>
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ errors.file }}</span>
                    </label>
                </div>

                <div
                    v-else
                    class="flex flex-col justify-center items-center"
                >
                    <img
                        width="350"
                        :src="filePreview" alt="Preview Image"
                    >
                    <button
                        @click.prevent="file = ''"
                        class="border rounded my-2 py-1 px-4 text-gray-400 hover:text-gray-500 text-xs hover:bg-gray-50 transition-colors"
                        title="Remove File"
                    >Remove</button>
                </div>
            </div>
            <div class="mx-auto lg:w-3/6 p-6">
                <input
                    :disabled="processing"
                    class="rounded bg-blue-500 hover:bg-blue-600 cursor-pointer w-full mt-6 text-center text-white p-4 uppercase font-bold text-sm transition-all"
                    :class="{'opacity-50': processing}"
                    type="submit"
                    value="Deposit Check"
                >
            </div>
        </form>
    </div>
</template>