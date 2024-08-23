<template>
    <div>
        <div class="relative isolate flex items-center gap-x-6 overflow-hidden bg-gray-50 px-6 py-2.5 sm:px-3.5 sm:before:flex-1">
            <div class="absolute left-[max(-7rem,calc(50%-52rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
                <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)" />
            </div>
            <div class="absolute left-[max(45rem,calc(50%+8rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
                <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)" />
            </div>
            <p class="text-sm leading-6 text-gray-900">
                <a href="#">
                    <strong class="font-semibold">Indicadores Financieros</strong><svg viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true"><circle cx="1" cy="1" r="1" />
                </svg>
                    Correspondientes al día {{ new Date().toLocaleDateString() }}.
                </a>
            </p>
            <div class="flex flex-1 justify-end"></div>
        </div>

        <div class="border-b border-b-gray-900/10 lg:border-t lg:border-t-gray-900/5">
            <dl class="mx-auto grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 lg:px-2 xl:px-0">
                <div v-for="(stat, key, statIdx) in currencies" :key="stat.name" :class="[statIdx % 2 === 1 ? 'sm:border-l' : statIdx === 2 ? 'lg:border-l' : '', 'flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8']">
                    <dt class="text-sm font-medium leading-6 text-gray-500">{{ key }}</dt>
                    <!--                <dd :class="[stat.changeType === 'negative' ? 'text-rose-600' : 'text-gray-700', 'text-xs font-medium']">{{ '23%' }}</dd>-->
                    <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                        {{ new Intl.NumberFormat('es-CL', {style: 'currency', currency: 'CLP'}).format(stat.value) }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { useForm } from "laravel-precognition-vue";
import { onMounted, ref } from "vue";
import { XMarkIcon } from '@heroicons/vue/20/solid'

const latest_values = useForm("get", "/api/currencies/latest-values", {});
const currencies = ref();
const get_latest_values = async () => {
    const response = (await latest_values.submit()) as any;
    currencies.value = response.data;
    console.log(currencies.value);
};

const stats = [
    { name: 'UF', value: '$405,091.00', change: '+4.75%', changeType: 'positive' },
    { name: 'Overdue invoices', value: '$12,787.00', change: '+54.02%', changeType: 'negative' },
    { name: 'Outstanding invoices', value: '$245,988.00', change: '-1.39%', changeType: 'positive' },
    { name: 'Expenses', value: '$30,156.00', change: '+10.18%', changeType: 'negative' },
]

onMounted(async () => {
    await get_latest_values();
});
</script>
