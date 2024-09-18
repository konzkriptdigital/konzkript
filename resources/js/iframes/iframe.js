const moment = require('moment');
const $ = require('jquery');


const userList = {
    init () {
        console.log('init')
        /**
         * Sending a message to the parent window to indicate that the user list component is fully loaded.
         * The payload contains an object with a key "User List Component" and a value object with a key "isLoaded" set to true.
         */
        window.parent.postMessage({
            "app": {
                "User List Component": {
                    "isLoaded": true
                }
            }
        }, '*');

        this.listener();
    },
    listener () {

        /**
         * Listening for messages from the parent window.
         * When the message contains the key "Requesting Height User List Component", the height of the user list component is sent to the parent window.
         * The payload contains an object with a key "User List Component" and a value object with a key "height" set to the height of the user list component.
        */
        window.addEventListener('message', (event) => {
            console.log('component event ==>>> ', event)
            if(event.data.hasOwnProperty('ghl') && event.data.ghl.hasOwnProperty('User List Component')) {
                const component = event.data.ghl['User List Component'];
                if(component === 'height') {
                    this.setUserListComponentHeight();
                }

                if(component.value && component.value.event === 'update') {
                    // $wire.updateUserStatus(component.value.user)
                    const data = component.value.user;
                    const user = data.user;
                    const status = data.is_online;
                    const last_seen_at = data.last_seen_at;
                    const id = user.ghl_id;
                    console.log('status =>>> ', status)
                    if(id) {
                        console.log($, id);
                        console.log($(`.user--item[data-id="${id}"]`));
                        const userStatusElement = $(`.user--item[data-id="${id}"]`).find('.user--status');
                        if(status) {
                            userStatusElement.after(`<label class="rounded-[7px] bg-[#A6F4C5] text-[#054F31] ">Active</label>`);
                        }
                        else {
                            userStatusElement.after(`<div class="text-xs text-blue-600 dark:text-blue-500 user--status">Last seen ${moment(last_seen_at).fromNow()}</div>`);
                        }

                        setTimeout(() => {
                            this.setUserListComponentHeight();
                        });
                        userStatusElement.remove();
                    }
                }
            }
        });
    },
    setUserListComponentHeight() {
        const payload = {
            "app": {
                'User List Component': {
                    'height': document.getElementById('dropdownNotification').scrollHeight
                }
            }
        }
        window.parent.postMessage(payload, '*');
    },
}

userList.init();
