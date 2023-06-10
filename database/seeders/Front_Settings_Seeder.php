<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FrontSetting;

class Front_Settings_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
                [
                    'type' => 'Site Title',
                    'slug' => 'site-title',
                    'value' => ''
                ],
                [
                    'type' => 'Site Logo',
                    'slug' => 'site-logo',
                    'value' => ''
                ],
                [
                    'type' => 'Site Favicon',
                    'slug' => 'site-favicon',
                    'value' => ''
                ],
                [
                    'type' => 'Site Keyword',
                    'slug' => 'site-keyword',
                    'value' => ''
                ],
                [
                    'type' => 'Site Description',
                    'slug' => 'site-description',
                    'value' => ''
                ],
                [
                    'type' => 'Address1',
                    'slug' => 'address1',
                    'value' => ''
                ],
                [
                    'type' => 'Address2',
                    'slug' => 'address2',
                    'value' => ''
                ],
                [
                    'type' => 'City',
                    'slug' => 'city',
                    'value' => ''
                ],
                [
                    'type' => 'Phone Number',
                    'slug' => 'phone-number',
                    'value' => ''
                ],
                [
                    'type' => 'Email',
                    'slug' => 'email',
                    'value' => ''
                ],
                [
                    'type' => 'Footer Text',
                    'slug' => 'footer-text',
                    'value' => ''
                ],
                [
                    'type' => 'About Us',
                    'slug' => 'about-us',
                    'value' => ''
                ],
                [
                    'type' => 'Disclaimer',
                    'slug' => 'disclaimer',
                    'value' => ''
                ],
                [
                    'type' => 'Privacy Policy',
                    'slug' => 'privacy-policy',
                    'value' => ''
                ],
                [
                    'type' => 'Facebook Link',
                    'slug' => 'facebook-link',
                    'value' => ''
                ],
                [
                    'type' => 'Twitter Link',
                    'slug' => 'twitter-link',
                    'value' => ''
                ],
                [
                    'type' => 'Linked In Link',
                    'slug' => 'linked-in-link',
                    'value' => ''
                ],
                [
                    'type' => 'Github Link',
                    'slug' => 'github-link',
                    'value' => ''
                ],
                [
                    'type' => 'Header Verify Tag',
                    'slug' => 'header-verify-tag',
                    'value' => ''
                ],
                [
                    'type' => 'Skype Link',
                    'slug' => 'skype-link',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 1',
                    'slug' => 'ads-1',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 2',
                    'slug' => 'ads-2',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 3',
                    'slug' => 'ads-3',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 4',
                    'slug' => 'ads-4',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 5',
                    'slug' => 'ads-5',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 6',
                    'slug' => 'ads-6',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 7',
                    'slug' => 'ads-7',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 8',
                    'slug' => 'ads-8',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 9',
                    'slug' => 'ads-9',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 10',
                    'slug' => 'ads-10',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 11',
                    'slug' => 'ads-11',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 12',
                    'slug' => 'ads-12',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 13',
                    'slug' => 'ads-13',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 14',
                    'slug' => 'ads-14',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 15',
                    'slug' => 'ads-15',
                    'value' => ''
                ],
                [
                    'type' => 'Ads 16',
                    'slug' => 'ads-16',
                    'value' => ''
                ]
            ];

        foreach ($settings as $key => $value) {
            $find = FrontSetting::where('slug', $value['slug'])->first();
            if (is_null($find)) {
                FrontSetting::create($value);
            }
        }
    }
}
