
const KONZKRIPT_MAIN = {
    isInitialized: false,
    currentLocation: null,
    _location () {

    },
    _agency () {

    },
    _$router () {
        KONZKRIPT_HELPER.v.$router.afterEach((to, from) => {
            console.log(to, from);
            if(to.params.location_id != from.params.location_id) {
                this.init();
            }
        });
    },
    async init () {
        console.log('init');
        Loading.showLoading();

        /**
         * Initializes the application by setting up the iframe, restoring the console log, initializing the assets, showing the loading screen, and initializing the main component.
         * @returns {void}
         */
        KONZKRIPT_HELPER.setIframe(`${KONZKRIPT_HELPER.getScriptBaseUrl()}/editor/${KONZKRIPT_HELPER.getCompanyId()}`, 'konzkriptEditorIframe');
        KONZKRIPT_HELPER.restoreConsoleLog();

        Assets.init();
        await test(1);
        await test(2);
        await test(3);
        await test(4);

        if(!this.isInitialized) {

            KONZKRIPT_MAIN._$router();
            Activity.sendInfoToApp();
            KONZKRIPT_HELPER.initPostMessage();
            this.isInitialized = !this.isInitialized;
        }

        Loading.removeLoading();
        console.log('finish');
    },
}

/**
 * Observes the '#app' element for changes in its properties.
 * When the properties change, the main component is initialized.
 * @type {ElementObserver}
 * @property {boolean} isInitialized - A flag indicating whether the main component has been initialized.
 * @property {string} currentLocation - The current location.
 */
ElementObserver.observe('#app', {
    properties: [KONZKRIPT_HELPER.vString +'.$store.state.locations.locations', KONZKRIPT_HELPER.vString +'.$router.currentRoute.name'],
    callback: (element) => {
        // console.log('Element with properties found2:', element[KONZKRIPT_HELPER.vString].$store.state.locations.currentLocation);
        // Your code to manipulate the element goes here
        // console.log('Element with properties found2:', element[KONZKRIPT_HELPER.vString].$router.currentRoute.name);
        if(element[KONZKRIPT_HELPER.vString].$router.currentRoute.name && element[KONZKRIPT_HELPER.vString].$store.state.locations.currentLocation) {
            ElementObserver.disconnect('appObserver');
            KONZKRIPT_MAIN.currentLocation = element[KONZKRIPT_HELPER.vString].$store.state.locations.currentLocation;
            KONZKRIPT_MAIN.init();
        }
    },
    throttleTime: 200,
    id: 'appObserver' // Same ID as above, so it should not execute
});
