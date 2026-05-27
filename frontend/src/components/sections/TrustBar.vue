
<script setup>
const certifications = [
  { name: 'Miami-Dade NOA', label: 'Hurricane Approved' },
  { name: 'Energy Star', label: 'Certified Efficiency' },
  { name: 'BBB Accredited', label: 'A+ Rated Business' },
  { name: 'Florida DBPR', label: 'Licensed Contractor' },
  { name: 'HVHZ Certified', label: 'High Velocity Zone' }
]
</script>

<template>
  <section class="py-10 bg-white border-b border-gray-100">
    <div class="max-w-6xl mx-auto px-6">
      <!-- Título sutil de la barra -->
      <p class="text-center text-[9px] tracking-[0.6em] uppercase text-gray-400 mb-10 font-bold">
        Compliance & Certifications
      </p>

      <div class="flex flex-wrap justify-center items-center gap-12 md:gap-20">
        <div 
          v-for="cert in certifications" 
          :key="cert.name"
          class="flex flex-col items-center group cursor-default"
        >
          <!-- Placeholder de Logo (Aquí pondrías el SVG o PNG real) -->
          <div class="mb-3 transition-all duration-500 filter grayscale group-hover:grayscale-0 opacity-40 group-hover:opacity-100 transform group-hover:scale-110">
            <!-- Usamos un icono genérico elegante para el ejemplo -->
            <svg class="w-8 h-8 text-santi-blue" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2L1 12h3v9h6v-6h4v6h6v-9h3L12 2z" v-if="cert.name === 'Florida DBPR'"/>
              <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" v-else/>
            </svg>
          </div>

          <!-- Texto de la certificación -->
          <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-santi-blue">
            {{ cert.name }}
          </span>
          <span class="text-[8px] tracking-[0.1em] text-gray-400 font-light mt-1 uppercase">
            {{ cert.label }}
          </span>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Efecto de suavizado para las imágenes/iconos */
.grayscale {
  transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}
</style>