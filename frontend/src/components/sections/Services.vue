<script setup>
const services = [
  {
    id: '01',
    title: 'Exterior & Impact',
    description: 'High-performance impact windows and structural protection engineered for Florida’s hurricane zones.',
    icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
  },
  {
    id: '02',
    title: 'Interior Design',
    description: 'Bespoke kitchen, bathroom, and flooring renovations that redefine luxury and functional living spaces.',
    icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'
  },
  {
    id: '03',
    title: 'Outdoor Living',
    description: 'Elite landscaping and hardscaping solutions, creating seamless transitions between nature and home.',
    icon: 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.364l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z'
  },
  {
    id: '04',
    title: 'Energy Efficiency',
    description: 'Consulting on HVAC, smart insulation, and sustainable tech to optimize your home’s energy performance.',
    icon: 'M13 10V3L4 14h7v7l9-11h-7z'
  }
]
</script>

<template>
  <section class="py-24 bg-white text-santi-blue overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
      
      <!-- HEADER -->
      <div class="mb-20 text-center md:text-left flex flex-col md:flex-row md:items-end justify-between gap-8">
        <div class="max-w-2xl">
          <span class="text-santi-gold font-light tracking-[0.4em] uppercase text-[10px] mb-4 block">Our Full Spectrum</span>
          <h2 class="text-4xl md:text-5xl font-serif italic leading-tight">
            Consultancy & <br class="hidden md:block"> Execution Excellence.
          </h2>
        </div>
        <div class="hidden lg:block w-32 h-[1px] bg-santi-gold/30 mb-4"></div>
      </div>

      <!-- GRID DE SERVICIOS (Optimizado a 4 columnas) -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0 border-t border-l border-gray-100">
        <div 
          v-for="service in services" 
          :key="service.id"
          class="group relative p-10 border-r border-b border-gray-100 hover:bg-santi-blue transition-all duration-700 ease-in-out"
        >
          <!-- Número de fondo -->
          <span class="absolute top-6 right-8 text-4xl font-serif italic text-gray-50 group-hover:text-white/5 transition-colors duration-500">
            {{ service.id }}
          </span>

          <div class="relative z-10">
            <!-- Icono -->
            <div class="mb-8 w-10 h-10 flex items-center justify-center rounded-full border border-santi-gold/30 group-hover:border-santi-gold group-hover:bg-santi-gold transition-all duration-500">
              <svg class="w-4 h-4 text-santi-gold group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" :d="service.icon"></path>
              </svg>
            </div>

            <h3 class="text-[11px] tracking-[0.3em] uppercase font-bold mb-6 group-hover:text-santi-gold transition-colors duration-500">
              {{ service.title }}
            </h3>
            
            <p class="text-gray-400 font-light leading-relaxed group-hover:text-white/60 transition-colors duration-500 text-xs">
              {{ service.description }}
            </p>

            <!-- Link -->
            <div class="mt-8 flex items-center space-x-2 opacity-0 group-hover:opacity-100 transform translate-x-[-10px] group-hover:translate-x-0 transition-all duration-500">
              <span class="text-[8px] tracking-[0.2em] uppercase font-bold text-santi-gold">Discover</span>
              <div class="w-6 h-[1px] bg-santi-gold"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>