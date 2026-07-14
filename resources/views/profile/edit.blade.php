<x-app-layout title="Profile - SIHATI BPPKAD">
<div class="mx-auto max-w-3xl space-y-6 py-6">
    <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-subtle md:p-8">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-subtle md:p-8">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
</x-app-layout>
