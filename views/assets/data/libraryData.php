<?php

class libraryData {

    public function getBasicInfo() {
        $libraryBasicInfo = [
            "Buddhism" => [
                "borderLeftImg" => "../assets/img/buddhism-border-left.png",
                "borderRightImg" => "../assets/img/buddhism-border-right.png",
                "religionDesc" => "Buddhism is based on the principles of the Four Noble Truths, which acknowledge the existence of suffering, its causes, and path to liberation. Buddhists follow the Eightfold Path, a set of guidelines for ethical living and meditation practices, with the ultimate goal of attaining enlightenment and ending the cycle of rebirth.",
                "sacredScripture" => "The Tripitaka",
                "sacredScriptureImg" => "../assets/img/tripitaka.png",
                "sacredScriptureDesc" => "The Tripitaka comprises the Vinaya, Sutta, and Abhidhamma.",
                "placeOfWorship" => "The Temple",
                "placeOfWorshipImg" => "../assets/img/temple.png",
                "placeOfWorshipDesc" => "The Buddhist temple is where believers in meditate, pray, and perform rituals.",
                "sacredSymbol" => "The Dharma Wheel",
                "sacredSymbolImg" => "../assets/img/lib-buddhism.png",
                "sacredSymbolDesc"=> "The Dharma Wheel (Dharmachakra), represents the path to enlightenment."
            ],
            "Christianity" => [
                "borderLeftImg" => "../assets/img/christianity-border-left.png",
                "borderRightImg" => "../assets/img/christianity-border-right.png",
                "religionDesc" => "Christianity is a monotheistic religion based on the life, teachings, death, and resurrection of Jesus Christ. It is centered around the belief in Jesus as the Son of God and the savior of humanity. Christians strive to live a life of faith, love, and service guided by the principles of Christ's teachings.",
                "sacredScripture" => "The Bible",
                "sacredScriptureImg" => "../assets/img/bible.png",
                "sacredScriptureDesc" => "The Bible comprises the Old Testament and the New Testament.",
                "placeOfWorship" => "The Church",
                "placeOfWorshipImg" => "../assets/img/church.png",
                "placeOfWorshipDesc" => "The Christian Church is for worship, fellowship, and the practice of faith.",
                "sacredSymbol" => "The Crucifix",
                "sacredSymbolImg" => "../assets/img/crucifix.png",
                "sacredSymbolDesc"=> "The Crucifix is a symbol of the crucifixion of Jesus Christ."
            ],
            "Hinduism" => [
                "borderLeftImg" => "../assets/img/hinduism-border-left.png",
                "borderRightImg" => "../assets/img/hinduism-border-right.png",
                "religionDesc" => "Hinduism encompasses a wide range of beliefs, rituals, and practices, with a focus on dharma (righteous living), karma (action and consequence), and moksha (liberation from the cycle of rebirth). It recognizes multiple deities, but also emphasizes the ultimate reality of Brahman, the divine essence that pervades all existence.",
                "sacredScripture" => "The Veda",
                "sacredScriptureImg" => "../assets/img/veda.png",
                "sacredScriptureDesc" => "The Vedas show Hinduism religious and philosophical traditions.",
                "placeOfWorship" => "The Mandir",
                "placeOfWorshipImg" => "../assets/img/mandir.png",
                "placeOfWorshipDesc" => "The Mandir is the sacred temple for worship and spiritual connection.",
                "sacredSymbol" => "The Om",
                "sacredSymbolImg" => "../assets/img/lib-hinduism.png",
                "sacredSymbolDesc"=> "The Om is a sacred symbol and mantra representing the divine essence."
            ],
            "Islam" => [
                "borderLeftImg" => "../assets/img/islam-lantern-left.png",
                "borderRightImg" => "../assets/img/islam-lantern-right.png",
                "religionDesc" => "Islam is a monotheistic religion founded in the 7th century CE by the Prophet Muhammad. Its followers are known as Muslims. The Five Pillars of Islam—declaration of faith, prayer, fasting, giving to charity, and pilgrimage to Mecca—form the core principles and practices of the faith.",
                "sacredScripture" => "The Quran",
                "sacredScriptureImg" => "../assets/img/quran.png",
                "sacredScriptureDesc" => "The Quran is the word of God as revealed to the Prophet Muhammad.",
                "placeOfWorship" => "The Mosque",
                "placeOfWorshipImg" => "../assets/img/mosque.png",
                "placeOfWorshipDesc" => "The Mosque is a place of worship for Muslims, where they gather for worship.",
                "sacredSymbol" => "Star and Crescent",
                "sacredSymbolImg" => "../assets/img/lib-islam.png",
                "sacredSymbolDesc"=> "Star and Crescent symbolize the Five Pillars and the creator's greatness."
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
                    "resourceid" => "rm1",
                    "type" => "article",
                    "author" => "Pew Research Center - 2018",
                    "religion" => "Christianity",
                    "category" => ["Social Issues"],
                    "description" => "The majority of Europe's Christians are non-practicing, but they differ from religiously unaffiliated people in their views on God, attitudes toward Muslims and immigrants, and opinions about religion's role in society."
                ],
                "What it means to be a Christian in America" => [
                    "resourceid" => "rm2",
                    "type" => "article",
                    "author" => "M. Bowman - 2018",
                    "religion" => "Christianity",
                    "category" => ["Social Issues"],
                    "description" => "From the very beginning of European settlement in the United States, a wide range of Christian faiths appeared in America. Roman Catholics, Baptists and Methodists saw their numbers rise in the early 19th century."
                ],  
                "African Christianity: Its public role" => [
                    "resourceid" => "rm3",
                    "type" => "book",
                    "author" => "P. Gifford - 1998",
                    "religion" => "Christianity",
                    "category" => ["Social Issues", "Historical Context"],
                    "description" => "Examines African Christianity in the mid-1990s against the back ground of the continent's current social, economic, and political circumstances. Gifford sheds light on the dynamics of African churches and churchgoers."
                ],    
                "A History of Christianity in India: 1707 - 1858" => [
                    "resourceid" => "rm4",
                    "type" => "book",
                    "author" => "S. Neil - 1984",
                    "religion" => "Christianity",
                    "category" => ["Historical Context"],
                    "description" => "Christians form the third largest religious community in India. How has this come about? There are many studies of separate groups: but there has so far been no major history of the three large groups."
                ],  
                "Dharma Day" => [
                    "resourceid" => "rm5",
                    "type" => "article",
                    "author" => "Ottowa Humane Society - n.d.",
                    "religion" => "Buddhism",
                    "category" => ["Religious Traditions"],
                    "description" => "Dharma Day, also known as “Asalha Puja” is one of the most important holidays in Theravada Buddhism. It commemorates the Buddha's first sermon following his attainment of enlightenment.",
                    "source" => "https://ottawahumane.ca/dharma-day"
                ],  
                "Fast of the 17th of Tammuz" => [
                    "resourceid" => "rm6",
                    "type" => "article",
                    "author" => "The Jerusalem Post - 2023",
                    "religion" => "Judaism",
                    "category" => ["Religious Traditions"],
                    "description" => "Thursday marks the fast of the 17th of the Hebrew month of Tammuz, a day commemorating several tragedies in Jewish history and the start of a mourning period known as the Three Weeks.",
                    "source" => "https://www.jpost.com/judaism/article-748996"
                ],
                "The Muharram Sermons" => [
                    "resourceid" => "rm7",
                    "type" => "book",
                    "author" => "Mohammed Al-Hilli",
                    "religion" => "Islam",
                    "category" => ["Theology", "Religious Traditions"],
                    "description" => "A compilation of lectures during the sacred month of Muharram in commemoration of the eternal sacrifice and the powerful movement of Imam Hussain (a) in the Battle of Ashura in Karbala.",
                    "source" => "https://www.thriftbooks.com/w/the-muharram-sermons_mohammed-al-hilli/10792364/#edition=64661424&idiq=52566039"
                ],
                "Tisha B'Av: What's Worth Mourning For?" => [
                    "resourceid" => "rm8",
                    "type" => "article",
                    "author" => "Y. Sheleg - 2019",
                    "religion" => "Judaism",
                    "category" => ["Social Issues"],
                    "description" => "Strengthening the norms founded on our shared national traditions can help fortify our shared national identity but any attempt to impose religious norms on a public when the majority does not identify with them will only lead to division and hate.",
                    "source" => "https://en.idi.org.il/articles/28380"
                ],
                "What is Ashura?" => [
                    "resourceid" => "rm9",
                    "type" => "article",
                    "author" => "BBC News - 2011",
                    "religion" => "Islam",
                    "category" => ["Religious Traditions"],
                    "description" => "The day of Ashura is marked by Muslims as a whole, but for Shia Muslims it is a major religious commemoration of the martyrdom at Karbala of Hussein, a grandson of the Prophet Muhammad.",
                    "source" => "https://www.bbc.com/news/world-middle-east-16047713"
                ],
                // "Placeholder" => [
                //     "resourceid" => "rm",
                //     "type" => "",
                //     "author" => "",
                //     "religion" => "",
                //     "category" => [""],
                //     "description" => "",
                //     "source" => ""
                // ]
            ]
        ];

        return $libraryResources;

    }

}

?>