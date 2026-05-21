<x-filament-panels::page>
    {{-- Channel Status Card --}}
    <x-filament::section>
        <x-slot name="heading">Channel Status</x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div>
                    <span class="text-sm font-medium text-gray-500">Channel:</span>
                    <span class="ml-2 font-semibold">Apostle Mathayo Nnko ({{ $this->getChannelHandle() }})</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Channel ID:</span>
                    <code class="ml-2 text-xs bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">{{ $this->getChannelId() }}</code>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Mode:</span>
                    @if($this->getMode() === 'api')
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            API Mode — Full Features
                        </span>
                    @else
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200">
                            RSS Mode
                        </span>
                    @endif
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Last Import:</span>
                    <span class="ml-2">{{ $this->getLastImport() }}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Videos in Library:</span>
                    <span class="ml-2 font-semibold">{{ $this->getVideoCount() }}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Live Status:</span>
                    @if($this->getIsLive())
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                            ● LIVE
                        </span>
                    @else
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                            OFF AIR
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex flex-col gap-3 justify-center">
                <x-filament::button wire:click="importVideos" icon="heroicon-o-arrow-down-tray">
                    Import Videos Now
                </x-filament::button>
                <x-filament::button wire:click="checkLive" color="gray" icon="heroicon-o-signal">
                    Check Live Status
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>

    {{-- Settings Form --}}
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Save Settings
            </x-filament::button>
        </div>
    </form>

    {{-- API Key Instructions --}}
    <x-filament::section collapsible collapsed>
        <x-slot name="heading">How to Get a YouTube API Key</x-slot>

        <ol class="list-decimal list-inside space-y-2 text-sm text-gray-600 dark:text-gray-400">
            <li>Go to <a href="https://console.cloud.google.com" target="_blank" class="text-primary-600 underline">console.cloud.google.com</a></li>
            <li>Create or select a project</li>
            <li>Navigate to <strong>APIs & Services → Library</strong></li>
            <li>Search for <strong>"YouTube Data API v3"</strong> and click <strong>Enable</strong></li>
            <li>Go to <strong>APIs & Services → Credentials</strong></li>
            <li>Click <strong>Create Credentials → API Key</strong></li>
            <li>Copy the key and paste it in the field above</li>
            <li>Click <strong>Save Settings</strong></li>
        </ol>

        <div class="mt-4 p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg text-sm">
            <strong>Note:</strong> Without an API key, the system uses RSS mode which pulls the 15 most recent videos automatically. Adding an API key unlocks Shorts detection, view counts (up to 50 videos), and live stream auto-detection.
        </div>
    </x-filament::section>
</x-filament-panels::page>
