<script setup>
import LeadForm from '../forms/LeadForm.vue'
</script>

<template>
    <header class="relative py-12 md:py-32 px-6 overflow-hidden bg-santi-blue">
        <!-- Elemento decorativo de fondo: un resplandor dorado muy sutil -->
        <div class="absolute top-1/4 left-0 w-96 h-96 bg-santi-gold/10 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-6xl mx-auto flex flex-col md:grid md:grid-cols-2 gap-16 items-center relative z-10">

            <!-- LEFT SIDE: BRAND IDENTITY -->
            <div
                class="space-y-10 text-center md:text-left flex flex-col items-center md:items-start order-2 md:order-1">

                <!-- Logo Principal (Aseguramos legibilidad y elegancia) -->
                <div class="relative group">
                    <img src="/img/log3.png" alt="Santiago Home Renovation"
                        class="h-40 md:h-56 object-contain brightness-110 drop-shadow-[0_10px_30px_rgba(0,0,0,0.5)] animate-fade-in">
                    <!-- Brillo sutil al pasar el ratón por el logo -->
                    <div
                        class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-1000 rounded-full blur-2xl">
                    </div>
                </div>

                <!-- Typography: Refining Florida Living -->
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-7xl font-serif italic leading-tight text-white">
                        Refining <br class="hidden md:block">
                        <span class="font-sans font-light not-italic text-santi-gold tracking-tighter">Florida
                            Living.</span>
                    </h1>
                    <p class="text-base md:text-lg text-white/50 font-light leading-relaxed max-w-md mx-auto md:mx-0">
                        Bespoke architectural consulting and high-impact structural protection for Florida's most
                        prestigious estates.
                    </p>
                </div>

                <!-- Trust Indicators (Vertical line + micro-text) -->
                <div class="flex items-center space-x-8">
                    <div class="h-16 w-[1px] bg-gradient-to-b from-santi-gold/60 to-transparent"></div>
                    <div class="flex flex-col space-y-3 text-left">
                        <div class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-santi-gold"></span>
                            <p class="text-[8px] md:text-[10px] tracking-[0.4em] uppercase text-white/40 font-medium">
                                Miami-Dade Certified</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-santi-gold/40"></span>
                            <p class="text-[8px] md:text-[10px] tracking-[0.4em] uppercase text-white/40 font-medium">
                                Hurricane Impact Experts</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: THE CRYSTAL FORM -->
            <div class="w-full max-w-md order-1 md:order-2 animate-slide-up">
                <LeadForm />
            </div>

        </div>
    </header>
</template>

<style scoped>
.animate-fade-in {
    animation: fadeIn 1.8s cubic-bezier(0.16, 1, 0.3, 1);
}

.animate-slide-up {
    animation: slideUp 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.98) translateY(10px);
    }

    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>