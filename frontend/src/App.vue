<script setup>
import { ref } from 'vue'
import Navbar from './components/layout/Navbar.vue'
import Services from './components/sections/Services.vue'
import Footer from './components/layout/Footer.vue'
import Hero from './components/sections/Hero.vue'
import TrustBar from './components/sections/TrustBar.vue'
import PortfolioTeaser from './components/sections/PortfolioTeaser.vue'

const isMenuOpen = ref(false)
</script>

<template>
  <div class="min-h-screen bg-santi-blue font-sans text-white/90 selection:bg-santi-gold/30">

    <!-- NAVIGATION BAR -->
    <Navbar />

    <main>
      <!-- HERO SECTION -->
      <Hero />

      <!-- TRUST INDICATORS BAR -->
      <TrustBar />

      <!-- PORTFOLIO TEASER -->
      <PortfolioTeaser />

      <!-- SERVICES GRID -->
      <Services />
    </main>


    <!--FOOTER -->
    <Footer />
  </div>
</template>

<style scoped>
.animate-fade-in {
  animation: fadeIn 1.5s ease-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }

  to {
    opacity: 1;
    transform: scale(1);
  }
}
</style>
