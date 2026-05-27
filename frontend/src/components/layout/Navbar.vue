<script setup>
import { ref } from 'vue'
const isMenuOpen = ref(false)

const navLinks = [
  { name: 'Service', href: '#' },
  { name: 'Portfolio', href: '#' },
  { name: 'Financing', href: '#' }
]
</script>

<template>
  <nav class="sticky top-0 z-[100] bg-santi-blue/95 backdrop-blur-lg border-b border-white/5 py-4 px-6 shadow-xl">
    <div class="max-w-6xl mx-auto flex justify-between items-center relative z-[120]">
      <!-- LOGO / SIGNATURE -->
      <div class="flex flex-col">
        <span class="font-cursive text-3xl md:text-5xl text-white drop-shadow-[0_2px_2px_rgba(197,160,33,0.5)]">
          Santi <span class="text-santi-gold">Solutions</span>
        </span>
        <div class="h-[1px] w-full bg-gradient-to-r from-santi-gold via-transparent to-transparent mt-[-3px] md:mt-[-5px]"></div>
      </div>

      <!-- DESKTOP MENU -->
      <div class="hidden md:flex space-x-12 text-[10px] tracking-[0.4em] uppercase font-light text-white/60">
        <a v-for="link in navLinks" :key="name" :href="link.href" class="hover:text-santi-gold transition-all duration-500">
          {{ link.name }}
        </a>
      </div>

      <!-- MOBILE HAMBURGER -->
      <button @click="isMenuOpen = !isMenuOpen" class="md:hidden p-2 text-santi-gold focus:outline-none">
        <div class="w-6 h-5 flex flex-col justify-between">
          <span :class="isMenuOpen ? 'rotate-45 translate-y-2' : ''" class="w-full h-[1.5px] bg-current transition-all duration-500 origin-center"></span>
          <span :class="isMenuOpen ? 'opacity-0' : ''" class="w-full h-[1.5px] bg-current transition-all duration-500"></span>
          <span :class="isMenuOpen ? '-rotate-45 -translate-y-2' : ''" class="w-full h-[1.5px] bg-current transition-all duration-500 origin-center"></span>
        </div>
      </button>

      <!-- CTA DESKTOP -->
      <a href="tel:+10000000000" class="hidden md:block border border-santi-gold/40 text-santi-gold px-6 py-2 rounded-full text-[9px] tracking-widest uppercase hover:bg-santi-gold hover:text-white transition-all duration-700">
        Contact Us
      </a>
    </div>

    <!-- MOBILE OVERLAY -->
    <transition enter-active-class="duration-500 ease-out" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="duration-400 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
      <div v-if="isMenuOpen" class="fixed inset-0 w-screen h-screen bg-santi-blue z-[110] flex flex-col items-center justify-center">
        <div class="flex flex-col space-y-8 relative z-10 w-full px-10 text-center">
          <a v-for="link in navLinks" :key="link.name" @click="isMenuOpen = false" :href="link.href" class="text-2xl tracking-[0.4em] uppercase font-extralight text-white/90">
            {{ link.name }}
          </a>
          <a href="tel:+10000000000" class="text-santi-gold text-xs tracking-[0.4em] uppercase border border-santi-gold/40 py-5 rounded-full mt-10">Call Specialist</a>
        </div>
      </div>
    </transition>
  </nav>
</template>