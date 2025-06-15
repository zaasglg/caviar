<div x-data="{
    notifications: [],
    init() {
        this.$watch('$wire.notifications', value => {
            this.notifications = value;
            setTimeout(() => this.removeOld(), 3000);
        });

        Livewire.on('toasterUpdated', () => {
            setTimeout(() => this.removeOld(), 3000);
        });
    },
    removeOld() {
        if (this.notifications.length) {
            this.notifications.shift();
            this.$wire.dismiss(this.notifications[0]?.id);
        }
    }
}" class="fixed top-4 right-4 space-y-2">
    <template x-for="notification in notifications" :key="notification.id">
        <div x-transition
            :class="{
                'bg-green-500': notification.type === 'success',
                'bg-red-500': notification.type === 'error'
            }"
            class="p-4 text-white rounded shadow-lg">
            <span x-text="notification.message"></span>
        </div>
    </template>
</div>
