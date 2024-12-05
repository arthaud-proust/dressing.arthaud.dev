<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VInput from '@/Components/Base/VInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value?.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => {
            form.reset();
        },
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-4">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ $t('supprimer_le_compte') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ $t('une_fois_votre_compte_supprim_toutes_ses_ressource') }}
            </p>
        </header>

        <VButton variant="danger" @click="confirmUserDeletion"
            >{{ $t('supprimer_le_compte') }}
        </VButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ $t('tesvous_sr_de_vouloir_supprimer_votre_compte') }}
                </h2>

                <p class="mt-2 text-gray-600">
                    {{
                        $t('une_fois_que_votre_compte_est_supprim_toutes_ses_r')
                    }}
                </p>

                <div class="mt-6">
                    <InputLabel
                        for="password"
                        :value="$t('mot_de_passe')"
                        class="sr-only"
                    />

                    <VInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        :placeholder="$t('mot_de_passe')"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <VButton variant="tertiary" @click="closeModal">
                        {{ $t('annuler') }}
                    </VButton>

                    <VButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                        variant="danger"
                    >
                        {{ $t('supprimer_le_compte') }}
                    </VButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
