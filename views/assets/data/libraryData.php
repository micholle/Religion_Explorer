<?php

class libraryData {

    public function getBasicInfo() {
        $libraryBasicInfo = [
            "Buddhism" => [
                "borderLeftImg" => "",
                "borderRightImg" => "",
                "religionDesc" => "",
                "sacredScripture" => "",
                "sacredScriptureImg" => "",
                "sacredScriptureDesc" => "",
                "placeOfWorship" => "",
                "placeOfWorshipImg" => "",
                "placeOfWorshipDesc" => "",
                "sacredSymbol" => "",
                "sacredSymbolImg" => "",
                "sacredSymbolDesc"=> ""
            ],
            "Christianity" => [
                "borderLeftImg" => "",
                "borderRightImg" => "",
                "religionDesc" => "",
                "sacredScripture" => "",
                "sacredScriptureImg" => "",
                "sacredScriptureDesc" => "",
                "placeOfWorship" => "",
                "placeOfWorshipImg" => "",
                "placeOfWorshipDesc" => "",
                "sacredSymbol" => "",
                "sacredSymbolImg" => "",
                "sacredSymbolDesc"=> ""
            ],
            "Hinduism" => [
                "borderLeftImg" => "",
                "borderRightImg" => "",
                "religionDesc" => "",
                "sacredScripture" => "",
                "sacredScriptureImg" => "",
                "sacredScriptureDesc" => "",
                "placeOfWorship" => "",
                "placeOfWorshipImg" => "",
                "placeOfWorshipDesc" => "",
                "sacredSymbol" => "",
                "sacredSymbolImg" => "",
                "sacredSymbolDesc"=> ""
            ],
            "Islam" => [
                "borderLeftImg" => "",
                "borderRightImg" => "",
                "religionDesc" => "",
                "sacredScripture" => "",
                "sacredScriptureImg" => "",
                "sacredScriptureDesc" => "",
                "placeOfWorship" => "",
                "placeOfWorshipImg" => "",
                "placeOfWorshipDesc" => "",
                "sacredSymbol" => "",
                "sacredSymbolImg" => "",
                "sacredSymbolDesc"=> ""
            ],
            "Judaism" => [
                "borderLeftImg" => "../assets/img/judaism-border-left.png",
                "borderRightImg" => "../assets/img/judaism-border-left.png",
                "religionDesc" => "Judaism is the world's oldest monotheistic religion, dating back nearly 4,000 years. Followers of Judaism believe in one God who revealed himself through ancient prophets. Judaism is the complex phenomenon of a total way of life for the Jewish people, comprising theology, law, and innumerable cultural traditions.",
                "sacredScripture" => "The Tanakh",
                "sacredScriptureImg" => "../assets/img/tanakh.png",
                "sacredScriptureDesc" => "The Hebrew Bible comprising of the Torah, Nevi'im, and Ketuvim.",
                "placeOfWorship" => "The Synagogue",
                "placeOfWorshipImg" => "../assets/img/synagogue.png",
                "placeOfWorshipDesc" => "The Jewish place for gathering, prayer, and community engagement.",
                "sacredSymbol" => "The Menorah",
                "sacredSymbolImg" => "../assets/img/menorah.png",
                "sacredSymbolDesc"=> "A multi-branched candelabra, used in the religious rituals of Judaism."
            ]
        ];

        return $libraryBasicInfo;
    }

    public function getResources() {

        $libraryResources = [
            "photos" => [
                "Ceiling Frescoes" => [
                    "file" => "../assets/data/img/library/Ceiling_Frescoes.png",
                    "religion" => "Christianity",
                    "category" => ["Historical Context"],
                    "description" => "This monumental fresco portrays various episodes from the life of St. Charles Borromeo and the triumph of the Catholic Church. It showcases the glory of the Baroque era and the spiritual power of the Catholic faith.",
                    "author" => "Johann Michael Rottmayr"
                ],
                "Gautama Buddha" => [
                    "file" => "../assets/data/img/library/Gautama_Buddha.png",
                    "religion" => "Buddhism",
                    "category" => ["Religious Practices"],
                    "description" => "Gautama Buddha, also known as Siddhartha Gautama, was a spiritual leader and the founder of Buddhism. His teachings and philosophy have had a profound and lasting impact on millions of people around the world.",
                    "author" => "Jose Luis Sanchez"
                ],  
                // "Photo 3" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ],    
                // "Photo 4" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ],    
                // "Photo 5" => [
                //     "file" => "",
                    // "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ]  
            ],
            "videos" => [
                "Mosque" => [
                    "file" => "../assets/data/vid/library/Mosque.mp4",
                    "religion" => "Islam",
                    "category" => ["Religious Practices"],
                    "description" => "",
                    "author" => "Ali Karim"
                ],
                "Hindu Event" => [
                    "file" => "../assets/data/vid/library/Hindu_Event.mp4",
                    "religion" => "Hinduism",
                    "category" => ["Religious Practices"],
                    "description" => "",
                    "author" => "Abhilash Bahirat"
                ],  
                // "Video 3" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ],    
                // "Video 4" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ],    
                // "Video 5" => [
                //     "file" => "",
                //     "religion" => "",
                //     "category" => ["", ""],
                //     "description" => "",
                //     "author" => ""
                // ]  
            ],
            "readingMats" => [
                "Being Christian in Western Europe" => [
                    "type" => "article",
                    "author" => "Pew Research Center - 2018",
                    "religion" => "Christianity",
                    "category" => ["Social Issues"],
                    "description" => "The majority of Europe&#8217;s Christians are non-practicing, but they differ from religiously unaffiliated people in their views on God, attitudes toward Muslims and immigrants, and opinions about religion&#8217;s role in society."
                ],
                "What it means to be a Christian in America" => [
                    "type" => "article",
                    "author" => "M. Bowman - 2018",
                    "religion" => "Christianity",
                    "category" => ["Social Issues"],
                    "description" => "From the very beginning of European settlement in the United States, a wide range of Christian faiths appeared in America. Roman Catholics, Baptists and Methodists saw their numbers rise in the early 19th century."
                ],  
                "African Christianity: Its public role" => [
                    "type" => "book",
                    "author" => "P. Gifford - 1998",
                    "religion" => "Christianity",
                    "category" => ["Social Issues", "Historical Context"],
                    "description" => "Examines African Christianity in the mid-1990s against the back ground of the continent's current social, economic, and political circumstances. Gifford sheds light on the dynamics of African churches and churchgoers."
                ],    
                "A History of Christianity in India: 1707&#8212;1858" => [
                    "type" => "book",
                    "author" => "S. Neil - 1984",
                    "religion" => "Christianity",
                    "category" => ["Historical Context"],
                    "description" => "Christians form the third largest religious community in India. How has this come about? There are many studies of separate groups: but there has so far been no major history of the three large groups."
                ],    
                // "Blog 5" => [
                //     "type" => "",
                //     "author" => "",
                //     "religion" => "",
                //     "category" => [""],
                //     "description" => ""
                // ]
            ]
        ];

        return $libraryResources;

    }

}

?>