<script setup>
// En un futuro, estos datos vendrán de tu portfolio-service
const featuredProjects = [
  {
    id: 1,
    title: 'Coral Gables Estate',
    category: 'Full Impact Installation',
    image: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&q=80&w=1000',
    size: 'large' // Ocupará más espacio
  },
  {
    id: 2,
    title: 'Modern Kitchen',
    category: 'Interior Renovation',
    image: 'https://i.pinimg.com/736x/17/23/79/172379d4f7aef13d67b6d73e17e42335.jpg',
    size: 'small'
  },
  {
    id: 3,
    title: 'Miami Beach Penthouse',
    category: 'Energy Efficiency Systems',
    image: 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=600',
    size: 'small'
  },
  {
    id: 4,
    title: 'Boca Raton Residence',
    category: 'Impact Doors',
    image: 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&q=80&w=600',
    size: 'small'
  },
  {
    id: 5,
    title: 'Palm Beach Outdoor',
    category: 'Hardscaping',
    image: 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&q=80&w=600',
    size: 'small'
  }
]
</script>

<template>
  <section class="py-24 bg-gray-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
      
      <!-- HEADER -->
      <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
        <div class="max-w-xl">
          <span class="text-santi-gold font-light tracking-[0.4em] uppercase text-[10px] mb-4 block">Craftsmanship</span>
          <h2 class="text-4xl md:text-5xl font-serif italic text-santi-blue leading-tight">
            Selected Works & <br> Recent Transformations.
          </h2>
        </div>
        <a href="#" class="group flex items-center bg-white space-x-4 text-[10px] tracking-[0.3em] uppercase text-santi-blue font-bold pb-2 border-b border-santi-gold/30 hover:border-santi-gold transition-all duration-500">
          <span>Explore Full Portfolio</span>
          <svg class="w-3 h-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
      </div>

      <!-- ASYMMETRIC GRID -->
      <div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto md:h-[800px]">
        
        <!-- MAIN PROJECT (Izquierda) -->
        <div class="md:col-span-7 h-[400px] md:h-full group relative overflow-hidden rounded-2xl shadow-xl">
          <img :src="featuredProjects[0].image" :alt="featuredProjects[0].title" class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110" />
          <div class="absolute inset-0 bg-gradient-to-t from-santi-blue/80 via-transparent to-transparent opacity-60 group-hover:opacity-90 transition-all duration-700"></div>
          <div class="absolute bottom-0 left-0 p-10 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-700">
            <p class="text-santi-gold text-[10px] tracking-[0.4em] uppercase mb-2">{{ featuredProjects[0].category }}</p>
            <h3 class="text-2xl font-serif italic text-white">{{ featuredProjects[0].title }}</h3>
          </div>
        </div>

        <!-- SECONDARY PROJECTS (Derecha) -->
        <div class="md:col-span-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-6 h-full">
          
          <div v-for="project in featuredProjects.slice(1, 3)" :key="project.id" 
               class="relative group overflow-hidden rounded-2xl shadow-lg h-[250px] md:h-full">
            <img :src="project.image" :alt="project.title" class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110" />
            <div class="absolute inset-0 bg-santi-blue/40 opacity-0 group-hover:opacity-100 transition-all duration-700 flex items-center justify-center p-6 text-center">
              <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-700">
                <p class="text-santi-gold text-[8px] tracking-[0.3em] uppercase mb-2">{{ project.category }}</p>
                <h3 class="text-lg font-serif italic text-white">{{ project.title }}</h3>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>