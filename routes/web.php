<?php

use App\Http\Controllers\PageController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

// Redirect root to default locale
Route::redirect('/', '/en');

// Language switch
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'sw'])) {
        session(['locale' => $locale]);
    }
    $path = url()->previous();
    // Replace locale segment in previous URL
    $path = preg_replace('#/(en|sw)(/|$)#', "/{$locale}$2", $path);
    return redirect($path ?: "/{$locale}");
})->name('lang.switch');

// Localized routes
Route::prefix('{locale}')
    ->where(['locale' => 'en|sw'])
    ->middleware(SetLocale::class)
    ->group(function () {

        Route::get('/', [PageController::class, 'home'])->name('home');
        Route::get('/about', [PageController::class, 'about'])->name('about');
        Route::get('/sermons', [PageController::class, 'sermons'])->name('sermons');
        Route::get('/radio', [PageController::class, 'radio'])->name('radio');
        Route::get('/events', [PageController::class, 'events'])->name('events');
        Route::get('/ministries', [PageController::class, 'ministries'])->name('ministries');
        Route::get('/foundation', [PageController::class, 'foundation'])->name('foundation');
        Route::get('/give', [PageController::class, 'give'])->name('give');
        Route::get('/prayer', [PageController::class, 'prayer'])->name('prayer');
        Route::post('/prayer', [PageController::class, 'prayerStore'])->name('prayer.store');
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
        Route::get('/blog', [PageController::class, 'blog'])->name('blog');
        Route::get('/blog/{slug}', [PageController::class, 'blogPost'])->name('blog.show');
        Route::post('/blog/{slug}/comment', [PageController::class, 'blogComment'])->name('blog.comment');

    });

// Subscribe / Unsubscribe (no locale prefix needed)
Route::post('/subscribe', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email', 'name' => 'nullable|string|max:255']);
    \App\Models\Subscriber::firstOrCreate(
        ['email' => $request->email],
        ['name' => $request->name, 'is_active' => true, 'verified_at' => now()]
    );
    return back()->with('subscribed', true);
})->name('subscribe');

Route::get('/unsubscribe/{token}', function (string $token) {
    $subscriber = \App\Models\Subscriber::where('token', $token)->first();
    if ($subscriber) {
        $subscriber->update(['is_active' => false]);
    }
    return redirect('/en')->with('unsubscribed', true);
})->name('unsubscribe');

// Watermarked image download
Route::get('/download/image/{id}', function (int $id) {
    $item = \App\Models\GalleryItem::findOrFail($id);
    $path = storage_path('app/public/' . $item->image_path);

    if (!file_exists($path)) {
        abort(404, 'Image not found');
    }

    $title = $item->title ?: 'NDPCC';
    $filename = \Illuminate\Support\Str::slug($title) . '.jpg';

    try {
        $info = @getimagesize($path);
        if (!$info) {
            return response()->download($path, $filename);
        }

        $mime = $info['mime'];
        $image = null;

        if ($mime === 'image/png') {
            $image = @imagecreatefrompng($path);
        } elseif ($mime === 'image/webp' && function_exists('imagecreatefromwebp')) {
            $image = @imagecreatefromwebp($path);
        } else {
            $image = @imagecreatefromjpeg($path);
        }

        if (!$image) {
            return response()->download($path, $filename);
        }

        $width = imagesx($image);
        $height = imagesy($image);

        // Logo watermark top-right
        $logoPath = public_path('images/ndpcc-logo.png');
        if (file_exists($logoPath)) {
            $logo = @imagecreatefrompng($logoPath);
            if ($logo) {
                $logoW = imagesx($logo);
                $logoH = imagesy($logo);
                $newLogoW = max(40, (int) ($width * 0.1));
                $newLogoH = (int) ($logoH * ($newLogoW / $logoW));
                $scaledLogo = @imagescale($logo, $newLogoW, $newLogoH);
                if ($scaledLogo) {
                    $pad = max(10, (int) ($width * 0.02));
                    imagecopy($image, $scaledLogo, $width - $newLogoW - $pad, $pad, 0, 0, $newLogoW, $newLogoH);
                    imagedestroy($scaledLogo);
                }
                imagedestroy($logo);
            }
        }

        // Bottom bar
        $barH = max(44, (int) ($height * 0.07));
        $barColor = imagecolorallocate($image, 15, 10, 30);
        imagefilledrectangle($image, 0, $height - $barH, $width, $height, $barColor);

        $gold = imagecolorallocate($image, 217, 119, 6);
        $white = imagecolorallocate($image, 255, 255, 255);
        $tx = max(10, (int) ($width * 0.02));
        imagestring($image, 5, $tx, $height - $barH + 8, $title, $gold);
        imagestring($image, 3, $tx, $height - $barH + 26, 'NDPCC | ndpccenter.co.tz', $white);

        // Save to temp
        $tmp = tempnam(sys_get_temp_dir(), 'ndpcc');
        imagejpeg($image, $tmp, 90);
        imagedestroy($image);

        return response()->download($tmp, $filename, ['Content-Type' => 'image/jpeg'])->deleteFileAfterSend(true);
    } catch (\Throwable $e) {
        return response()->download($path, $filename);
    }
})->name('download.image');
