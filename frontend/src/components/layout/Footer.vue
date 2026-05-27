<script setup>
const currentYear = new Date().getFullYear()

const socialLinks = [
  { name: 'Instagram', href: '#', icon: 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.439-.645-1.439-1.44s.644-1.44 1.439-1.44z' },
  { name: 'Facebook', href: '#', icon: 'M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.803.715-1.803 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.324v-21.35c0-.732-.593-1.325-1.325-1.325z' },
  { name: 'LinkedIn', href: '#', icon: 'M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z' }
]

const quickLinks = ['Services', 'Portfolio', 'Financing', 'About Us', 'Contact']
</script>

<template>
  <footer class="bg-santi-blue text-white pt-20 pb-10 px-6 border-t border-white/5 relative overflow-hidden">
    <!-- Logo de fondo fantasmagórico -->
    <div class="absolute -bottom-20 -right-20 opacity-[0.02] pointer-events-none">
      <img src="/img/log3.png" alt="" class="w-96">
    </div>

    <div class="max-w-6xl mx-auto">
      <div class="grid md:grid-cols-4 gap-16 mb-20">
        
        <!-- COLUMN 1: BRAND -->
        <div class="md:col-span-2 space-y-8">
          <div class="flex flex-col">
            <span class="font-cursive text-4xl md:text-5xl text-white drop-shadow-[0_2px_2px_rgba(197,160,33,0.5)]">
              Santi <span class="text-santi-gold">Solutions</span>
            </span>
            <div class="h-[1px] w-32 bg-gradient-to-r from-santi-gold to-transparent mt-[-5px]"></div>
          </div>
          <p class="text-white/50 font-light leading-relaxed max-w-sm text-sm italic">
            "Refining Florida Living through bespoke architectural solutions and uncompromised hurricane protection."
          </p>
          
          <!-- SOCIAL MEDIA -->
          <div class="flex space-x-6">
            <a v-for="social in socialLinks" :key="social.name" :href="social.href" class="text-white/40 hover:text-santi-gold transition-colors duration-500">
              <span class="sr-only">{{ social.name }}</span>
              <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path :d="social.icon" />
              </svg>
            </a>
          </div>
        </div>

        <!-- COLUMN 2: QUICK LINKS -->
        <div class="space-y-6">
          <h4 class="text-[10px] tracking-[0.4em] uppercase font-bold text-santi-gold">Navigation</h4>
          <ul class="space-y-4">
            <li v-for="link in quickLinks" :key="link">
              <a href="#" class="text-xs text-white/40 hover:text-white tracking-widest transition-colors duration-300">{{ link }}</a>
            </li>
          </ul>
        </div>

        <!-- COLUMN 3: CONTACT INFO -->
        <div class="space-y-6">
          <h4 class="text-[10px] tracking-[0.4em] uppercase font-bold text-santi-gold">Inquiries</h4>
          <ul class="space-y-4 text-xs text-white/40 font-light tracking-widest leading-loose">
            <li>Serving Miami, Fort Lauderdale & Palm Beach</li>
            <li><a href="mailto:info@santisolutions.com" class="hover:text-white transition-colors">info@santisolutions.com</a></li>
            <li><a href="tel:+10000000000" class="hover:text-white transition-colors">+1 (555) 000-0000</a></li>
          </ul>
        </div>
      </div>

      <!-- BOTTOM BAR -->
      <div class="pt-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="text-[9px] tracking-[0.3em] uppercase text-white/20">
          © {{ currentYear }} Santi Solutions & Santiago Home Renovation, Inc.
        </div>
        <div class="flex space-x-8 text-[9px] tracking-[0.3em] uppercase text-white/20">
          <a href="#" class="hover:text-santi-gold transition-colors">Privacy Policy</a>
          <a href="#" class="hover:text-santi-gold transition-colors">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>
</template>