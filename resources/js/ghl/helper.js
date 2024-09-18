const ElementObserver = {
    observers: new Map(),

    observe(selector, options = {}) {
        const {
            properties = [],
            callback,
            throttleTime = 100,
            id = selector,
        } = options;

        // If an observer with this ID already exists, disconnect it first
        if (this.observers.has(id)) {
            this.disconnect(id);
        }

        let lastExecutionTime = 0;
        const throttledCallback = (...args) => {
            const now = Date.now();
            if (now - lastExecutionTime >= throttleTime) {
                lastExecutionTime = now;
                callback(...args);
            }
        };

        const observer = new MutationObserver(() => {
            const element = document.querySelector(selector);
            if (element && this._hasProperties(element, properties)) {
                throttledCallback(element);
            }
        });

        const targetNode = document.body;
        const config = {
            childList: true,
            subtree: true,
        };

        observer.observe(targetNode, config);
        this.observers.set(id, observer);

        // Trigger initial check immediately
        const element = document.querySelector(selector);
        if (element && this._hasProperties(element, properties)) {
            throttledCallback(element);
        }
    },

    _hasProperties(element, properties) {
        return properties.every(propertyPath => {
            try {
                return propertyPath.split('.').reduce((obj, prop) => obj && obj[prop], element);
            } catch (e) {
                return false;
            }
        });
    },

    disconnect(id) {
        if (this.observers.has(id)) {
            this.observers.get(id).disconnect();
            this.observers.delete(id);
        }
    },

    disconnectAll() {
        this.observers.forEach((observer, id) => {
            observer.disconnect();
            this.observers.delete(id);
        });
    }
};

/**
 * A helper object for interacting with the DOM and Vue.
 * @namespace KONZKRIPT_HELPER
 */

const KONZKRIPT_HELPER = {
    app: $('#app'),
    av: 'v',
    au: 'u',
    ae: 'e',
    get vString () {
        /**
         * Gets the string representation of the Vue instance.
         * @returns {string} The string representation of the Vue instance.
         */
        return `__${this.av}${this.au}${this.ae}__`;
    },
    get v () {
        /**
         * Gets the Vue instance of the current page.
         * @returns {Vue} The Vue instance of the current page.
         */
        return document.querySelector('#app')[this.vString];
    },
    getScriptBaseUrl: () => {
        /**
         * Gets the base URL of the script element.
         * @returns {string} The base URL of the script element.
         */
        const scriptElement = document.getElementById('acquirely--script');
        const scriptSrc = scriptElement.getAttribute('src');
        const url = new URL(scriptSrc);
        const localUrls = ['127.0.0.1', 'localhost'];
        const isLocal = localUrls.includes(url.hostname);
        return `${url.protocol}//${url.host}`;

    },
    getCompanyId: () => {
        /**
         * Gets the company ID from the script element.
         * @returns {string} The company ID.
         */
        const scriptElement = document.getElementById('acquirely--script');
        const scriptSrc = scriptElement.getAttribute('src');
        const url = new URL(scriptSrc);
        const segments = url.pathname.split('/').filter(Boolean);
        const lastSegment = segments.pop();
        return lastSegment;
    },
    setIframe (src, id) {
        /**
         * Sets up an iframe with the specified source and ID.
         * @param {string} src - The source URL of the iframe.
         * @param {string} id - The ID of the iframe.
         * @returns {void}
         */
        if(this.query(`#${id}`)) return;
        const iframe = `<iframe id="${id}" src="${src}" scrolling="yes" frameborder="0"></iframe>`;
        // const iframe = `<iframe id="konzkriptEditorIframe" src="${this.getScriptBaseUrl()}/editor/${this.getCompanyId()}"></iframe>`;
        this.app.append(iframe);
    },
    initPostMessage () {
        /**
         * Process the message received in the parent window.
         * The message can be a string or an object.
         * If the message is a string, it is processed as a key-value pair.
         * If the message is an object, it is processed as a key-value pair.
         * The key-value pairs are processed using the processPostMessageData function.
         * @param {Event} event - The event object containing the message received in the parent window.
         * @returns {void}
         */
        const onMessage = (event) => {
            console.log('event =>>> ', event);
            if(typeof event.data === 'string') {
                this.processPostMessageData(event.data);
            }
            else {
                if(event.data.hasOwnProperty('app')) {
                    const data = event.data.app;
                    this.processPostMessageData(data);
                }
            }
        }

        /**
         * Add an event listener for the message event.
         * The event listener will be triggered when a message is received in the parent window.
         * The message can be a string or an object.
         */
        if (window.addEventListener) {
            window.addEventListener("message", onMessage, false);
        }

        if (window.attachEvent) {
            window.attachEvent("onmessage", onMessage, false);
        }
    },
    processPostMessageData (data) {
        /**
         * Process the data received in the parent window.
         * The data is used to trigger specific actions based on the data.
         * The data is used to pass data to the action.
         * @param {*} data - The data received in the parent window.
         * @returns {void}
         */

        if(data.userId) {
            UserActivity.init(data.userId.id);
        }

        // console.log('data =>>> ', data)
        if(data.hasOwnProperty("User List Component")) {
            const {
                isLoaded,
                height,
                value
            } = data['User List Component'];

            if(isLoaded) {
                Activity.renderUserList(true);
            }

            if(height) {
                $('#user--list').css({height: height+'px'});
            }

            if(value && value.event && value.user) {
                Activity.updateStatus(value);
            }
        }
    },
    sendPostMessage (data, id) {
        /**
         * Send a message to the specified iframe.
         * @param {*} data - The data to be sent to the iframe.
         * @param {string} id - The ID of the iframe.
         * @returns {void}
         */
        const iframe = this.query(id);
        console.log('sendPostMessage => ', iframe, data, id);
        iframe.contentWindow.postMessage(data, '*');
    },
    query (element) {
        /**
         * Query the specified element.
         * @param {string} element - The CSS selector of the element to query.
         * @returns {Element|null} The element found by the CSS selector or null if no element is found.
         */
        return document.querySelector(element);
    },
    queryAll (element) {
        /**
         * Query all elements matching the specified CSS selector.
         * @param {string} element - The CSS selector of the elements to query.
         * @returns {NodeList} A NodeList containing all elements matching the specified CSS selector.
         */
        return document.querySelectorAll(element);
    },
    createStyle (css, selector, className = null) {
        /**
         * Create a style element with the specified CSS and append it to the head of the document.
         * @param {string} css - The CSS to be applied to the style element.
         * @param {string} selector - The ID of the style element.
         * @param {string} className - The class name of the style element.
         * @returns {void}
         */
        if(this.query(`#${selector}`)) return;
        var style = document.createElement('style');
        style.id = selector;
        style.innerHTML = css;

        if (className) {
            style.classList.add(className);
        }

        document.getElementsByTagName('head')[0].appendChild(style);
    },
    appWatch(elements, properties, callback) {
        /**
         * Watches the specified elements for changes in their properties.
         * @param {string} elements - The CSS selector of the elements to watch.
         * @param {string[]} properties - An array of property names to watch.
         * @param {function} callback - The function to call when the properties change.
         * @returns {function} A function that stops watching the elements.
         *
         * @example
         * // Watch for changes in the 'title' property of the element with the ID 'my-element'
         * const stopWatching = KONZKRIPT_HELPER.appWatch('#my-element', ['title'], (value) => {
         *   console.log('Title changed:', value);
         * });
         *
         * // Stop watching the elements
         * stopWatching();
         */
        let watcher; // Variable to store the watcher function

        function watchHandler(value) {
            callback(value);
        }

        function startWatching() {
            let vElement = query(elements);
            if (vElement && vElement.hasOwnProperty(`__${av}${au}${ae}__`)) {
                vElement = vElement[`__${av}${au}${ae}__`];
            } else {
                setTimeout(() => {
                    startWatching();
                }, 100);
                return;
            }

            watcher = vElement.$watch(properties, watchHandler);
        }

        startWatching(); // Start watching when the function is called

        return function stopWatching() {
            // This function can be used to stop the watcher
            if (watcher) {
                watcher(); // Stop the watcher
                console.log('Stopped watching:', properties);
            }
        };
    },
    generateUuid () {
        /**
         * Generates a UUID (Universally Unique Identifier) using the built-in Math.random() function.
         * @returns {string} A UUID string.
         */
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0,
                v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    },
    abbreviateSentence(sentence) {
        /**
         * Abbreviates a sentence by keeping the first two words and removing the rest.
         * @param {string} sentence - The sentence to be abbreviated.
         * @returns {string} The abbreviated sentence.
         */

        if(!sentence) return;
        const words = sentence.split(' ');
        const abbreviation = words.slice(0, 2).map(word => word.charAt(0)).join('');
        return abbreviation;
    },
    interpolateString (template) {
        /**
         * Interpolates a string template with data from the current user and the location.
         * @param {string} template - The string template to be interpolated.
         * @returns {string} The interpolated string.
         */
        if(!template) return;
        let v = getV();
        const data = {
            user: v.user._data,
            location: acquirely_location,
            custom_values: window.acquirely_customValues
        }

        if(!data.user.hasOwnProperty('name')) {
            data.user.name = data.user.first_name+" "+data.user.last_name;
        }

        const getObjectValue = (obj, key) => {
            // Split the key into parts (e.g., "user.first_name" -> ["user", "first_name"])
            const keys = key.split('.');

            // Iterate through the keys to access the nested value
            let value = obj;
            for (const k of keys) {
                if (value && value.hasOwnProperty(k)) {
                    value = value[k];
                } else {
                    // If any key is not found, return undefined
                    return undefined;
                }
            }

            return value;
        }

        // Regular expression to match placeholders like {{ key }}
        const placeholderRegex = /\{\{([^}]+)\}\}/g;

        // Replace each placeholder with the corresponding value from the data object
        const interpolatedString = template.replace(placeholderRegex, (match, key) => {
            // Trim any extra spaces around the key
            key = key.trim();

            // Access the value from the data object using the key
            const value = getObjectValue(data, key);

            // If the value is found, use it; otherwise, keep the original placeholder
            return value !== undefined ? value : match;

        });

        // console.log('interpolatedString => ', interpolatedString, template, data)

        return interpolatedString;
    },
    capitalizeLetterAfterUnderscore (data) {
        // console.log(data)
        /**
         * Checks if the input is an object or a string.
         * If it is an object, it capitalizes the first letter after an underscore in each key of the object.
         * If it is a string, it capitalizes the first letter after an underscore in the string.
         * @param {object|string} data - The input to be checked.
         * @returns {object|string} The input with the first letter after an underscore capitalized.
         */

        if(typeof data === 'string') return string.replace(/_([a-z])/g, (_, letter) => letter.toUpperCase());

        const transformedObj = {};

        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                const transformedKey = key.replace(/_([a-z])/g, (match, letter) => letter.toUpperCase());
                transformedObj[transformedKey] = data[key];
            }
        }

        return transformedObj;

    },
    restoreConsoleLog () {
        /**
         * Restores the console.log function to its original state.
         */
        if (!("console" in window) || !("firebug" in console)) {
            console.log = null;
            delete console.log;
            const i = document.createElement('iframe');
            i.style.display = 'none';
            document.body.appendChild(i);
            window.console = i.contentWindow.console;
        }
    }
}


async function test (num) {
    return new Promise((resolve) => {
        setTimeout(() => {
            console.log('test =>> ' + num);
            resolve();
        }, 2000);
    });
}



