<div>
    <li class=" pe-2 d-flex align-items-center " style="position: relative">
        <a wire:click="NotificationsBill({{Auth::user()}})" class="nav-link text-body p-0" aria-expanded="false">
            <i class="fa fa-bell cursor-pointer"></i>
        </a>

        <x-notifications_modal.user-notification name="notify">
        </x-notifications_modal.user-notification>

        <x-notifications_modal.loading_indicator>
        </x-notifications_modal.loading_indicator>
    </li>

    
</div>
