<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [

                // About us
                'en' => [
                    'name' => 'About us',
                    'content' => '<h2>Trusted Cab Services in All World</h2>

                    <p>Curabitur placerat cursus nisi nec pharetra. Proin quis tortor fringilla, placerat nisi nec, auctor ex. Donec commodo orci ac lectus mattis, sed interdum sem scelerisque. Vivamus at euismod magna. Aenean semper risus nec dolor bibendum cursus. Donec eu odio eu ligula sagittis fringilla. Phasellus vulputate velit eu vehicula auctor. Nam vel pellentesque libero. Duis eget efficitur dui. Mauris tempor ex non tortor aliquet, et interdum mi dapibus. Phasellus ac dui nunc. Sed quis sagittis lorem, in blandit nibh. Fusce dui metus, interdum ac malesuada eu, ornare nec neque. Fusce hendrerit, tortor id egestas rutrum, orci lorem lacinia velit, sed mollis augue diam eget ipsum. Curabitur euismod, tellus sit amet tincidunt semper, dui odio pharetra orci, sed molestie odio libero sed libero. Sed volutpat ornare mauris. Sed gravida pulvinar urna, eget euismod mi mattis a. Vivamus sagittis eu quam sed ullamcorper. Etiam aliquet ornare tempus. Maecenas dictum nunc ac tortor rutrum, quis sollicitudin libero feugiat. Mauris iaculis sed risus ut tempus.</p>',
                ],
                'ar' => [
                    'name' => 'About us',
                    'content' => '<h2>Trusted Cab Services in All World</h2>

                    <p>Curabitur placerat cursus nisi nec pharetra. Proin quis tortor fringilla, placerat nisi nec, auctor ex. Donec commodo orci ac lectus mattis, sed interdum sem scelerisque. Vivamus at euismod magna. Aenean semper risus nec dolor bibendum cursus. Donec eu odio eu ligula sagittis fringilla. Phasellus vulputate velit eu vehicula auctor. Nam vel pellentesque libero. Duis eget efficitur dui. Mauris tempor ex non tortor aliquet, et interdum mi dapibus. Phasellus ac dui nunc. Sed quis sagittis lorem, in blandit nibh. Fusce dui metus, interdum ac malesuada eu, ornare nec neque. Fusce hendrerit, tortor id egestas rutrum, orci lorem lacinia velit, sed mollis augue diam eget ipsum. Curabitur euismod, tellus sit amet tincidunt semper, dui odio pharetra orci, sed molestie odio libero sed libero. Sed volutpat ornare mauris. Sed gravida pulvinar urna, eget euismod mi mattis a. Vivamus sagittis eu quam sed ullamcorper. Etiam aliquet ornare tempus. Maecenas dictum nunc ac tortor rutrum, quis sollicitudin libero feugiat. Mauris iaculis sed risus ut tempus.</p>',
                ],
            ],

        ];


        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
