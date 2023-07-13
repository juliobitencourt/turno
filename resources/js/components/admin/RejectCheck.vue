<script setup>
import { ref } from 'vue'

const processing = ref(false)

const props = defineProps({
    check: {
        type: String,
        required: true
    }
})


const reject = () => {
    processing.value = true

    axios.put(`/admin/checks/reject/${props.check.id}`)
        .then((response) => {
            window.location.href = "/admin/checks";
        })
        .catch((error) => {
            console.log(error)
        })
        .finally(() => processing.value = false);
}
</script>

<template>
    <button
        @click.prevent="reject"
        class="flex-1 flex justify-center items-center border border-blue-500 rounded px-6 py-3 uppercase text-xs font-semibold gap-1"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Reject</span>
    </button>
</template>