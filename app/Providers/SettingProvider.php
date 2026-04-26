<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class SettingProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        try {
            $setting = Setting::firstOrCreate(
                ['id'=>1], 
                [
                    'site_name'  => 'news',
                    'logo'       => 'uploads/setting/logo/4eb066b0-014b-4d6a-bee1-ecd091262e6b1777215471.png',
                    'favicon'    => 'uploads/setting/favicon/f45c2d8e-f4aa-4b1a-a4b0-ed18331600651777215607.png',
                    'email'      => 'news@gmail.com',
                    'facebook'   => 'https://www.facebook.com/',
                    'tiwter'    => 'https://x.com/',     
                    'instgram'  => 'https://www.instagram.com/', 
                    'youtube'    => 'https://www.youtube.com/',
                    'phone'      => '01028673838',
                    'country'    => 'Egypt',
                    'city'       => 'Mansoura',
                    'SmallDesc' => 'Small description for SEO optimization.', 
                    'street'     => 'Belqas',
                    'contact'    => "We'd love to hear from you! Whether you have a question about our services, news suggestions, or anything else, our team is ready to help you.\n\nFeel free to reach out and we'll get back to you as soon as possible.",
                ]
            );

            $phone = preg_replace('/^0/', '20', $setting->phone);
            $setting->whatsapp = 'https://wa.me/' . $phone;

            view()->share(['setting' => $setting]);

        } catch (\Exception $e) {
            logger()->error('SettingProvider failed: ' . $e->getMessage());
        }
    }
}