<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Setting;

class ButtonColorSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default button color settings
        Setting::updateOrCreate(
            ['key' => 'primary_button_color'],
            [
                'value' => '#2563eb',
                'group' => 'appearance'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'primary_button_hover_color'],
            [
                'value' => '#1d4ed8',
                'group' => 'appearance'
            ]
        );

        // Primary gradient button colors
        Setting::updateOrCreate(
            ['key' => 'primary_gradient_from'],
            [
                'value' => '#2563eb', // blue-600
                'group' => 'appearance'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'primary_gradient_to'],
            [
                'value' => '#4f46e5', // indigo-700
                'group' => 'appearance'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'primary_gradient_hover_from'],
            [
                'value' => '#1d4ed8', // blue-700
                'group' => 'appearance'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'primary_gradient_hover_to'],
            [
                'value' => '#3730a3', // indigo-800
                'group' => 'appearance'
            ]
        );

        // Secondary gradient button colors
        Setting::updateOrCreate(
            ['key' => 'secondary_gradient_from'],
            [
                'value' => '#14b8a6', // teal-500
                'group' => 'appearance'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'secondary_gradient_to'],
            [
                'value' => '#0891b2', // cyan-600
                'group' => 'appearance'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'secondary_gradient_hover_from'],
            [
                'value' => '#0f766e', // teal-600
                'group' => 'appearance'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'secondary_gradient_hover_to'],
            [
                'value' => '#075985', // cyan-700
                'group' => 'appearance'
            ]
        );

        // Icon color setting
        Setting::updateOrCreate(
            ['key' => 'icon_color_primary'],
            [
                'value' => '#2563eb', // blue-600
                'group' => 'appearance'
            ]
        );
    }
}
