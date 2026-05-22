<?php

namespace Database\Seeders;

use App\Models\Ministry;
use App\Models\ScriptureOfWeek;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'pastor']);
        Role::create(['name' => 'editor']);

        // Admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@ndpcc.org',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('super_admin');

        // Site Settings
        $settings = [
            'contact_address' => 'Arusha, Tanzania',
            'contact_phone' => '+255 XXX XXX XXX',
            'contact_whatsapp' => '+255XXXXXXXXX',
            'contact_email' => 'info@ndpcc.org',
            'service_times' => "Sunday: 9:00 AM & 11:00 AM\nWednesday: 6:00 PM\nFriday: 5:30 PM",
            'mpesa_number' => 'XXXXXXX',
            'bank_name' => 'CRDB Bank',
            'account_name' => 'NDPCC',
            'account_number' => 'XXXXXXXXXXXX',
            'show_mpesa' => 'true',
            'show_bank' => 'true',
            'radio_stream_url' => '',
            'radio_is_live' => 'false',
            'radio_current_program' => '',
            // YouTube Integration
            'youtube_channel_id' => 'UC_nLmSKUvvSW4JyENg444gA',
            'youtube_channel_handle' => '@ApostleMathayonnko',
            'youtube_channel_url' => 'https://www.youtube.com/@ApostleMathayonnko',
            'youtube_api_key' => '',
            'youtube_auto_import' => '1',
            'youtube_live_video_id' => '',
            'youtube_is_live' => '0',
            'youtube_rss_url' => 'https://www.youtube.com/feeds/videos.xml?channel_id=UC_nLmSKUvvSW4JyENg444gA',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        // Scripture of the Week
        ScriptureOfWeek::create([
            'verse_en' => 'I am not ashamed of the Gospel, for it is the power of God unto salvation for everyone who believes.',
            'verse_sw' => 'Siionei haya Injili kwa maana ni uwezo wa Mungu uletao wokovu kwa kila aaminiye.',
            'reference' => 'Romans 1:16 / Warumi 1:16',
            'is_active' => true,
        ]);

        // Ministries
        $ministries = [
            ['name_en' => 'Youth Ministry', 'name_sw' => 'Vijana', 'description_en' => 'Empowering young people to grow in faith and purpose.', 'description_sw' => 'Kuwawezesha vijana kukua katika imani na kusudi.', 'sort_order' => 1],
            ['name_en' => "Women's Ministry", 'name_sw' => 'Wanawake', 'description_en' => 'Building strong women of faith through fellowship and the Word.', 'description_sw' => 'Kujenga wanawake imara wa imani kupitia ushirika na Neno.', 'sort_order' => 2],
            ['name_en' => "Men's Ministry", 'name_sw' => 'Wanaume', 'description_en' => 'Equipping men to lead with integrity and godliness.', 'description_sw' => 'Kuwaandaa wanaume kuongoza kwa uadilifu na utauwa.', 'sort_order' => 3],
            ['name_en' => "Children's Ministry", 'name_sw' => 'Watoto', 'description_en' => 'Nurturing children in the knowledge and love of God.', 'description_sw' => 'Kulea watoto katika maarifa na upendo wa Mungu.', 'sort_order' => 4],
            ['name_en' => 'Praise & Worship', 'name_sw' => 'Sifa na Ibada', 'description_en' => 'Leading the congregation in worship and praise to God.', 'description_sw' => 'Kuongoza kanisa katika ibada na sifa kwa Mungu.', 'sort_order' => 5],
            ['name_en' => 'Evangelism Team', 'name_sw' => 'Uinjilisti', 'description_en' => 'Reaching communities with the life-transforming Gospel.', 'description_sw' => 'Kufikia jamii na injili inayobadilisha maisha.', 'sort_order' => 6],
        ];

        foreach ($ministries as $ministry) {
            Ministry::create(array_merge($ministry, ['is_active' => true]));
        }
    }
}
