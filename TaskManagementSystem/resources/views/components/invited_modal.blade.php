@props(['name'])
<div x-data="{ visable: false, name: '{{ $name }}' }" x-show="visable" x-on:open-modal.window = "visable = ($event.detail.name === name)"
    x-on:close-modal.window = "visable = false" x-on:keydown.escape.window = "visable = false" style="display: none">
    <ul wire:loading.remove class="notificaiton-dropdown dropdown-menu-end  px-3 py-3 me-sm-n4">
        <p class="text-uppercase text-xs font-weight-bolder ms-2">Invite Link</p>
        <div class="flex justify-center items-center">
            <li class="notification-holder px-2">
                <a class="dropdown-item border-radius-md">
                    <div class="py-2">
                        <div class="d-flex flex-column justify-content-center">
                            <input id="link_input" class="form-control" type="text" value="{{ $this->invite_url }}">
                        </div>
                    </div>
                </a>
            </li>

            <div class="copy-btn">
                <button onclick="copyText()" class="flex items-center  bg-neutral-200 hover:bg-neutral-300 p-2 rounded"
                    data-tooltip-target="tooltip-default">
                    <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z"
                                stroke="#1C274C" stroke-width="1.5"></path>
                            <path
                                d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5"
                                stroke="#1C274C" stroke-width="1.5"></path>
                        </g>
                    </svg>
                    <span class="tooltiptext text-purple-800" id="myTooltip"></span>
                    </button>
                </button>
            </div>
        </div>

        <div class="note flex items-center justify-center my-1">
            <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM12 17.75C12.4142 17.75 12.75 17.4142 12.75 17V11C12.75 10.5858 12.4142 10.25 12 10.25C11.5858 10.25 11.25 10.5858 11.25 11V17C11.25 17.4142 11.5858 17.75 12 17.75ZM12 7C12.5523 7 13 7.44772 13 8C13 8.55228 12.5523 9 12 9C11.4477 9 11 8.55228 11 8C11 7.44772 11.4477 7 12 7Z" fill="#3486fe"></path> </g></svg>
            <p class="text-uppercase text-xxs font-weight-bolder text-gray-500 m-0 ms-1">Link will be expired after 5 minutes.</p>
        </div>


        <div x-on:click="visable = false" class="bottom-tap w-100 text-center">
            <span class="tap-to-close text-center"></span>
        </div>
    </ul>
    <script>
        function copyText() {
            var copyText = document.getElementById("link_input");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Link Copied";
            setTimeout(() => {
                tooltip.innerHTML = "";
            }, 1300);
        }
    </script>

</div>
