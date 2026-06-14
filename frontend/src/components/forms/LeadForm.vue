<script setup>
import {ref, computed, onMounted, onUnmounted} from 'vue'
import axios from 'axios'

const form = ref({
  name: '',
  email: '',
  phone: '',        // NUEVO
  zip: '',
  interest: 'select',
  budget: 'select'  // NUEVO
})

const isSelectOpen = ref(false)
const isBudgetOpen = ref(false) // NUEVO: Control para el segundo dropdown

const allOptions = [
  {value: 'select', label: 'SELECT INTEREST'},
  {value: 'windows', label: 'Impact Windows'},
  {value: 'remodeling', label: 'Interior Reno'},
  {value: 'landscaping', label: 'Outdoor Living'},
  {value: 'efficiency', label: 'Energy Systems'}
]

const budgetOptions = [
  {value: 'select', label: 'SELECT BUDGET'},
  {value: 'low', label: 'Under $5,000'},
  {value: 'mid', label: '$5,000 - $15,000'},
  {value: 'high', label: '$15,000 - $30,000'},
  {value: 'premium', label: '$30,000+'}
]

const selectOptions = computed(() => allOptions.filter(o => o.value !== 'select'))
const filteredBudgetOptions = computed(() => budgetOptions.filter(o => o.value !== 'select'))

const selectOption = (val) => {
  form.value.interest = val
  isSelectOpen.value = false
}

const selectBudget = (val) => {
  form.value.budget = val
  isBudgetOpen.value = false
}

// Cerrar al clickar fuera (Mejorado para ambos dropdowns)
const closeOnOutsideClick = (e) => {
  if (!e.target.closest('.custom-select')) isSelectOpen.value = false
  if (!e.target.closest('.budget-select')) isBudgetOpen.value = false
}

onMounted(() => window.addEventListener('click', closeOnOutsideClick))
onUnmounted(() => window.removeEventListener('click', closeOnOutsideClick))

const status = ref({loading: false, message: '', type: ''})

const submitForm = async () => {
  if (form.value.interest === 'select' || form.value.budget === 'select') {
    status.value = {loading: false, message: 'Please complete all selections.', type: 'error'}
    return
  }

  status.value.loading = true
  status.value.message = ''

  try {
    // LLAMADA AL GATEWAY CON CABECERAS EXPLICITAS
    const response = await axios.post('http://localhost:8001/api/leads/capture', {
      name: form.value.name,
      email: form.value.email,
      phone: form.value.phone,
      zip: form.value.zip,
      interest: form.value.interest,
      budget: form.value.budget // Asegúrate de que el backend espera 'budget'
    }, {
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
    });

    status.value = {
      loading: false,
      message: '¡Thanks! We will contact you shortly.',
      type: 'success'
    };

    // Reset del formulario
    form.value = {name: '', email: '', phone: '', zip: '', interest: 'select', budget: 'select'};

  } catch (error) {
    // Si hay error de validación (422), mostramos el mensaje del servidor
    const errorMsg = error.response?.data?.message || 'Error sending data. Please try again.';
    status.value = {loading: false, message: errorMsg, type: 'error'};
    console.error('CORS or API Error:', error);
  }
};
</script>


<template>
  <div class="max-w-md mx-auto relative group">
    <div class="absolute -inset-1 bg-gradient-to-r from-santi-gold/20 to-transparent rounded-2xl blur opacity-25"></div>

    <div class="relative bg-white/5 backdrop-blur-xl p-8 md:p-10 rounded-2xl shadow-2xl border border-white/10">
      <div
          class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-santi-gold/50 to-transparent"></div>

      <h2 class="text-xl font-serif italic text-white mb-8 text-center tracking-wide">
        Private <span class="not-italic font-sans font-light text-santi-gold tracking-[0.2em] uppercase text-sm ml-2">Consultation</span>
      </h2>

      <form @submit.prevent="submitForm" class="space-y-5">
        <!-- Name -->
        <div class="relative">
          <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Full Name</label>
          <input v-model="form.name" type="text" placeholder="YOUR FULL NAME" required
                 class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white placeholder:text-white/10 text-xs tracking-widest focus:border-santi-gold/50 outline-none transition-all duration-500">
        </div>

        <div class="grid grid-cols-2 gap-4">
          <!-- Email -->
          <div class="relative">
            <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Email</label>
            <input v-model="form.email" type="email" placeholder="EMAIL@DOMAIN.COM" required
                   class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white placeholder:text-white/10 text-xs tracking-widest focus:border-santi-gold/50 outline-none transition-all duration-500">
          </div>
          <!-- Phone -->
          <div class="relative">
            <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Phone</label>
            <input v-model="form.phone" type="tel" placeholder="+1 (___) ___" required
                   class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white placeholder:text-white/10 text-xs tracking-widest focus:border-santi-gold/50 outline-none transition-all duration-500">
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <!-- Zip Code -->
          <div class="relative">
            <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Zip Code</label>
            <input v-model="form.zip" type="text" placeholder="33101" required
                   class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white placeholder:text-white/10 text-xs tracking-widest focus:border-santi-gold/50 outline-none transition-all duration-500">
          </div>

          <!-- Service Dropdown -->
          <div class="relative custom-select">
            <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Service</label>
            <div @click="isSelectOpen = !isSelectOpen"
                 class="w-full bg-white/5 border border-white/10 rounded-lg p-3 cursor-pointer flex justify-between items-center hover:bg-white/10 transition-all duration-300"
                 :class="{ 'border-santi-gold/50': isSelectOpen }">
              <span :class="form.interest === 'select' ? 'text-white/20' : 'text-white/90'"
                    class="text-[9px] tracking-widest uppercase truncate">
                {{ allOptions.find(o => o.value === form.interest).label }}
              </span>
              <svg class="w-3 h-3 text-santi-gold transition-transform" :class="{ 'rotate-180': isSelectOpen }"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </div>
            <transition enter-active-class="duration-200" enter-from-class="opacity-0 scale-95"
                        enter-to-class="opacity-100 scale-100">
              <ul v-if="isSelectOpen"
                  class="absolute z-[200] w-full mt-2 bg-santi-blue border border-white/10 rounded-lg shadow-2xl py-2">
                <li v-for="option in selectOptions" :key="option.value" @click="selectOption(option.value)"
                    class="px-4 py-2 text-[9px] tracking-widest text-white/60 uppercase hover:bg-white/5 hover:text-santi-gold cursor-pointer truncate">
                  {{ option.label }}
                </li>
              </ul>
            </transition>
          </div>
        </div>

        <!-- Budget Dropdown (NUEVO) -->
        <div class="relative budget-select">
          <label class="block text-[10px] tracking-[0.3em] uppercase text-white/40 mb-2 ml-1">Estimated Budget</label>
          <div @click="isBudgetOpen = !isBudgetOpen"
               class="w-full bg-white/5 border border-white/10 rounded-lg p-3 cursor-pointer flex justify-between items-center hover:bg-white/10 transition-all duration-300"
               :class="{ 'border-santi-gold/50': isBudgetOpen }">
            <span :class="form.budget === 'select' ? 'text-white/20' : 'text-white/90'"
                  class="text-[9px] tracking-widest uppercase">
              {{ budgetOptions.find(o => o.value === form.budget).label }}
            </span>
            <svg class="w-3 h-3 text-santi-gold transition-transform" :class="{ 'rotate-180': isBudgetOpen }"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
          <transition enter-active-class="duration-200" enter-from-class="opacity-0 scale-95"
                      enter-to-class="opacity-100 scale-100">
            <ul v-if="isBudgetOpen"
                class="absolute z-[190] w-full mt-2 bg-santi-blue border border-white/10 rounded-lg shadow-2xl py-2">
              <li v-for="option in filteredBudgetOptions" :key="option.value" @click="selectBudget(option.value)"
                  class="px-4 py-2 text-[9px] tracking-widest text-white/60 uppercase hover:bg-white/5 hover:text-santi-gold cursor-pointer">
                {{ option.label }}
              </li>
            </ul>
          </transition>
        </div>

        <!-- Submit Button -->
        <button type="submit" :disabled="status.loading"
                class="w-full mt-4 bg-transparent border border-santi-gold text-santi-gold hover:bg-santi-gold hover:text-white py-4 rounded-full font-light text-[10px] tracking-[0.4em] uppercase transition-all duration-700 cursor-pointer disabled:opacity-30 active:scale-95">
          <span v-if="!status.loading">Request Quote</span>
          <span v-else class="flex items-center justify-center">
            <svg class="animate-spin h-4 w-4 mr-3 text-current" viewBox="0 0 24 24"><circle class="opacity-25" cx="12"
                                                                                            cy="12" r="10"
                                                                                            stroke="currentColor"
                                                                                            stroke-width="4"
                                                                                            fill="none"></circle><path
                class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            Processing
          </span>
        </button>

        <transition enter-active-class="transition duration-500 ease-out"
                    enter-from-class="transform translate-y-2 opacity-0"
                    enter-to-class="transform translate-y-0 opacity-100">
          <p v-if="status.message" :class="status.type === 'success' ? 'text-santi-gold' : 'text-red-400'"
             class="text-center text-[10px] tracking-[0.2em] uppercase font-light mt-4">
            {{ status.message }}
          </p>
        </transition>
      </form>
    </div>
  </div>
</template>
