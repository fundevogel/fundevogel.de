// Type definitions for Macy.js 2.5.1
// Project: https://github.com/bigbite/macy.js
// Definitions by: Martin Folkers <https://github.com/S1SYPHOS>
// Definitions: https://github.com/DefinitelyTyped/DefinitelyTyped

declare module 'macy' {
    type MacyEvents = 'macy.initialized' | 'macy.recalculated' | 'macy.image.load' | 'macy.image.error' | 'macy.images.complete' | 'macy.resize';

    interface MacyInstance {
        /**
         * Run a function on every image load or once all images are loaded
         * @param  {Function}  func      - Function to run on image load
         * @param  {Boolean} everyLoad   - If true it will run everytime an image loads
         */
        runOnImageLoad (func: Function, everyLoad: boolean): void;

        /**
         * Recalculates masonory positions
         * @param  {Boolean} refresh - Recalculates All elements within the container
         * @param  {Boolean} loaded  - When true it sets the recalculated elements to be marked as complete
         */
        recalculate(refresh: boolean, loaded: boolean): MacyInstance;

        /**
         * Destroys macy instance
         */
        destroy(): void;

        /**
         * ReInitializes the macy instance using the already defined options
         */
        reInit(): void;

        /**
         * Event listener for macy events
         * @param key {String} - Event name to listen to
         * @param func {Function} - Function to be called when event happens
         */
        on (key: MacyEvents, func: Function): void;

        /**
         * Emit an event to macy.
         * @param key {String} - Event name to listen to
         * @param data {Object} - Extra data to be passed to the event object that is passed to the event listener.
         */
        emit (key: string, data: Object): void;
    }

    interface MacyOptions {
        container: string | HTMLElement,
        columns?: number,
        margin?: number,
        trueOrder?: boolean,
        waitForImages?: boolean,
        useImageLoader?: boolean,
        breakAt?: Object,
        useOwnImageLoader?: boolean,
        onInit?: boolean,
        cancelLegacy?: boolean,
        useContainerForBreakpoints?: boolean,
    }

    /**
     * @param options Options
     */
    export default function Macy(options: MacyOptions): MacyInstance;
}
