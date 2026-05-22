<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::updateOrCreate(
            ['title_en' => 'Sunday Service'],
            [
                'title_sw' => 'Ibada ya Jumapili',
                'description_en' => 'Join us for our weekly Sunday Service. Worship, Word, and Fellowship. Live on YouTube.',
                'description_sw' => 'Jiunge nasi kwa Ibada yetu ya Jumapili. Ibada, Neno, na Ushirika. Moja kwa moja YouTube.',
                'starts_at' => '2026-05-25 09:00:00',
                'ends_at' => '2026-05-25 12:00:00',
                'location' => 'NDPCC Arusha & YouTube Live',
                'is_published' => true,
            ]
        );

        // Update contact info
        SiteSetting::set('contact_email', 'info@ndpccenter.co.tz');
        SiteSetting::set('contact_address', 'Arusha, Tanzania');
        SiteSetting::set('contact_phone', '+255 784 363 502');
        SiteSetting::set('contact_whatsapp', '+255784363502');

        // Social media
        SiteSetting::set('social_youtube', 'https://www.youtube.com/@ApostleMathayonnko');
        SiteSetting::set('social_facebook', 'https://www.facebook.com/NayothMinistry');
        SiteSetting::set('social_instagram', 'https://www.instagram.com/apostlemathayonnko');
        SiteSetting::set('social_instagram_church', 'https://www.instagram.com/nayothministry');
        SiteSetting::set('social_tiktok', 'https://www.tiktok.com/@apostlemathayonnko');

        $this->command->info('Event and settings seeded.');
    }
}
