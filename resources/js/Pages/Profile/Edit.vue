<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VPageHeader from '@/Components/VPageHeader.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>
    <Head :title="$t('profil')" />

    <AuthenticatedLayout>
        <template #header>
            <VPageHeader :title="$t('profil')" />
        </template>

        <div class="mx-auto max-w-md space-y-20 py-12">
            <UpdateProfileInformationForm
                :must-verify-email="mustVerifyEmail"
                :status="status"
            />

            <UpdatePasswordForm />

            <section class="space-y-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ $t('se_dconnecter') }}
                    </h2>
                </header>

                <VButton
                    :href="route('logout')"
                    method="post"
                    as="button"
                    variant="danger"
                    >{{ $t('se_dconnecter') }}
                </VButton>
            </section>

            <DeleteUserForm />
        </div>
    </AuthenticatedLayout>
</template>
