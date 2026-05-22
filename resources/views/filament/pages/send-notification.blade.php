<x-filament-panels::page>
    <form wire:submit="send">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit" color="primary" icon="heroicon-o-paper-airplane">
                Send to All Subscribers
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
