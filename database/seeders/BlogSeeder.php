<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        BlogPost::firstOrCreate(['slug' => 'the-power-of-faith-in-difficult-times'], [
            'title' => 'The Power of Faith in Difficult Times: How God Sustains His People',
            'category' => 'sermon-discussion',
            'excerpt' => 'In seasons of trial, our faith is tested and refined. Apostle Mathayo Nnko shares how believers can stand firm when storms arise, drawing strength from God\'s unchanging promises.',
            'body' => '<h2>When Storms Come, Faith Stands</h2>
<p>Life brings seasons that test everything we believe. Financial hardship, health challenges, family struggles — these are the furnaces where faith is either forged or forgotten. But God\'s Word reminds us: <em>"I will never leave you nor forsake you"</em> (Hebrews 13:5).</p>

<h2>Three Pillars of Unshakeable Faith</h2>
<p><strong>1. The Word of God</strong> — Your Bible is not just a book; it is the living voice of God speaking directly into your situation. When David faced Goliath, he didn\'t rely on armor — he relied on the name of the Lord.</p>

<p><strong>2. Prayer Without Ceasing</strong> — Prayer is not a last resort; it is our first response. The early church prayed, and prison doors opened. When we pray, heaven moves on our behalf.</p>

<p><strong>3. Community of Believers</strong> — You were never meant to walk alone. The body of Christ exists so that when one member is weak, others carry the load. This is why we gather every Sunday — to strengthen one another.</p>

<h2>A Word for You Today</h2>
<p>Whatever you are facing right now, know this: God is not surprised by your situation. He saw it before the foundation of the world, and He has already prepared your way through it. Your job is to trust, to pray, and to keep walking forward.</p>

<blockquote>"Mwenyezi Mungu akamuambia Musa; Sasa ninafanya agano na watu wako, Nitatenda maajabu mbele yao ambayo hayajapata kutendwa duniani kote" — Kutoka 34:10</blockquote>

<p>Come worship with us this Sunday. Let faith arise in your heart as we seek God together.</p>',
            'meta_title' => 'The Power of Faith in Difficult Times | NDPCC Blog',
            'meta_description' => 'Discover how faith sustains believers through trials. Apostle Mathayo Nnko shares biblical principles for standing firm in difficult seasons.',
            'user_id' => 1,
            'is_published' => true,
            'published_at' => now()->subDays(3),
        ]);

        BlogPost::firstOrCreate(['slug' => 'ndpcc-foundation-transforms-lives-in-arusha'], [
            'title' => 'How NDPCC Foundation is Transforming Lives in Arusha: 500 Families and Counting',
            'category' => 'foundation',
            'excerpt' => 'Through the Gibea of God Nayoth Foundation, over 500 families in Arusha have received support including education sponsorship, food assistance, and community development programs.',
            'body' => '<h2>A Legacy of Compassion</h2>
<p>Since its establishment, the Gibea of God Nayoth Foundation has been a beacon of hope in Arusha, Tanzania. What started as a small initiative to help widows and orphans has grown into a comprehensive community development program touching hundreds of lives.</p>

<h2>Impact by the Numbers</h2>
<ul>
<li><strong>500+ families</strong> supported with food, clothing, and essential needs</li>
<li><strong>200+ children</strong> sponsored through school — from primary to secondary education</li>
<li><strong>80+ widows</strong> receiving monthly assistance and spiritual support</li>
<li><strong>17 years</strong> of continuous service to the community</li>
</ul>

<h2>Education: Breaking the Cycle</h2>
<p>Education is the most powerful tool for breaking the cycle of poverty. Through our school sponsorship program, children who would otherwise be unable to attend school are now thriving in classrooms across Arusha. We provide uniforms, books, school fees, and meals.</p>

<h2>How You Can Help</h2>
<p>Every contribution makes a difference. Whether it\'s a one-time donation or monthly support, your generosity directly impacts a family in need.</p>

<p><strong>Airtel Money:</strong> +255 784 363 502<br>
<strong>Lipa Namba:</strong> 58268290<br>
<strong>NMB Bank:</strong> 40810146696</p>

<p>Together, we can continue to be the hands and feet of Christ in our community. As the scripture says: <em>"Pure religion and undefiled before God is this: to visit the fatherless and widows in their affliction"</em> (James 1:27).</p>',
            'meta_title' => 'NDPCC Foundation Transforms Lives in Arusha | 500+ Families Supported',
            'meta_description' => 'Learn how the Gibea of God Nayoth Foundation supports 500+ families, 200+ children, and 80+ widows in Arusha, Tanzania through education and community programs.',
            'user_id' => 1,
            'is_published' => true,
            'published_at' => now()->subDays(1),
        ]);

        $this->command->info('2 blog posts seeded.');
    }
}
