<template>
    <section id="sabiduria" class="relative w-full bg-[#FFF8EA] text-gray-800 py-16 px-6 md:px-12 lg:px-20">

        <h3 class="text-3xl md:text-4xl font-extrabold text-center mb-12 text-gray-800">
            ¿Qué podemos encontrar?
        </h3>

        <div class="max-w-6xl mx-auto grid gap-8 md:grid-cols-3 text-center">
            <div
                class="group rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 bg-[#FFF8EA] border-t-4 border-t-[#124228] hover:border-t-[#238473] hover:-translate-y-2">
                <div class="p-8 flex flex-col items-center">
                    <div
                        class="flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-emerald-600 to-emerald-800 mb-6">
                        <TreePine class="w-10 h-10 text-[#FFF8EA]" />
                    </div>
                    <h4 class="font-bold text-lg mb-3 text-[#124228]">Arte y Moda</h4>
                    <div class="w-16 h-1 bg-[#238473] rounded mb-4"></div>
                    <p class="text-gray-700 leading-relaxed">

                    </p>
                </div>
            </div>

            <div
                class="group rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 bg-[#FFF8EA] border-t-4 border-t-[#124228] hover:border-t-[#238473] hover:-translate-y-2">
                <div class="p-8 flex flex-col items-center">
                    <div
                        class="flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-emerald-600 to-emerald-800 mb-6">
                        <Leaf class="w-10 h-10 text-[#FFF8EA]" />
                    </div>
                    <h4 class="font-bold text-lg mb-3 text-[#124228]">Sabores y  sentidos</h4>
                    <div class="w-16 h-1 bg-[#238473] rounded mb-4"></div>
                    <p class="text-gray-700 leading-relaxed">
                        Emprendimientos turísticos y atractivos de la Amazonia
                    </p>
                </div>
            </div>

            <div
                class="group rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 bg-[#FFF8EA] border-t-4 border-t-[#124228] hover:border-t-[#238473] hover:-translate-y-2">
                <div class="p-8 flex flex-col items-center">
                    <div
                        class="flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-emerald-600 to-emerald-800 mb-6">
                        <Handshake class="w-10 h-10 text-[#FFF8EA]" />
                    </div>
                    <h4 class="font-bold text-lg mb-3 text-[#124228]">Arte y Vive</h4>
                    <div class="w-16 h-1 bg-[#238473] rounded mb-4"></div>
                    <p class="text-gray-700 leading-relaxed">
                        Emprendimientos turísticos y atractivos de la Amazonia
                    </p>
                </div>
            </div>

            <div
                class="group rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 bg-[#FFF8EA] border-t-4 border-t-[#124228] hover:border-t-[#238473] hover:-translate-y-2">
                <div class="p-8 flex flex-col items-center">
                    <div
                        class="flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-emerald-600 to-emerald-800 mb-6">
                        <Handshake class="w-10 h-10 text-[#FFF8EA]" />
                    </div>
                    <h4 class="font-bold text-lg mb-3 text-[#124228]">Arte y Moda</h4>
                    <div class="w-16 h-1 bg-[#238473] rounded mb-4"></div>
                    <p class="text-gray-700 leading-relaxed">
                        Emprendimientos turísticos y atractivos de la Amazonia
                    </p>
                </div>
            </div>
        </div>

    </section>

</template>

<script setup>
import { Check, TreePine, Leaf, Handshake } from 'lucide-vue-next'
</script>
