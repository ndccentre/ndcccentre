<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogTranslationSeeder extends Seeder
{
    public function run(): void
    {
        BlogPost::where('slug', 'the-power-of-faith-in-difficult-times')->update([
            'title_sw' => 'Nguvu ya Imani Wakati wa Magumu: Jinsi Mungu Anavyowategemeza Watu Wake',
            'excerpt_sw' => 'Katika nyakati za majaribu, imani yetu inajaribiwa na kusafishwa. Mtume Mathayo Nnko anashiriki jinsi waumini wanavyoweza kusimama imara wakati dhoruba zinapokuja, wakipata nguvu kutoka katika ahadi za Mungu zisizobadilika.',
            'body_sw' => '<h2>Wakati Dhoruba Zinakuja, Imani Inasimama</h2>
<p>Maisha yanaleta nyakati zinazojaribu kila kitu tunachoamini. Ugumu wa kifedha, changamoto za kiafya, matatizo ya familia — hizi ni tanuru ambapo imani inatengenezwa au kusahaulika. Lakini Neno la Mungu linatukumbusha: <em>"Sitakuacha wala sitakupuuza"</em> (Waebrania 13:5).</p>

<h2>Nguzo Tatu za Imani Isiyotikisika</h2>
<p><strong>1. Neno la Mungu</strong> — Biblia yako si kitabu tu; ni sauti hai ya Mungu inayozungumza moja kwa moja katika hali yako. Daudi alipomkabili Goliathi, hakutegemea silaha — alitegemea jina la Bwana.</p>

<p><strong>2. Sala Bila Kukoma</strong> — Sala si njia ya mwisho; ni jibu letu la kwanza. Kanisa la kwanza liliomba, na milango ya gereza ikafunguka. Tunapoomba, mbingu inasogea kwa niaba yetu.</p>

<p><strong>3. Jumuiya ya Waumini</strong> — Hukuumbwa kutembea peke yako. Mwili wa Kristo upo ili wakati mwanachama mmoja ni dhaifu, wengine wabebe mzigo. Ndiyo maana tunakusanyika kila Jumapili — kuimarishana.</p>

<h2>Neno Kwako Leo</h2>
<p>Chochote unachokabiliana nacho sasa hivi, jua hili: Mungu hajashangaa na hali yako. Aliiona kabla ya msingi wa ulimwengu, na tayari ameandaa njia yako kupitia hiyo. Kazi yako ni kuamini, kuomba, na kuendelea kutembea mbele.</p>

<blockquote>"Mwenyezi Mungu akamuambia Musa; Sasa ninafanya agano na watu wako, Nitatenda maajabu mbele yao ambayo hayajapata kutendwa duniani kote" — Kutoka 34:10</blockquote>

<p>Njoo uabudu nasi Jumapili hii. Imani na iinuke moyoni mwako tunapomtafuta Mungu pamoja.</p>',
        ]);

        BlogPost::where('slug', 'ndpcc-foundation-transforms-lives-in-arusha')->update([
            'title_sw' => 'Jinsi Foundation ya NDPCC Inavyobadilisha Maisha Arusha: Familia 500 na Zaidi',
            'excerpt_sw' => 'Kupitia Foundation ya Gibea ya Mungu Nayoth, familia zaidi ya 500 Arusha zimepata msaada ikiwa ni pamoja na ufadhili wa elimu, msaada wa chakula, na programu za maendeleo ya jamii.',
            'body_sw' => '<h2>Urithi wa Huruma</h2>
<p>Tangu kuanzishwa kwake, Foundation ya Gibea ya Mungu Nayoth imekuwa taa ya tumaini Arusha, Tanzania. Kilichoanza kama mpango mdogo wa kusaidia wajane na yatima kimekua kuwa programu kamili ya maendeleo ya jamii inayogusa mamia ya maisha.</p>

<h2>Athari kwa Nambari</h2>
<ul>
<li><strong>Familia 500+</strong> zimesaidiwa kwa chakula, mavazi, na mahitaji muhimu</li>
<li><strong>Watoto 200+</strong> wamefadhiliwa shuleni — kutoka elimu ya msingi hadi sekondari</li>
<li><strong>Wajane 80+</strong> wanapokea msaada wa kila mwezi na msaada wa kiroho</li>
<li><strong>Miaka 17</strong> ya huduma endelevu kwa jamii</li>
</ul>

<h2>Elimu: Kuvunja Mzunguko</h2>
<p>Elimu ni chombo chenye nguvu zaidi cha kuvunja mzunguko wa umaskini. Kupitia programu yetu ya ufadhili wa shule, watoto ambao vinginevyo wasingeweza kuhudhuria shule sasa wanafanikiwa katika madarasa kote Arusha. Tunatoa sare, vitabu, ada za shule, na milo.</p>

<h2>Jinsi Unavyoweza Kusaidia</h2>
<p>Kila mchango unaleta tofauti. Iwe ni sadaka ya mara moja au msaada wa kila mwezi, ukarimu wako unaathiri moja kwa moja familia yenye uhitaji.</p>

<p><strong>Airtel Money:</strong> +255 784 363 502<br>
<strong>Lipa Namba:</strong> 58268290<br>
<strong>NMB Bank:</strong> 40810146696</p>

<p>Pamoja, tunaweza kuendelea kuwa mikono na miguu ya Kristo katika jamii yetu. Kama andiko linavyosema: <em>"Dini safi na isiyo na uchafu mbele ya Mungu ni hii: kuwatazama yatima na wajane katika dhiki yao"</em> (Yakobo 1:27).</p>',
        ]);

        $this->command->info('Blog posts translated to Swahili.');
    }
}
