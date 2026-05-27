<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const form = ref({
  name: '',
  email: '',
  zip: '',
  interest: 'select'
})

const isSelectOpen = ref(false)

const allOptions = [
  { value: 'select', label: 'SELECT INTEREST' },
  { value: 'windows', label: 'Impact Windows' },
  { value: 'remodeling', label: 'Interior Reno' },
  { value: 'landscaping', label: 'Outdoor Living' },
  { value: 'efficiency', label: 'Energy Systems' }
]

// 1. FILTRAR: Esto quita el "Select Interest" de la lista desplegable
const selectOptions = computed(() => {
  return allOptions.filter(option => option.value !== 'select')
})

const selectOption = (val) => {
  form.value.interest = val
  isSelectOpen.value = false
}

// Cerrar al clickar fuera
const closeOnOutsideClick = (e) => {
  if (!e.target.closest('.custom-select')) isSelectOpen.value = false
}
onMounted(() => window.addEventListener('click', closeOnOutsideClick))
onUnmounted(() => window.removeEventListener('click', closeOnOutsideClick))

const status = ref({ loading: false, message: '', type: '' })

const submitForm = async () => {

  if (form.value.interest === 'select') {
    status.value = {
      loading: false,
      message: 'Please select a service of interest.',
      type: 'error'
    }
    return
  }

  status.value.loading = true
  status.value.message = ''

  try {
    // LLAMADA AL GATEWAY (Puerto 8001)
    await axios.post('http://localhost:8001/api/leads/capture', {
      name: form.value.name,
      email: form.value.email,
      zip: form.value.zip,
      interest: form.value.interest
    })

    status.value = {
      loading: false,
      message: '¡Thanks! We will contact you shortly.',
      type: 'success'
    }

    form.value = { name: '', email: '', zip: '', interest: 'select' }

  } catch (error) {
    status.value = {
      loading: false,
      message: 'Error sending data. Please try again.',
      type: 'error'
    }
  }
}
</script>

<template>
  <div class="max-w-md mx-auto relative group">
    <!-- Efecto de resplandor sutil detrás del cristal -->
    <div class="absolute -inset-1 bg-gradient-to-r from-santi-gold/20 to-transparent rounded-2xl blur opacity-25"></div>

    <!-- Contenedor Principal (Efecto Cristal) -->
    <div
      class="relative bg-white/5 backdrop-blur-xl p-8 md:p-10 rounded-2xl shadow-2xl border border-white/10">

      <!-- Línea decorativa dorada superior muy fina -->
      <div
        class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-santi-gold/50 to-transparent">
      </div>

      <h2 class="text-xl font-serif italic text-white mb-8 text-center tracking-wide">
        Private <span
          class="not-italic font-sans font-light text-santi-gold tracking-[0.2em] uppercase text-sm ml-2">Consultation</span>
      </h2>

      <form @submit.prevent="submitForm" class="space-y-6">
        <!-- Full Name -->
        <div class="relative">
          <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Full Name</label>
          <input v-model="form.name" type="text" placeholder="YOUR FULL NAME" required
            class="w-full bg-white/5 border border-white/10 rounded-lg p-4 text-white placeholder:text-white/10 text-xs tracking-widest focus:border-santi-gold/50 focus:bg-white/10 outline-none transition-all duration-500">
        </div>

        <!-- Email -->
        <div class="relative">
          <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Email Address</label>
          <input v-model="form.email" type="email" placeholder="EMAIL@DOMAIN.COM" required
            class="w-full bg-white/5 border border-white/10 rounded-lg p-4 text-white placeholder:text-white/10 text-xs tracking-widest focus:border-santi-gold/50 focus:bg-white/10 outline-none transition-all duration-500">
        </div>

        <div class="grid grid-cols-2 gap-6">
          <!-- Zip Code -->
          <div class="relative">
            <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Zip Code</label>
            <input v-model="form.zip" type="text" placeholder="33101" required
              class="w-full bg-white/5 border border-white/10 rounded-lg p-4 text-white placeholder:text-white/10 text-xs tracking-widest focus:border-santi-gold/50 outline-none transition-all duration-500">
          </div>
          

          <!-- Interest (Custom Select) -->
          <div class="relative custom-select">
            <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Service</label>

            <!-- Trigger -->
            <div @click="isSelectOpen = !isSelectOpen"
              class="w-full bg-white/5 border border-white/10 rounded-lg p-4 cursor-pointer flex justify-between items-center hover:bg-white/10 transition-all duration-300"
              :class="{ 'border-santi-gold/50': isSelectOpen }">
              <span :class="form.interest === 'select' ? 'text-white/20' : 'text-white/90'"
                class="text-[10px] tracking-widest uppercase">
                {{allOptions.find(o => o.value === form.interest).label}}
              </span>
              <svg class="w-3 h-3 text-santi-gold transition-transform duration-300"
                :class="{ 'rotate-180': isSelectOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>

            <!-- Dropdown Menu -->
            <transition enter-active-class="transition duration-200 ease-out"
              enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100">
              <ul v-if="isSelectOpen"
                class="absolute z-[200] w-full mt-2 bg-santi-blue border border-white/10 rounded-lg shadow-2xl py-2 max-h-60 overflow-y-auto">
                <li v-for="option in selectOptions" :key="option.value" @click="selectOption(option.value)"
                  class="px-4 py-3 text-[10px] tracking-widest text-white/60 uppercase hover:bg-white/5 hover:text-santi-gold cursor-pointer transition-colors">
                  {{ option.label }}
                </li>
              </ul>
            </transition>
          </div>

        </div>

        <!-- Submit Button -->
        <button type="submit" :disabled="status.loading"
          class="w-full mt-4 bg-transparent border border-santi-gold text-santi-gold hover:bg-santi-gold hover:text-white py-4 rounded-full font-light text-[11px] tracking-[0.4em] uppercase transition-all duration-700 cursor-pointer disabled:opacity-30 active:scale-95">
          <span v-if="!status.loading">Request Quote</span>
          <span v-else class="flex items-center justify-center">
            <svg class="animate-spin h-4 w-4 mr-3 text-current" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none">
              </circle>
              <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
              </path>
            </svg>
            Processing
          </span>
        </button>

        <!-- Status Message -->
        <transition enter-active-class="transition duration-500 ease-out"
          enter-from-class="transform translate-y-2 opacity-0" enter-to-class="transform translate-y-0 opacity-100">
          <p v-if="status.message" :class="status.type === 'success' ? 'text-santi-gold' : 'text-red-400'"
            class="text-center text-[10px] tracking-[0.2em] uppercase font-light mt-4">
            {{ status.message }}
          </p>
        </transition>
      </form>
    </div>
  </div>
</template>
