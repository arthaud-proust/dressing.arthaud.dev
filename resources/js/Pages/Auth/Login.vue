<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VCheckbox from '@/Components/Base/VCheckbox.vue';
import VInput from '@/Components/Base/VInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    canResetPassword?: boolean;
    status?: string;
    prefilledCredentials: {
        email: string;
        password: string;
        remember: boolean;
    } | null;
}>();

const form = useForm(
    props.prefilledCredentials ?? {
        email: '',
        password: '',
        remember: false,
    },
);

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head :title="$t('se_connecter')" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" :value="$t('email')" />

                <VInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" :value="$t('mot_de_passe')" />

                <VInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="mt-1 block rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    {{ $t('mot_de_passe_oubli') }}
                </Link>

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <VCheckbox
                        name="remember"
                        v-model:checked="form.remember"
                    />
                    <span class="ms-2 text-sm text-gray-600">{{
                        $t('se_souvenir_de_moi')
                    }}</span>
                </label>
            </div>

            <div class="mt-4 flex flex-col gap-1">
                <VButton
                    type="submit"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ $t('se_connecter') }}
                </VButton>

                <VButton variant="ghost" :href="route('register')">
                    {{ $t('s_inscrire') }}
                </VButton>
            </div>
        </form>
    </GuestLayout>
</template>
