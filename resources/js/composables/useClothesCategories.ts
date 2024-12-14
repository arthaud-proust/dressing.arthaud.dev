import { usePage } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';

export const useClothesCategories = () => {
    const page = usePage();
    const { t } = useI18n();

    const clothesCategories = page.props.clothesCategories ?? [];

    const name = (categoryId?: number) =>
        (categoryId ? clothesCategories[categoryId] : undefined) ??
        t('non_categorises');

    const options = Object.entries(clothesCategories).map(([id, name]) => ({
        value: Number.parseInt(id),
        label: name,
    }));

    return {
        name,
        options,
    };
};
