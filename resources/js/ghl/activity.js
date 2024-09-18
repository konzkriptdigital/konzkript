

const Activity = {
    user: KONZKRIPT_HELPER.v.user,
    renderUserList (isLoaded = false) {
        // console.log('renderUserList =>> ', isLoaded);
        if(!KONZKRIPT_HELPER.query('.userList--container')) {
            $('.hl_header > .container-fluid > .hl_header--controls > .hl_header--dropdown:not(.hl_header--phone )')
                .before(`
                    <div class="userList--container dropdown --no-caret">
                        <div class="userList--iframed dropdown-menu dropdown-menu-right">
                            <iframe id="user--list" src="${KONZKRIPT_HELPER.getScriptBaseUrl()}/user-list/${KONZKRIPT_HELPER.getCompanyId()}/${this.user.app_id}" frameborder="0" scrolling="yes"></iframe>
                        </div>
                    </div>
                `);
        }


        // console.log('isLoadedv =>>>', isLoaded, KONZKRIPT_HELPER.query('.userList--container'), KONZKRIPT_HELPER.query('#userList'))

        if(KONZKRIPT_HELPER.query('.userList--container') && !KONZKRIPT_HELPER.query('#userList') && isLoaded) {
            $('.userList--container').prepend(`
                <a id="userList" title="User Lists"
                    href="javascript:void(0);"
                    aria-haspopup="true"
                    data-toggle="dropdown"
                    aria-expanded="false"
                    class="btn btn-circle btn-primary hl_header--user-list flex items-center justify-center">
                    <i>${renderSvgSprite('user-group')}</i>
                    <span class="sr-only">User Lists</span>
                </a>`)

            // console.log($('.userList--container'));
            const userList = document.getElementById('userList');
            userList.addEventListener('click', () => {
                const self = $(this);
                if(!$('.userList--iframed').hasClass('show')) {
                    // console.log('show')
                    KONZKRIPT_HELPER.sendPostMessage({
                        ghl: {
                            "User List Component": "height"
                        }
                    }, '#user--list');
                }
            });
        }
    },
    sendInfoToApp: function () {
        // console.log(this.user);
        // this.user

        // const user = KONZKRIPT_HELPER.v.user;
        const capitalizeLetterAfterUnderscore = KONZKRIPT_HELPER.capitalizeLetterAfterUnderscore;
        const users = KONZKRIPT_HELPER.v.$store.state.users.users;
        let usersData = {};
        let currentUserData = {};
        let otherUsersData = [];

        users.forEach(user => {
            const formattedUser = {
                id: user.id,
                name: user.name,
                email: user.email,
                firstName: user.first_name,
                lastName: user.last_name,
                permissions: capitalizeLetterAfterUnderscore(user.permissions),
                roles: user.roles,
                profileColor: this.user.profileColor ?? null
            };

            if (user.id === this.user.id) {
                if (this.user.profilePhoto) {
                    formattedUser.avatar = this.user.profilePhoto;
                }

                currentUserData = formattedUser;
            } else {
                otherUsersData.push(formattedUser);
            }
        });

        usersData = {
            user: currentUserData,
            users: otherUsersData
        };

        const payload = {
            ghl: usersData
        }

        KONZKRIPT_HELPER.sendPostMessage(payload, '#konzkriptEditorIframe');
    },
    updateStatus: (value) => {
        KONZKRIPT_HELPER.sendPostMessage({
            ghl: {
                "User List Component": {
                    "value": value
                }
            }
        }, '#user--list');
    },
    styles: () => {
        const css = `
        #user--list {
            max-height: 530px;
            /* max-height: 46px; */
            width: 100%;
        }
        .userList--iframed {
            min-width: 400px;
            padding: 0;
            border-radius: 10px;
            overflow: hidden;
        }
        `;

        KONZKRIPT_HELPER.createStyle(css, `user--list-css`);
    }
}


const UserActivity = {
    throttleLimit: 200,
    lastBroadcastPosition: null,
    isPageActive: true,
    originPosition: { x: 0, y: 0 },
    start: new Date().getTime(),
    get last () {
        return {
            starTimestamp: this.start,
            starPosition: this.originPosition,
            mousePosition: this.originPosition
        };
    },
    init (user_id) {
        Activity.user.app_id = user_id;
        Activity.renderUserList(false);
        Activity.styles();

        window.onmousemove = this.throttle(e => this.handleOnMove(e));
        window.ontouchmove = this.throttle(e => this.handleOnMove(e.touches[0]));
        document.body.onmouseleave = () => this.updateLastMousePosition(this.originPosition);
        document.addEventListener("visibilitychange", () => {
            this.isPageActive = !document.hidden;
            if (!this.isPageActive) {
                // console.log('tab is away');
                // Notify the server that the user is inactive
                // window.Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).setInactive();
            }
        });

        // Handle when the window loses focus
        window.addEventListener("blur", () => {
            this.isPageActive = false;
            if (window.Livewire) {
                // Notify the server that the user is inactive
                window.Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).setInactive();
            }
        });

        // Handle when the window gains focus
        window.addEventListener("focus", () => {
            this.isPageActive = true;
        });

        // Track scrolling
        window.addEventListener('scroll', this.throttle(() => this.handleOnScroll()));

        // Track typing
        window.addEventListener('keypress', this.throttle(() => this.handleOnType()));
    },
    throttle (callback) {
        let lastFunc;
        let lastRan;
        let limit = this.throttleLimit;

        return function () {
            const context = this;
            const args = arguments;
            if (!lastRan) {
                callback.apply(context, args);
                lastRan = Date.now();
            } else {
                clearTimeout(lastFunc);
                lastFunc = setTimeout(function () {
                    if ((Date.now() - lastRan) >= limit) {
                        callback.apply(context, args);
                        lastRan = Date.now();
                    }
                }, limit - (Date.now() - lastRan));
            }
        };
    },
    updateLastMousePosition (position) {
        this.last.mousePosition = position
    },
    calcElapsedTime: (start, end) => end - start,
    calcDistance (a, b) {
        const diffX = b.x - a.x,
            diffY = b.y - a.y;

        return Math.sqrt(Math.pow(diffX, 2) + Math.pow(diffY, 2));
    },
    adjustLastMousePosition (position) {
        if (this.last.mousePosition.x === 0 && this.last.mousePosition.y === 0) {
            this.last.mousePosition = position;
        }
    },
    handleOnMove (e) {
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
        const centerX = viewportWidth / 2;
        const centerY = viewportHeight / 2;

        const absolutePosition = { x: e.clientX, y: e.clientY };
        const relativePosition = { x: (e.clientX - centerX) / (viewportWidth / 2), y: (e.clientY - centerY) / (viewportHeight / 2) };

        this.adjustLastMousePosition(absolutePosition);

        this.updateLastMousePosition(absolutePosition);

        if (this.isPageActive && (!this.lastBroadcastPosition || this.lastBroadcastPosition.x !== relativePosition.x || this.lastBroadcastPosition.y !== relativePosition.y)) {
            /* if (window.Livewire) {
                window.Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).moveMouse(relativePosition);
            } */
            // console.log('is moving')
            this.lastBroadcastPosition = relativePosition;
        }
    },
    handleOnScroll() {
        if (this.isPageActive) {
            // console.log('User is scrolling');
            // You can add your Livewire interaction here if needed
        }
    },
    handleOnType() {
        if (this.isPageActive) {
            // console.log('User is typing');
            // You can add your Livewire interaction here if needed
            // const payload = this.user.data;
            // console.log(payload, KONZKRIPT_MAIN.currentLocation);
        }
    }
}

function adjustIframeHeight(iframe) {
    if (iframe && iframe.contentWindow && iframe.contentWindow.document) {
        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
    }
}
