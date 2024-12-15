import { t } from '@/app';
import { FlashMessageDto } from '@/types/generated';
import { PageProps as InertiaPageProps } from '@inertiajs/core';
import { AxiosInstance } from 'axios';
import { route as ziggyRoute } from 'ziggy-js';
import { PageProps as AppPageProps } from './';

declare global {
    interface Window {
        axios: AxiosInstance;
    }

    /* eslint-disable no-var */
    var route: typeof ziggyRoute;

    // Patch to fix $t not defined in webstorm
    var $t: typeof t;
}

declare module 'vue' {
    interface ComponentCustomProperties {
        route: typeof ziggyRoute;
        // Patch to fix $t not defined in webstorm
        $t: typeof t;
    }
}

declare module '@inertiajs/core' {
    interface PageProps extends InertiaPageProps, AppPageProps {
        clothesCategories?: Record<number, string>;
        flash: {
            success?: FlashMessageDto;
            error?: FlashMessageDto;
        };
    }
}
