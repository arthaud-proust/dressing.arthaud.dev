import { useClothingCategoriesBalance } from '@/composables/useClothingCategoriesBalance';
import { describe, expect, test } from 'vitest';

describe('missingCountForCategory', () => {
    test('return 1 when 2 min and 1 current', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 2,
            },
            current: {
                1: 1,
            },
            available: {
                1: 0,
            },
        });

        expect(balance.missingCountForCategory(1)).toBe(1);
    });

    test('return 0 when 2 min and 2 current', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 2,
            },
            current: {
                1: 2,
            },
            available: {
                1: 0,
            },
        });

        expect(balance.missingCountForCategory(1)).toBe(0);
    });
});

describe('isCategoryIncomplete', () => {
    test('return true when 2 min and 1 current', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 2,
            },
            current: {
                1: 1,
            },
            available: {
                1: 0,
            },
        });

        expect(balance.isCategoryIncomplete(1)).toBe(true);
    });

    test('return false when 2 min and 2 current', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 2,
            },
            current: {
                1: 2,
            },
            available: {
                1: 0,
            },
        });

        expect(balance.isCategoryIncomplete(1)).toBe(false);
    });
});

describe('canCategoryBeCompleted', () => {
    test('return false when not enough available', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 2,
            },
            current: {
                1: 0,
            },
            available: {
                1: 0,
            },
        });

        expect(balance.canCategoryBeCompleted(1)).toBe(false);
    });

    test('return true when enough available', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 2,
            },
            current: {
                1: 0,
            },
            available: {
                1: 2,
            },
        });

        expect(balance.canCategoryBeCompleted(1)).toBe(true);
    });
});

describe('isCategoryCompletedWithSelection', () => {
    test('return true when can be completed and enough selected', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 2,
            },
            current: {
                1: 1,
            },
            available: {
                1: 1,
            },
        });

        balance.toggleClothingSelection({
            clothes_category_id: 1,
            id: 0,
        });

        expect(balance.isCategoryCompletedWithSelection(1)).toBe(true);
    });

    test('return false when can be completed and not enough selected', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 2,
            },
            current: {
                1: 1,
            },
            available: {
                1: 1,
            },
        });

        expect(balance.isCategoryCompletedWithSelection(1)).toBe(false);
    });

    test('return true when cannot be completed and max is selected', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 3,
            },
            current: {
                1: 0,
            },
            available: {
                1: 2,
            },
        });

        balance.toggleClothingSelection({
            clothes_category_id: 1,
            id: 0,
        });
        balance.toggleClothingSelection({
            clothes_category_id: 1,
            id: 1,
        });

        expect(balance.isCategoryCompletedWithSelection(1)).toBe(true);
    });

    test('return false when cannot be completed and not max selected', () => {
        const balance = useClothingCategoriesBalance({
            min: {
                1: 3,
            },
            current: {
                1: 0,
            },
            available: {
                1: 2,
            },
        });

        balance.toggleClothingSelection({
            clothes_category_id: 1,
            id: 0,
        });

        expect(balance.isCategoryCompletedWithSelection(1)).toBe(false);
    });
});
