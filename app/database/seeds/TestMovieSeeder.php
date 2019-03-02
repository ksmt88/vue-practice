<?php

use Illuminate\Database\Seeder;

class TestMovieSeeder extends Seeder
{
    var $titleList = [
        'あいうえお',
        'かきくけこ',
        'さしすせそ',
        'たちつてと',
        'なにぬねの',
    ];

    var $descriptionList = [
        'アイウエオ、アイウエオ、アイウエオ、アイウエオ、アイウエオ、アイウエオ、アイウエオ、アイウエオ、アイウエオ、アイウエオ、アイウエオ、アイウエオ、',
        'カキクケコ、カキクケコ、カキクケコ、カキクケコ、カキクケコ、カキクケコ、カキクケコ、カキクケコ、カキクケコ、カキクケコ、カキクケコ、カキクケコ、',
        'サシスセソ、サシスセソ、サシスセソ、サシスセソ、サシスセソ、サシスセソ、サシスセソ、サシスセソ、サシスセソ、サシスセソ、サシスセソ、サシスセソ、',
        'タチツテト、タチツテト、タチツテト、タチツテト、タチツテト、タチツテト、タチツテト、タチツテト、タチツテト、タチツテト、タチツテト、タチツテト、',
        'ナニヌネノ、ナニヌネノ、ナニヌネノ、ナニヌネノ、ナニヌネノ、ナニヌネノ、ナニヌネノ、ナニヌネノ、ナニヌネノ、ナニヌネノ、ナニヌネノ、ナニヌネノ、',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 44; $i++) {
            $randNum = rand(0, 4);
            DB::table('movies')->insert([
                'title'         => $this->titleList[$randNum],
                'description'   => $this->descriptionList[$randNum],
                'time'          => '10:50',
                'category'      => 1,
                'url'           => 'https://www.youtube.com/embed/wn_dhNE1KTY',
                'thumbnail_url' => 'https://img.youtube.com/vi/wn_dhNE1KTY/mqdefault.jpg',
            ]);
        }
    }
}
