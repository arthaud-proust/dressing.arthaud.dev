export type ClothesCategoryDto = {
    id: number;
    name: string;
};
export type ClothesCategoryOverviewDto = {
    clothesCount: number;
    category: ClothesCategoryDto;
    dressings: Array<DressingOverviewDto>;
};
export enum ClothingCategory {
    'OTHERS' = 0,
    'TROUSERS_AND_LEGGINGS' = 1,
    'SHORTS' = 2,
    'TOPS_AND_T_SHIRTS' = 3,
    'SWEATSHIRTS_AND_JUMPERS' = 4,
    'SOCKS' = 5,
    'UNDERWEAR' = 6,
    'BRAS' = 7,
    'PYJAMAS' = 8,
    'SUITS_AND_BLAZERS' = 9,
    'SPORTSWEAR' = 10,
}
export type ClothingDto = {
    id: number;
    clothes_category_id: number;
    imageUrls: Array<any>;
    thumbUrls: Array<any>;
    description: string | null;
};
export enum DressingColor {
    'RED' = 'red',
    'AMBER' = 'amber',
    'LIME' = 'lime',
    'EMERALD' = 'emerald',
    'CYAN' = 'cyan',
    'BLUE' = 'blue',
    'VIOLET' = 'violet',
    'FUCHSIA' = 'fuchsia',
}
export type DressingDto = {
    id: number;
    name: string;
    color: DressingColor;
    clothesCount: any | number;
};
export type DressingOverviewDto = {
    dressing: DressingDto;
    clothesCount: number;
};
export type FlashMessageDto = {
    id: string;
    content: string;
};
export type UserDto = {
    email: string;
};
