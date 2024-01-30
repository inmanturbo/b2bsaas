<?php
/**
 * @var \App\Models\Team $team
 */
 $team = \App\Models\Team::whereUuid(request()->route('team'))->firstOrFail();
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Team Settings') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if (Gate::check('updateTeamDatabase', $team ) && config('b2bsaas.features.create_team_databases'))
                @livewire('update-team-database-form', ['team' => $team])
                <x-section-border />
            @endif

            @livewire('teams.update-team-name-form', ['team' => $team])
            
            @if (config('b2bsaas.features.team_logos'))
                <x-section-border />
                @livewire('update-team-profile-info-form', ['team' => $team])
            @endif

            @if (config('b2bsaas.features.team_contact_info'))
                <x-section-border />
                @livewire('update-team-contact-info-form', ['team' => $team])
            @endif

            @if (config('b2bsaas.features.team_landing_page'))
                <x-section-border />
                @livewire('update-team-landing-page-form', ['team' => $team])
            @endif
            
            @livewire('teams.team-member-manager', ['team' => $team])

            @if (Gate::check('delete', $team) && ! $team->personal_team)
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('teams.delete-team-form', ['team' => $team])
                </div>
            @endif
            <x-section-border />

             @livewire('update-team-domain-form', ['team' => $team])
        </div>
    </div>
</x-app-layout>
